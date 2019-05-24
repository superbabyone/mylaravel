<?php
namespace app\index\controller;
use think\Controller;

class Index extends Common
{

    public function index()
    {
    //    $this->view->engine->layout(false);
        $this->getLeftCateInfo();
        $this->getleftInfo();
        //获取楼层数据
        $cate_id=1;
        $floorInfo=$this->getFloorInfo($cate_id);
        // dump($floorInfo);exit;
        $this->assign('floorInfo',$floorInfo);
        return view();
    }
    //获取楼层数据
    public function getFloorInfo($cate_id)
    {
        //查询一楼显示的顶级分类
        $topWhere=[
            ['is_show','=',1],
            ['cate_id','=',$cate_id],
        ];
        $info['topInfo']=model('Category')->where($topWhere)->find();
        //查询顶级分类下的cate_id
        $twoWhere=[
            ['is_show','=',1],
            ['parent_id','=',$cate_id],
        ];
        $info['twoInfo']=model('Category')->where($twoWhere)->select();
        //查询商品
        $cateInfo=model('Category')->where('is_show',1)->select();
        $id=getCateId($cateInfo,$cate_id);
        // dump($id);die;
        $goodsWhere=[
            ['cate_id','in',$id],
            ['is_on_sale','=',1],
        ];
        $info['goodsInfo']=model('Goods')->where($goodsWhere)->select();
        return $info;
        
    }
    //点击加载更多 获取数据
    public function getMore()
    {
        $cate_id=input('post.cate_id');
        $floor_num=input('post.floor_num',0,'intval');
        if(empty($cate_id)){
            echo "no";
        };
        $where=[
            ['parent_id','=',0],
            ['cate_id','>',$cate_id],
        ];
        $cate_id=model('Category')->where($where)->order('cate_id','asc')->value('cate_id');
        $info=$this->getFloorInfo($cate_id);
        $floor_num+=1;
        $this->assign('floor_num',$floor_num);
        $this->assign('floorInfo',$info);

        $this->view->engine->layout(false);
        echo $this->fetch('getMore');
    }
}
