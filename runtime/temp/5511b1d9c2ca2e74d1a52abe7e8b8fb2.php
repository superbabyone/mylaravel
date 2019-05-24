<?php /*a:1:{s:63:"D:\phpStudy\WWW\tp5.1\application\index\view\index\getMore.html";i:1554886267;}*/ ?>
<div cate_id = "<?php echo htmlentities($floorInfo['topInfo']['cate_id']); ?>">
        <div class="i_t mar_10">
            <span class="floor_num"><?php echo htmlentities($floor_num); ?>F</span>
            <span class="fl"><?php echo htmlentities($floorInfo['topInfo']['cate_name']); ?></span>
            <?php if(is_array($floorInfo['twoInfo']) || $floorInfo['twoInfo'] instanceof \think\Collection || $floorInfo['twoInfo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $floorInfo['twoInfo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>                
            <span class="i_mores fr"><a href="#"><?php echo htmlentities($vo['cate_name']); ?> &nbsp;&nbsp;&nbsp;</a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="content">

            <div class="fresh_mid">
                <ul>
                    <?php if(is_array($floorInfo['goodsInfo']) || $floorInfo['goodsInfo'] instanceof \think\Collection || $floorInfo['goodsInfo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $floorInfo['goodsInfo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li>
                        <div class="name"><a href="#"><?php echo htmlentities($vo['goods_name']); ?></a></div>
                        <div class="price">
                            <font>￥<span><?php echo htmlentities($vo['shop_price']); ?></span></font> &nbsp; 26R
                        </div>
                        <div class="img"><a href="<?php echo url('goods/goodsinfo'); ?>?goods_id=<?php echo htmlentities($vo['goods_id']); ?>"><img src="/uploads/<?php echo htmlentities($vo['goods_img']); ?>" width="185" height="155" /></a></div>
                    </li>   
                    <?php endforeach; endif; else: echo "" ;endif; ?>                                                       
                </ul>
            </div>

        </div> 
    </div> 