<?php

namespace app\index\controller;

use think\Controller;

class Car extends Common
{
//加入购物车
    public function addCar()
    {
        $goods_id = input('post.goods_id',0,'intval');
        $buy_num = input('post.buy_num',0,'intval');
        if(empty($goods_id)){
            fail('请选择一个商品');
        };
        if(empty($buy_num)){
            fail('请选择购买数量');
        }
        if($this->checkLogin()){
            $this->saveCarCookie($goods_id,$buy_num);
        }else{
            $this->saveCarDb($goods_id,$buy_num);
        }
    }
    //将要购买的数据添加到数据库
    public function saveCarDb($goods_id,$buy_num)
    {
        $u_id = $this->getUserId();
        $where = [
            ['u_id','=',$u_id],
            ['is_del','=',1],
            ['goods_id','=',$goods_id],
        ];
        $add_price = model('Goods')->where(['goods_id'=>$goods_id])->value('shop_price');
        $carInfo = model('Car')->where($where)->find();
        if(empty($carInfo)){
            //添加
            $res = $this->checkGoodsNum($goods_id,$buy_num);
            if(!$res){
                fail('请输入范围内的商品数量');
            }else{
                $info = [
                    'goods_id' => $goods_id,
                    'buy_num' => $buy_num,
                    'u_id' => $u_id,
                    'create_time' => time(),
                    'update_time' =>time(),
                    'add_price'=> $add_price,
                ];
                $result = model('Car')->save($info);
            }
        }else{
            //累加（修改）
            $res = $this->checkGoodsNum($goods_id,$buy_num,$carInfo['buy_num']);
            if(!$res){
                fail('商品超过库存');
            }else{
                $update = [
                    'u_id' => $u_id,
                    'goods_id' => $goods_id,
                    'buy_num' => $buy_num+$carInfo['buy_num'],
                    'update_time' => time(),
                ];
                $result = model('Car')->where($where)->update($update);
            }
        }
        if($result){
            successly('加入购物车成功');
        }else{
            fail('抱歉-.-！库存不够啦');
        }
    }
    //将要购买的数据添加到cookie中
    public function saveCarCookie($goods_id,$buy_num)
    {
        $str = cookie('carInfo');
        $carInfo = [];
        $add_price = model('Goods')->where(['goods_id'=>$goods_id])->value('shop_price');
        if(!empty($str)){
            $str = cookie('carInfo');
            $flage = 0;
            $carInfo = getBase64Info($str);
            foreach ($carInfo as $k => $v){
                if($v['goods_id'] == $goods_id){
                    //检测库存   累加
                    $res = $this->checkGoodsNum($goods_id,$buy_num);
                    if($res){
                        $carInfo[$k]['buy_num'] = $v['buy_num']+$buy_num;
                        $str = createBase64Info($carInfo);
                        cookie('carInfo',$str);
                        successly('少侠已经习得真经');exit;
                    }else{
                        fail('客官-.-！库存不够啦');
                    }
                }else{
                    $flage = 1;
                }
            }   
                if($flage == 1){
                    //检测库存 添加
                    $res = $this->checkGoodsNum($goods_id,$buy_num);
                    if($res){
                        $carInfo[] = [
                            'goods_id' => $goods_id,
                            'add_price' => $add_price,
                            'buy_num' => $buy_num,
                            'create_time' => time(),
                        ];
                    }else{
                        fail('在下输了-.-！实在没有太多了');
                    }
                }
            $str = createBase64Info($carInfo);
            cookie('carInfo',$str);
            successly('少侠已经习得真经');
        }else{
            //检查库存   添加
            $res = $this->checkGoodsNum($goods_id,$buy_num);
            if($res){
                $info[] = [
                    'goods_id' => $goods_id,
                    'add_price' => $add_price,
                    'buy_num' => $buy_num,
                    'create_time' => time(),
                ];
                $str = createBase64Info($info);
                cookie('carInfo',$str);
            }
        }
    }
    //测试cookie值
    public function test()
    {
        $info = getBase64Info(cookie('carInfo'));
        dump($info);
    }
//购物车列表
    public function carList()
    {
        $u_id = $this->getUserId();
        $this->getLeftCateInfo();
        $this->getleftInfo();
        if($this->checkLogin()){
            $carInfo = $this->getCarInfoCookie();
        }else{
            $carInfo = $this->getCarInfoDb($u_id);
        };
        //小计的数据
        if(!empty($carInfo)){
            foreach($carInfo as $k=>$v){
                $total = $v['buy_num']*$v['shop_price'];
                $carInfo[$k]['total'] = $total;
            }
        };
        $this->assign('carInfo',$carInfo);
        return view();
    }
    //从数据库获取购物车数据
    public function getCarInfoDb($u_id)
    {
        $goods_id = model('Car')->where('u_id',$u_id)->value('u_id');
        $carInfo = model('Goods')->alias('g')->join('Car c','g.goods_id = c.goods_id')->where(['is_del'=>1,'u_id'=>$u_id,'is_on_sale'=>1])->order('create_time','desc')->select();
        return $carInfo;
    }
    //从cookie获取购物车数据
    public function getCarInfoCookie()
    {
        $str = cookie('carInfo');
        if(!empty($str)){
            $carInfo = getBase64Info($str);
            $carInfo = array_reverse($carInfo);
            foreach($carInfo as $k=>$v){
                $goods_id[] = $v['goods_id'];
            }
            $goods_id = implode(',',$goods_id);
            $where = [
                ['is_on_sale','=',1],
                ['goods_id','in',$goods_id],
            ];
            $exp = new \think\db\Expression("field(goods_id,$goods_id)");
            $goodsInfo = model('Goods')->where($where)->order($exp)->select();
            foreach($goodsInfo as $k=>$v){
                foreach($carInfo as $key=>$val){
                    if($v['goods_id'] == $val['goods_id']){
                        $goodsInfo[$k]['buy_num'] = $val['buy_num'];
                        $goodsInfo[$k]['add_price'] = $val['add_price'];
                    }
                };
            };
            return $goodsInfo;
        }else{
            return false;
        }
    }
//改变商品购买数量
    public function changeBuyNum()
    {
        $goods_id = input('post.goods_id',0,'intval');
        $buy_num = input('post.buy_num',0,'intval');
        if(empty($goods_id)){
            fail('请选择一个物件');
        }
        if(empty($buy_num)){
            fail('要买多少件！倒是说呀！！');
        }
       if($this->checkLogin()){
        $res = $this->changeBuyNumCookie($goods_id,$buy_num);
       }else{
           $res = $this->changeBuyNumDb($goods_id,$buy_num);
       }
    }
    //从数据库改变购买数量
    public function changeBuyNumDb($goods_id,$buy_num)
    {
        $res = $this->checkGoodsNum($goods_id,$buy_num);
        if($res){
            $updateInfo = [
                'buy_num' => $buy_num,
                'update_time' => time(),
            ];
            $where = [
                'u_id' => $this->getUserId(),
                'goods_id' => $goods_id,
            ];
            $result = model('Car')->where($where)->update($updateInfo);
            if(!$result){
               fail('修改失败'); 
            }else{
                successly('111');
            }
        }else{
            fail('库存不足');
        }
    }
    //从cookie中改变购买数量
    public function changeBuyNumCookie($goods_id,$buy_num)
    {
        $res = $this->checkGoodsNum($goods_id,$buy_num);
        if($res){
            $str = cookie('carInfo');
            if(!empty($str)){
                $carInfo = getBase64Info($str);
                foreach($carInfo as $k => $v){
                    if($v['goods_id'] == $goods_id){
                        $carInfo[$k]['buy_num'] = $buy_num;
                    };
                };
                $s = createBase64Info($carInfo);
                cookie('carInfo',$s);
                successly('1321');
            } 
        }else{
            fail('库存不足');
        }
    }

//获取小计
    public function getTotal()
    {
        $goods_id = input('post.goods_id',0,'intval');
        $buy_num = input('post.buy_num',0,'intval');
        if(empty($goods_id)){
            fail('请选择一件商品');
        }
        if(empty($buy_num)){
            fail('请至少购买一件商品');
        }
        if(!$this->checkLogin()){
           //登陆后
           $res = $this->getTotalDb($goods_id,$buy_num);
        }else{
            //没登录
            $res = $this->getTotalCookie($goods_id,$buy_num);
        }
    }
    //从数据库获取小计
    public function getTotalDb($goods_id,$buy_num)
    {
        $where = [
            ['is_on_sale','=',1],
            ['goods_id','=',$goods_id],
        ];
        $shop_price = model('Goods')->where($where)->value('shop_price');
        echo $buy_num*$shop_price;
    }
    //从cookie获取小计
    public function getTotalCookie($goods_id,$buy_num)
    {
        $str = cookie('carInfo');
        if(!empty($str)){
            $info = getBase64Info($str);
            foreach($info as $k => $v){
                if($v['goods_id'] == $goods_id){
                    $buy_num = $v['buy_num'];
                };
            };
            $where = [
                ['is_on_sale','=',1],
                ['goods_id','=',$goods_id],
            ];
            $shop_price = model('Goods')->where($where)->value('shop_price');
            echo $buy_num*$shop_price;
        }
    }

//获取总价
    public function getTotalAll()
    {
        $goods_id = input('post.goods_id');
        if(empty($goods_id)){
            echo 0;exit;
        };
        $u_id = $this->getUserId();
        if(!$this->checkLogin()){
            $this->getTotalAllDb($goods_id,$u_id);
        }else{
            $this->getTotalAllCookie($goods_id);
        }
    }
    //从数据库获取总价
    public function getTotalAllDb($goods_id,$u_id)
    {
        $where = [
            ['is_on_sale','=',1],
            ['c.goods_id','in',$goods_id],
            ['u_id','=',$u_id],
        ];
        $info = model('Car')->alias('c')->field('shop_price,buy_num')->join('tp_goods g','c.goods_id = g.goods_id')->where($where)->select();
        $count = 0;
        foreach($info as $k => $v){
            $count += $v['buy_num']*$v['shop_price'];
        }
        echo $count;
    }
    //从cookie获取总价
    public function getTotalAllCookie($goods_id)
    {
        $str = cookie('carInfo');
        if(!empty($str)){
            $carInfo = getBase64Info($str);
            $where = [
                ['goods_id','in',$goods_id],
                ['is_on_sale','=',1],
            ];
            $goodsInfo = model('Goods')->where($where)->select();
            $count = 0;
            foreach($carInfo as $k=>$v){
                foreach($goodsInfo as $key=>$val){
                    if($v['goods_id'] == $val['goods_id']){
                        $count += $v['buy_num']*$val['shop_price'];
                    }
                }
            }
            echo $count;
        }
    }
//删除商品
    public function carDel()
    {
        $goods_id = input('post.goods_id');
        if(empty($goods_id)){
            fail('请至少选择一件商品');
        }
        if($this->checkLogin()){
            //未登录
            $this->carDelCookie($goods_id);
        }else{
            $this->carDelDb($goods_id);
        }
    }
    // 从数据库中删除
    public function carDelDb($goods_id)
    {
        $where = [
            ['goods_id','in',$goods_id],
            ['u_id','=',$this->getUserId()],
        ];
        $res = model('Car')->where($where)->update(['is_del'=>2]);
        if($res){
            successly('删除成功');
        }else{
            fail('删除失败');
        }
    }
    //从cookie中删除
    public function carDelCookie($goods_id)
    {
        $str = cookie('carInfo');
        if(!empty($str)){
            $carInfo = getBase64Info($str);
            if(strpos($goods_id,',')){
                $goods_id = explode(',',$goods_id);
            }else{
                $goods_id = [$goods_id];
            };
            foreach($carInfo as $k=>$v){
                if(in_array($v['goods_id'],$goods_id)){
                    unset($carInfo[$k]);
                }
            };
            if(!empty($carInfo)){
                $s = createBase64Info($carInfo);
                cookie('carInfo',$s);
            }else{
                cookie('carInfo',null);
            }
            successly('删除成功');
        }else{
            fail('请选择一件商品');
        }
    }
//点击确认结算
    //
    public function conform()
    {
        $goods_id = input('get.goods_id');
        if($goods_id==''){
            $this->error('请选择一件商品');
        }
        if(!$this->checkLogin()){
            $u_id = $this->getUserId();
            $where = [
                ['u_id','=',$u_id],
                ['c.goods_id','in',$goods_id],
                ['is_on_sale','=',1],
                ['is_del','=',1],
            ];
            $goodsInfo = model('Goods')->alias('g')->join('Car c','g.goods_id=c.goods_id')->where($where)->select();
        }else{
            $this->error('请登陆后在弄这些',url('login/login'));exit;
        }
        foreach($goodsInfo as $k=>$v){
            $goodsInfo[$k]['total'] = $v['buy_num']*$v['shop_price'];
        };
        $count = 0;
        foreach($goodsInfo as $k=>$v){
            $count += $v['buy_num']*$v['shop_price'];
        }
        $this->getLeftCateInfo();
        $this->getleftInfo();
        $addressInfo = $this->getAddressInfo();
        $this->assign('addressInfo',$addressInfo);
        $this->assign('count',$count);
        $this->assign('goodsInfo',$goodsInfo);
        return view();
    }
}