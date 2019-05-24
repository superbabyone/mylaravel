<?php

namespace app\Ks\validate;

use think\Validate;

class Log extends Validate
{
   
    
	protected $rule = [
        'c_dizhi'=>'require',
        'c_man'=>'require',
        'c_tel'=>'require|mobile',


    ];
    
   
    protected $message = [
        'c_dizhi.require'=>'地址不能为空',
        'c_man.require'=>'联系人不能为空',
        'c_tel.require'=>'手机号不能为空',
        'c_tel.mobile'=>'请填写手机号格式',

    ];
}
