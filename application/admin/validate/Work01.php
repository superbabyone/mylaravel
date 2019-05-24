<?php

namespace app\admin\validate;

use think\Validate;

class Work01 extends Validate
{
	protected $rule = [
        'book_name' => 'require|unique:work01|min:2|chs',
        'book_author' => 'require',
        'open_time' => 'require|date',
        'book_content' => 'require',
    ];
    
    protected $message = [
        'book_name.require' => '图书名字必填',
        'book_name.unique' => '图书已存在',
        'book_name.min' => '图书名字最少为2位',
        'book_name.chs' => '图书名字必须为汉字',
        'book_author.require' => '图书作者必填',
        'open_time.require' => '何时添加的呀？',
        'open_time.date' => '请输入正确的时间格式',
        'book_content.require' => '图书内容被你吃了呀！',
    ];
}
