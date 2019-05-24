<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Address extends Common
{
    public function __construct()
    {
        parent::__construct();
        if($this->checkLogin()){
            $this->error('请先登录',url('login/login'));
        }
    }
    //收货人列表
    // public function addressList()
    // {
    //     return view();
    // }
    //添加收货人地址
    public function addressAdd()
    {
        $info = $this->getAreaInfo(0);
        $addressInfo = $this->getAddressInfo();
        $this->assign('addressInfo',$addressInfo);
        $this->assign('info',$info);
        return view();
    }
    //添加的处理
    public function addHandle()
    {
        $data = input('post.');
        $u_id = $this->getUserId();
        $data['u_id'] = $u_id;
        $where = [
            ['u_id','=',$u_id],
            ['is_default','=',1],
            ['is_del','=',1],
        ];
        if($data['is_default'] == 1){
            model('Address')->where($where)->update(['is_default'=>2]);
        }
        $res = model('Address')->isUpdate(false)->save($data);
        if($res){
            successly('添加成功');
        }else{
            fail('添加失败');
        }
    }
    //收货地区  （三级联动）
    public function getArea()
    {
        $id = input('post.');
        $info = $this->getAreaInfo($id);
        echo json_encode($info);
    }
    //获取地区
    public function getAreaInfo($pid)
    {
        $areaInfo = model('Area')->where(['pid'=>$pid])->select();
        return $areaInfo;
    }
    //设为默认收货地址
    public function update()
    {
        $address_id = input('post.');
        if($address_id==''){
            $this->error('请选择一个收货地址');
        };
        $u_id = $this->getUserId();
        $where = [
            ['u_id','=',$u_id],
            ['is_del','=',1],
        ];
        //开启事务
        model('Address')->startTrans();
        //执行事务
        $res1 = model('Address')->where($where)->update(['is_default'=>2]);
        $res2 = model('Address')->where(['address_id'=>$address_id])->update(['is_default'=>1]);
        //判断 执行
        if($res1 !== false && $res2){
            model('Address')->commit();
            successly('修改成功');
        }else{
            model('Address')->rollback();
            fail('修改失败');
        };
    }
    //修改
    public function edit()
    {
        $address_id = input('get.');
        if(empty($address_id)){
            $this->error('请选择一个收货地址');
        }
        $addressInfo = model('Address')->where(['address_id'=>$address_id])->find();
        $provinceInfo = $this->getAreaInfo(0);
        $cityInfo = $this->getAreaInfo($addressInfo['province']);
        $areaInfo = $this->getAreaInfo($addressInfo['city']);
        $this->assign('areaInfo',$areaInfo);
        $this->assign('cityInfo',$cityInfo);
        $this->assign('provinceInfo',$provinceInfo);
        $this->assign('addressInfo',$addressInfo);
        return $this->fetch();
    }
    //处理修改
    public function editHandle()
    {
        $data = input('post.');
        $u_id = $this->getUserId();
        $where = [
            ['u_id','=',$u_id],
            ['is_default','=',1],
            ['is_del','=',1],
        ];
        if($data['is_default'] == 1){
            model('Address')->where($where)->update(['is_default'=>2]);
        }
        $res = model('Address')->where(['address_id'=>$data['address_id']],['u_id'=>$u_id],['is_del'=>1])->update($data);
        if($res){
            successly('修改成功');
        }else{
            fail('修改失败');
        }
    }
    //删除
    public function del()
    {
        $u_id = $this->getUserId();
        $address_id = input('post.');
        if($address_id==''){
            $this->error('请选择一个收货地址');
        }
        $res = model('Address')->where(['address_id'=>$address_id],['u_id'=>$u_id])->update(['is_del'=>2]);
        if($res){
            successly('删除成功');
        }else{
            fail('删除失败');
        }
    }
}
