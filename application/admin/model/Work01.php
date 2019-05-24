<?php

namespace app\admin\model;

use think\Model;

class Work01 extends Model
{
    public function getOpenTimeAttr($value)
    {
        $time=date('Y-m-d H:i:s',$value);
        return $time;
    }
     public function setOpenTimeAttr($value)
    {
        $time=strtotime($value);
        return $time;
    }
}
