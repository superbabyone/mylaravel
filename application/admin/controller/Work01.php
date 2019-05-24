<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Work01 extends Controller
{
    public function index()
    {
        return view();
    }
    public function indexData()
    {
        $data=model('Work01')->select();
        echo json_encode(['data'=>$data,'code'=>0]);
    }

    public function workAdd()
    {
        return view();
    }
    public function workAddHandle()
    {
        $data=input('post.');
        // dump($data);exit;
        $validate = new \app\admin\validate\Work01;
        if (!$validate->check($data)){
            echo json_encode(['font'=>$validate->getError(),'code'=>2]);exit;
        }
        $res=model('Work01')->save($data);
        if($res){
            echo json_encode(['font'=>'添加成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'添加失败','code'=>0]);
        }
    }
}
