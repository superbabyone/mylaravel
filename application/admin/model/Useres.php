<?php

namespace app\admin\model;

use think\Model;

class Useres extends Model
{
    public function getUCardAttr($value)
    {
        $arr=array('**********');
        $uCard=substr_replace($value,$arr,3,11);
        return $uCard;
    }

}
