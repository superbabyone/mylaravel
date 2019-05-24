<?php

namespace app\Ks\model;

use think\Model;

class Log extends Model
{
    protected $table="tp_login";
    public function getctelAttr($value){
        $tel=['****'];
        $status=substr_replace($value,$tel,3,4);
        return $status;
    }
  
}
