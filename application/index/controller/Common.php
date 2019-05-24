<?php

namespace app\index\controller;
use\think\facade\Request;

use think\Controller;

class Common extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $controller = Request::controller();
        // dump($controller);die;
        if($controller=='Index'){
            $show='leftNav';
        }else{
            $show='leftNav none';
        }
        $this->assign('show',$show);
    }
    //获取左边栏全部商品的数据
    public function getLeftCateInfo()
    {
        $info=model('Category')->where('is_nav_show',1)->select();
        $this->assign('info',$info);
    }
    //获取全部商品数据
    public function getleftInfo()
    {
        $c_info=model('Category')->field('parent_id,cate_name,cate_id')->where('is_show',1)->select()->toArray();
        // dump($c_info);exit;
        $c_info=getInfo($c_info);
        // dump($c_info);exit;
        $this->assign('cateInfo',$c_info);
    }
    //获取session中的用户ID
    public function getUserId()
    {
        $u_id = session('sessionInfo.u_id');
        return $u_id;
    }
    //同步浏览历史数据 
    function asyncHistory()
    {
        $str = cookie('historyInfo');
        if(!empty($str)){
            $info = getBase64Info($str);
            foreach($info as $k => $v){
                $info[$k]['u_id'] = $this->getUserId();
            }
            $res = model('History')->saveAll($info);
            if($res){
                cookie('historyInfo',null);
            }
        }
    }
    //从数据库获取商品信息(浏览记录)
    function getHistoryDb()
    {
        $where = [
            'u_id' => $this->getUserId(),
        ];
        $goods_id = model('History')->where($where)->order('h_time','desc')->column('goods_id');
        if(!empty($goods_id)){
            //不为空    根据$goods_id查数据
            //去重，取出最新的四条数据
            $goods_id = array_slice(array_unique($goods_id),0,4);
            //把数组转化成字符串
            $goods_id = implode(',',$goods_id);
            $goodsWhere = [
                ['goods_id','in',$goods_id],
            ];
            $exp = new \think\db\Expression("field(goods_id,$goods_id)"); //自定义排序
            $historyInfo = model('Goods')->where($goodsWhere)->order($exp)->select();
            return $historyInfo;
        }else{
            return false;
        }
    }
    //从cookie获取商品信息(浏览记录)
    function getHistoryCookie()
    {
        $str = cookie('historyInfo');
        if(!empty($str)){
            $info = getBase64Info($str);
            $info = array_reverse($info);
            $goods_id = []; 
            foreach($info as $k => $v){
                $goods_id[] = $v['goods_id'];
            }
         
            $goods_id = array_slice(array_unique($goods_id),0,4);
            $goods_id = implode(',',$goods_id);
            $goodsWhere=[
                ['goods_id','in',$goods_id],
            ];
            $exp = new \think\db\Expression("field(goods_id,$goods_id)"); //自定义排序
            $historyInfo = model('Goods')->where($goodsWhere)->order($exp)->select();
            return $historyInfo;
        }else{
            return false;
        }
    }
    //判断session有没有值
    function checkLogin()
    {
        return empty(session('sessionInfo'));
    }
    //检测商品库存
    /*
     * $goods_id 商品ID
     * $sqlNum 要购买的数量
     * $buy_num 已经购买的数量
     */
    public function checkGoodsNum($goods_id,$sqlNum,$buy_num=0)
    {
        $goodsWhere = [
            ['goods_id','=',$goods_id]
        ];
        $goods_num = model('goods')->where($goodsWhere)->value('goods_number');
        $num = $buy_num+$sqlNum;
        if($goods_num<$num){
            return false;
        }else{
            return true;
        }
    }
    //同步购物车数据
    public function asyncCar()
    {
        $u_id = $this->getUserId();
        $str = cookie('carInfo');
        if(!empty($str)){
            $carInfo = getBase64Info($str);
            foreach($carInfo as $k => $v){
                $where = [
                    'is_del'=>1,
                    'goods_id'=>$v['goods_id'],
                    'u_id'=>$u_id,
                ];
                $goodsInfo = model('Car')->where($where)->find();
                if($goodsInfo == null){
                    // 添加(把cookie中的数据添加到数据库中)
                    $res = $this->checkGoodsNum($v['goods_id'],$v['buy_num']);
                    if($res){
                        $saveInfo = [
                            'u_id' => $u_id,
                            'update_time' => time(),
                            'create_time' => time(),
                            'goods_id' => $v['goods_id'],
                            'buy_num' => $v['buy_num'],
                        ];
                        $result = model('Car')->insert($saveInfo);
                        cookie('carInfo',null);
                    }else{
                        fail('库存不足！');
                    }
                }else{
                    $res = $this->checkGoodsNum($v['goods_id'],$v['buy_num'],$goodsInfo['buy_num']);
                    if($res){
                        $updateInfo = [
                            'buy_num'=>$v['buy_num']+$goodsInfo['buy_num'],
                            'update_time'=>time(),
                        ];
                        $result = model('Car')->where($where)->update($updateInfo);
                        cookie('carInfo',null);
                    }else{
                        fail('库存不足！');
                    }
                }
            }
        }else{
            
        }
    }
    //获取收货地址信息
    public function getAddressInfo()
    {
        $u_id = $this->getUserId();
        $where = [
            ['is_del','=',1],
            ['u_id','=',$u_id],
        ];
        $adderssInfo = model('Address')->where($where)->select();
        // dump($adderssInfo);die;
        if(!empty($adderssInfo)){
            foreach($adderssInfo as $k=>$v){
                $adderssInfo[$k]['province'] = model('Area')->where(['id'=>$v['province']])->value('name');
                $adderssInfo[$k]['city'] = model('Area')->where(['id'=>$v['city']])->value('name');
                $adderssInfo[$k]['area'] = model('Area')->where(['id'=>$v['area']])->value('name');
            }
            return $adderssInfo;
        }else{
            return false;
        }
    }
}
