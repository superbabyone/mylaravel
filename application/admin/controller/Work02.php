<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Work02 extends Controller
{
    public function addUser()
    {
        return view();
    }
    public function checkOnly()
    {
        $u_name = input('post.');
        foreach($u_name as $k=>$v){
            $u_name = $v;
        };
        $count = model('Work02')->where('u_name','=',$u_name)->count();
        if($count == 0){
            successly('名称可用');
        }else{
            fail('名字已存在');
        }
    }
    public function addHandle()
    {
        $data = input('post.');
        dump($data);die;
        $res = model('Work02')->save($data);
        dump($res);die;
        if($res){
            successly('添加成功');
        }else{
            fail('添加失败');
        }
    }
    public function index()
    {
        return view();
    }
    public function listData()
    {
        $page = 1;
        $count = model('Work02')->count();
        $data = model('Work02')->select();
        echo json_encode(['data'=>$data,'page'=>$page,'count'=>$count,'code'=>0]);
    }
    public function del($id)
    {
        $res = model('Work02')->destroy($id);
        if($res){
            successly('删除成功');
        }else{
            fail('删除失败');
        }
    }
    public function edit()
    {
        $id = input('get.id');
        $info = model("Work02")->where('id',$id)->find();
        // dump($info);die;
        $this->assign('info',$info);
        return view();
    }
    public function editHandle()
    {
        $data = input('post.');
        $info = model('Work02')->where('id',$data['id'])->find();
        if($info['u_name'] == $data['u_name'] ){
            fail('修改失败');
        }
        $res = model("Work02")->update($data);
        if($res){
            successly('修改成功');
        }else{
            fail('修改失败');
        }
    }
}
