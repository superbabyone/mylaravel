<?php

namespace app\Ks\controller;

use think\Controller;
use think\Request;
use app\Ks\model\Log as logmodel;
use think\facade\Session;
use app\Ks\validate\Log as validatelog;
class Log extends Controller

{
    protected $m;
    protected $v;
    public function __construct()
    {
        parent::__construct();
        $this->m=new logmodel;
        $this->v=new validatelog;
        
    }
    

    public function index()
    {
        $this->view->engine->layout(false);
        return $this->fetch();
    }

    public function log()
    {
        $c_name=$this->request->post('c_name');
        $c_pwd=$this->request->post('c_pwd');
        $data=$this->m->where('c_name',$c_name)->where('c_pwd',$c_pwd)->find();
        if($data){
            $this->Session=new Session;
            Session::set('islogin',true);
            Session::set('c_name',$c_name);
          
            $this->success('登陆成功','addlog');
        }else{
            $this->error('用户名或密码错误');
        }
    
    }
    
    public function addlog()
    {
        
        $this->view->engine->layout(false);
        return $this->fetch();
    
    
    }
    
    public function doaddlog()
    {
        $data=$this->request->post();
    if(!$this->v->check($data)){
        echo $this->v->getError();
    }else{
        $post=$this->m->insert($data);
        if($post){
            $this->success('添加成功','loglist');
        }else{
            $this->error('添加失败');
        }
    }
    }
    public function loglist()
    {
        // if(!Session::has('c_name.item')){
        //     $this->error('请登录','log');
        // }else{
           
        // }
        $this->view->engine->layout(false);
        $data=$this->m->select();
        $this->assign('data',$data);
        return $this->fetch();
        
    
    }




}
