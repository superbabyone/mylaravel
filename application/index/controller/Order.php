<?php

namespace app\index\controller;

use think\Controller;
use think\Exception;

class Order extends Common
{
    public function addOrder()
    {
        $goods_id = input('post.goods_id');
        $address_id = input('post.address_id');
        $pay_type = input('post.pay_type');
        $order_talk = input('post.order_talk');
        $u_id = $this->getUserId();
        //开启事务
        model('Order')->startTrans();
        try{
            //执行并验证
            if(empty($goods_id)){
                throw new Exception('请选择一件商品');
            }
            if(empty($address_id)){
                throw new Exception('请选择一个收货地址');
            }
            if(empty($pay_type)){
                throw new Exception('请选择一种支付方式');
            }
            //向order库添加数据
            $order['order_no'] = $this->getOrderNo();
            $order['order_amount'] =$this->getOrderAmount($goods_id);
            $order['pay_type'] = $pay_type;
            $order['order_talk'] = $order_talk;
            $order['u_id'] = $u_id;
            $res = model('Order')->save($order);
            $order_id = model('Order')->order_id;
            //向order_address表添加数据
            $res2 = $this->saveOrderAddress($address_id,$order_id);
            //向order_detail表添加数据
            $res3 = $this->saveOrderDetail($goods_id,$order_id);
            //修改goods表购买数量
            $res4 = $this->editBuyNum($goods_id,$order_id);
            //清空购物车
            $res5 = $this->saveCar($goods_id,$order_id);
            model('Order')->commit();
            echo json_encode(['font'=>'下单成功','code'=>6,'order_id'=>$order_id]);
        }catch(Exception $t){
            //抛出错误信息
            model('Order')->rollback();
            fail($t->getMessage());
        }
    }
    //获取订单号
    public function getOrderNo()
    {
        $u_id = $this->getUserId();
        $no = time().rand(1000,999).$u_id;
        return $no;
    }
    //获取总金额
    public function getOrderAmount($goods_id)
    {
        $u_id = $this->getUserId();
        $where = [
            ['u_id','=',$u_id],
            ['g.goods_id','in',$goods_id],
            ['is_del','=',1],
        ];
        $goodsInfo = model('Goods')
        ->alias('g')
        ->join('tp_car c','g.goods_id = c.goods_id')
        ->where($where)
        ->select();
        if(!empty($goodsInfo)){
            $count = 0;
            foreach($goodsInfo as $k=>$v){
                $count += $v['buy_num']*$v['shop_price'];
            }
            return $count;
        }else{
            return 0;
        }
    }
    //向order_address表添加数据
    public function saveOrderAddress($address_id,$order_id)
    {
        $addressWhere = [
            ['address_id','=',$address_id],
            ['is_del','=',1],
        ];
        $addressInfo = model('Address')->where($addressWhere)->find()->toArray();
        if(!empty($addressInfo)){
            unset($addressInfo['create_time']);
            unset($addressInfo['update_time']);
            $addressInfo['order_id'] = $order_id;
            $res = model('OrderAddress')->save($addressInfo);
            if(!$res){
                throw new Exception("收货地址写入失败");
            }
        }else{
            throw new Exception("没有收货地址");
        }
    }
    //向order_detail表添加数据
    public function saveOrderDetail($goods_id,$order_id)
    {
        $u_id = $this->getUserId();
        $where = [
            ['u_id','=',$u_id],
            ['g.goods_id','in',$goods_id],
            ['is_del','=',1],
        ];
        $goodsInfo = model('goods')->alias('g')->join('tp_car c','g.goods_id=c.goods_id')->where($where)->select()->toArray();
        // dump($goodsInfo);exit;
        if(empty($goodsInfo)){
            throw new Exception("没有此商品");
        }
        foreach($goodsInfo as $k=>$v){
            $goodsInfo[$k]['buy_number'] = $v['buy_num'];
            $goodsInfo[$k]['order_id'] = $order_id;
            unset($goodsInfo[$k]['update_time']);
            unset($goodsInfo[$k]['create_time']);
        }
        $res = model('OrderDetail')->saveAll($goodsInfo);
        // echo model('OrderDetail')->getlastsql();die;
        if(!$res){
            throw new Exception("收货信息写入失败");
        }
    }
    //修改购买数量
    public function editBuyNum($goods_id,$order_id)
    {
        $where1 = [
            ['u_id','=',$this->getUserID()],
            ['g.goods_id','in',$goods_id],
            ['is_del','=',1],
        ];
        $goodsInfo = model('goods')->alias('g')->join('tp_car c','g.goods_id=c.goods_id')->where($where1)->select();
        $goodsInfo = $goodsInfo->toArray();
        foreach($goodsInfo as $k=>$v){
            $res = model('goods')->where('goods_id',$v['goods_id'])->update(['goods_number'=>['dec',$v['buy_num']]]);
            if(empty($res)){
                throw new Exception("购买数量修改失败"); 
            }
            return $res;
        }
    }
    //清空购物车
    public function saveCar($goods_id,$order_id)
    {
        $where = [
            ['u_id','=',$this->getUserId()],
            ['goods_id','in',$goods_id],
        ];
        $res = model('Car')->where($where)->update(['is_del'=>2]);
        if(empty($res)){
            throw new Exception("购物车清空失败");
        }
    }
    //提交成功后的跳转
    public function successOrder()
    {
        $order_id = input('get.order_id',0,'intval');
        if(empty($order_id)){
            $this->error('无效地址');
        }
        $u_id=$this->getUserId();
        $where = [
            ['order_id','=',$order_id],
            ['is_del','=',1],
        ];
        $orderInfo = model('Order')->where($where)->find();
        if(empty($orderInfo)){
            $this->error('无效地址');
        };
        $this->getLeftCateInfo();
        $this->getLeftInfo();
        $this->assign('orderInfo',$orderInfo);
        return view();
    }
    //支付
    public function alipay()
    {
        $order_id = input('get.order_id');
        if(empty($order_id)){
            $this->error('地址无效');
        };
            $orderInfo = model('Order')->where([['is_del','=',1],['order_id','=',$order_id]])->find();
            if(empty($orderInfo)){
                fail("无效操作");
            };
        $config = config('alipay.');
        require_once "../extend/alipay/pagepay/service/AlipayTradeService.php";
        require_once "../extend/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php";

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $orderInfo['order_no'];

        //订单名称，必填
        $subject = '体感手指doYdo';

        //付款金额，必填
        $total_amount = $orderInfo['order_amount'];

        //商品描述，可空
        $body = '体感手指';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);
    }
    public  function address()
    {
        echo '213';
    }
}
