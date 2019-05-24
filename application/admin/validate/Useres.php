<?php

namespace app\admin\validate;

use think\Validate;

class Useres extends Validate
{
	protected $rule = [
        'u_name'=>'require|length:2,5|chs',
        'u_card'=>'idCard',
        'u_tel'=>'mobile'
    ];
    
}
