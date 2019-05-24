<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Goods extends Common
{
    public function goodsList()
    {
        $this->getLeftInfo();
        $this->getLeftCateInfo();
        //获取当前分类ID
        $cate_id=input('get.cate_id',0,'intval');
        if($cate_id==''){
            $where=[];
            session('cate_id',null);
        }else{
            $info=model('Category')->where('is_show',1)->select(); 
            $cate_id=getCateId($info,$cate_id);
            $where=[
                ['cate_id','in',$cate_id]
            ];
            session('cate_id',$cate_id);
        }
        //获取品牌的ID
        $brand_id = model('Goods')->where($where)->column('brand_id');
        $brand_id = array_unique($brand_id);
        $brandWhere=[
            ['is_show','=',1],
            ['brand_id','in',$brand_id]
        ];
        //获取品牌名称
        $brandInfo = model('Brand')->where($brandWhere)->select();
        //获取价格区间
        $price=model('Goods')->where($where)->order('shop_price','desc')->limit(1)->value('shop_price');
        $goodsPrice = $this->getPrice($price);
        //获取商品信息
        $goodsInfo=model('Goods')->where($where)->limit(4)->select();
        //分页
        $p=1;
        $pagesize=4;
        $count = model('Goods')->where($where)->count();
        $ajaxpager = new \page\AjaxPage();
        $page = $ajaxpager -> ajaxpager($p,$count,$pagesize);
        if($this->checkLogin()){
            $historyInfo = $this->getHistoryCookie();
        }else{
            $historyInfo = $this->getHistoryDb();
        }
        $this->assign('historyInfo',$historyInfo);
        $this->assign('goodsInfo',$goodsInfo);
        $this->assign('goodsPrice',$goodsPrice);
        $this->assign('brandInfo',$brandInfo);
        $this->assign('page',$page);
        return view();
    }

    public function goodsInfo()
    {
        $this->getLeftCateInfo();
        $this->getLeftInfo();
        $goods_id = input('get.goods_id');
        $goodsInfo = model('Goods')->where('goods_id',$goods_id)->find();
        //判断session有没有值   （判断有没有登陆  加浏览记录）
        if($this->checkLogin()){
            echo $this->saveHistoryCookie($goods_id);
        }else{
            echo $this->saveHistoryDb($goods_id);
        }
        $this->assign('goodsInfo',$goodsInfo);
        return view();
    }
    //写价格区间
    public function getPrice($max_price)
    {
        $price = $max_price/7;
        $arr = [];
        for($i=0;$i<=6;$i++){
            $start = number_format($i*$price,2);
            $end = number_format($price*($i+1),2);
            $arr[] = $start.' '.'-'.' '.$end;
        };
        $arr[] = $end.'及以上';
        return $arr;
    }
    //重新获取价格
    public function getNewPrice()
    {
        $brand_id = input('post.brand_id',0,'intval');
        if(session('?cate_id')){
            $cate_id = session('cate_id');
            $where=[
                ['brand_id','=',$brand_id],
                ['cate_id','in',$cate_id],
            ];
        }else{
            $where=[
                ['brand_id','=',$brand_id],
            ];
        }
        $goodsPrice = model('Goods')->where($where)->limit(1)->value('shop_price');
        $newPrice = $this->getPrice($goodsPrice);
        echo json_encode($newPrice);
    }
    //获取商品信息（搜索后的）
    public function goodsNewInfo()
    {
        //品牌ID
        $brand_id = input('post.brand_id',0,'intval');
        //商品价格区间
        $price = input('post.price',0);
        //排序
        $order_type = input('post.order_type',0);
        //字段（查询条件）
        $order_field = input('post.order_field',0);
        //字段（最新的查询条件）
        $field = input('post.field',0);
        //当前页码
        $p = input('post.p',0);
        // $data = input('post.');
        // dump($data);exit;
        $where = [];
        if(session('?cate_id')){
            $cate_id = session('cate_id');
            $where[] = ['cate_id','in',$cate_id];
        }
        // dump($where);exit;
        if(!empty($brand_id)){
            $where[] = ['brand_id','=',$brand_id];
        }
        if(!empty($price)){
            if(strpos($price,'-')){
                $price = explode('-',$price);
                $one = str_replace(',','',$price[0]);
                $two = str_replace(',','',$price[1]);
                $where[] = ['shop_price','>=',$one];
                $where[] = ['shop_price','<=',$two];
            }else{
                $price = (int)$price;
                $where[] = ['shop_price','>=',$price];
            }
        }
        if(!empty($field)){
            $where[] = ['is_new','=',1];
        }
        //查询
        if(empty($order_type)){
            $goodsInfo = model('Goods')->where($where)->page($p,4)->select();
        }else{
            $goodsInfo = model('Goods')->where($where)->order($order_field,$order_type)->page($p,4)->select();
        }
        // echo model('Goods')->getLastSql();exit;
        //分页
        $pagesize=4;
        $count = model('Goods')->where($where)->count();
        $ajaxpager = new \page\AjaxPage();
        $page = $ajaxpager -> ajaxpager($p,$count,$pagesize);
        $this->assign('goodsInfo',$goodsInfo);
        $this->assign('page',$page);
        $this->view->engine->layout(false);
        echo $this->fetch('goods');
    }
    //把浏览记录存到数据库
    public function saveHistoryDb($goods_id)
    {
        $info = [
            'goods_id' => $goods_id,
            'u_id' => $this->getUserId(),
            'h_time' => time(),
        ];
        // dump($info);die;
        model('History')->save($info);
    }
    //把浏览记录存到cookie
    public function saveHistoryCookie($goods_id)
    {
        $historyInfo = cookie('historyInfo');
        // $arr = unserialize(base64_decode($historyInfo));
        if(!empty($historyInfo)){
            $info = getBase64Info($historyInfo);
            if (strlen($historyInfo) >4000){
                array_shift($info);
            }else{
                $info[] = [
                'goods_id' => $goods_id,
                 'h_time' => time(),
                ];
            } 
        }else{
            $info = [
                [
                 'goods_id' => $goods_id,
                 'h_time' => time(),
            ]
        ];
        }
        $str = createBase64Info($info);
        cookie('historyInfo',$str);
    }
    //测试cookie值
    public function test()
    {
        $str = cookie('historyInfo');
        return $str;
    }
}
