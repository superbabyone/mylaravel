<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\validate\Useres;

class Work extends Controller
{
   public function add()
   {
       return view();
   }
   public function addHandle()
   {
        $data=input('post.');
        // dump($data);
        $validate=new Useres;
        if (!$validate->check($data)) {
            echo json_encode(['font'=>$validate->getError(),'code'=>2]);exit;
        }
        $res=model('Useres')->save($data);
        if($res){
            echo json_encode(['font'=>'添加成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'添加失败','code'=>2]);
        }        
   }

   public function index()
   {
       return view();
   }
   public function indexData()
   {
       $data=model('Useres')->select();
       echo json_encode(['data'=>$data,'code'=>0]);
   }
}
