<?php

namespace app\index\validate;

use think\Validate;

class User extends Validate
{
	protected $rule = [
        'u_email' => 'require|email|checkEmail',
        'u_pwd' => 'require',
    ];
    
    protected $message = [
        'u_email.require' => '邮箱必填',
        'u_email.email' => '邮箱格式有误',
        'u_pwd.require' => '密码必填',
    ];

    protected function checkEmail($value,$rule,$data)
    {   
        $count = model('User')->where('u_email','=',$value)->count();
        if($count == 0 ){
            return '该邮箱尚未注册';
        }else{
            return true;
        }
    }
}
