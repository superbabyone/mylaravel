<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class User extends Common
{
    public function __construct()
    {
        parent::__construct();
        if($this->checkLogin()){
            $this->error('请先登录',url('login/login'));
        }
    }

    public function userList()
    {
        return view();
    }
}
