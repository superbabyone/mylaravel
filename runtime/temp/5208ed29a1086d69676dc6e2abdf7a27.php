<?php /*a:5:{s:61:"D:\phpStudy\WWW\tp5.1\application\admin\view\goods\index.html";i:1551930012;s:56:"D:\phpStudy\WWW\tp5.1\application\admin\view\layout.html";i:1550652373;s:63:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\header.html";i:1554427842;s:61:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\left.html";i:1551940195;s:63:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\footer.html";i:1551775700;}*/ ?>

  <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>layout 后台大布局 - Layui</title>
  <link rel="stylesheet" href="/static/page/page.css">
  <link rel="stylesheet" href="/static/layui/css/layui.css">
  <script src="/static/JS/jquery-3.3.1.min.js"></script>
  <script src="/static/layui/layui.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item"><a href="">站点首页</a></li>
          <li class="layui-nav-item">
          
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="<?php echo url('Login/unLogin'); ?>">退了</a></li>
    </ul>
  </div>
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <?php
          $controller = request() -> controller();
          if(in_array($controller,['Goods','Category','Brands'])){
            echo "<li class='layui-nav-item layui-nav-itemed'>";
          }else{
            echo "<li class='layui-nav-item'>";
          }
        ?>
          <a class="" href="javascript:;">商品管理</a>
          <dl class="layui-nav-child">
            <dd <?php if($controller == 'Goods'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('Goods/index'); ?>">商品管理</a></dd>
            <dd <?php if($controller == 'Category'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('Category/index'); ?>">商品分类</a></dd>
            <dd <?php if($controller == 'Brands'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('Brands/index'); ?>">商品品牌</a></dd>
            <!-- <dd><a href="">超链接</a></dd> -->
          </dl>
        </li>
        <?php
          $controller = request() -> controller();
          if(in_array($controller,['Index','User','Menu'])){
            echo "<li class='layui-nav-item layui-nav-itemed'>";
          }else{
            echo "<li class='layui-nav-item'>";
          }
        ?>
        
          <a href="javascript:;">权限管理</a>
          <dl class="layui-nav-child">
            <dd <?php if($controller == 'Index'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('Index/admin'); ?>">管理员管理</a></dd>
            <dd <?php if($controller == 'User'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('User/add'); ?>">角色管理</a></dd>
            <dd <?php if($controller == 'Menu'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('Menu/index'); ?>">菜单管理</a></dd>
            <!-- <dd><a href="">超链接</a></dd> -->
          </dl>
        </li>
        <?php
          $controller = request() -> controller();
          if(in_array($controller,['Friend'])){
            echo "<li class='layui-nav-item layui-nav-itemed'>";
          }else{
            echo "<li class='layui-nav-item'>";
          }
        ?>
        
          <a href="javascript:;">友链管理</a>
          <dl class="layui-nav-child">
            <dd <?php if($controller == 'Friend'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('Friend/add'); ?>">友链添加</a></dd>
            <!-- <dd <?php if($controller == 'Friend'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('Friend/Index'); ?>">友链展示</a></dd> -->
            <!-- <dd <?php if($controller == 'Menu'): ?>class="layui-this"<?php endif; ?>><a href="<?php echo url('Menu/index'); ?>">菜单管理</a></dd> -->
            <!-- <dd><a href="">超链接</a></dd> -->
          </dl>
        </li>
        <li class="layui-nav-item"><a href="">云市场</a></li>
        <li class="layui-nav-item"><a href="">发布商品</a></li>
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;"> 
      <style type="text/css">      
  .layui-table-cell {height: auto;line-height: 25px;}
</style>

<span class="layui-breadcrumb">
    <a href="<?php echo url('Goods/index'); ?>">首页</a>
    <a><cite>分类添加</cite></a>
    <a href="<?php echo url('Goods/add'); ?>"><button class="layui-btn">＋添加商品</button></a>
</span>
<?php echo !empty($errorMsg) ? "<script>alert('$errorMsg');</script>" : '';; ?>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend></legend>
  </fieldset>
<table class="layui-hide" id="test" lay-filter="test"></table>
 
<script type="text/html" id="toolbarDemo">
  <div class="layui-btn-container">
    <a class="layui-btn layui-btn-sm res">反选</a>
    <a class="layui-btn layui-btn-sm layui-btn-danger delAll">批量删除</a>
  </div>
</script>
 
<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<!-- 商品名称的显示 -->
<script type="text/html" id="goods_name">
  <span id="{{d.goods_id}}" class="name" menu="{{d.goods_name}}">{{d.goods_name}}</span>
</script>
<!-- 状态的显示 -->
<script type="text/html" id="is_new">
  <span class="sps" id="{{d.goods_id}}" menu="{{d.is_new}}" key="is_new">{{d.is_new==1?'<font color=009688>√</font>':'<font color=red>×</font>'}}</span>
</script>
 <!-- 状态的显示 -->
<script type="text/html" id="is_best">
  <span class="sps" id="{{d.goods_id}}" menu="{{d.is_best}}" key="is_best">{{d.is_best==1?'<font color=009688>√</font>':'<font color=red>×</font>'}}</span>
</script>
 <!-- 状态的显示 -->
 <script type="text/html" id="is_hot">
  <span class="sps" id="{{d.goods_id}}" menu="{{d.is_hot}}" key="is_hot">{{d.is_hot==1?'<font color=009688>√</font>':'<font color=red>×</font>'}}</span>
</script>
 <!-- 状态的显示 -->
 <script type="text/html" id="is_on_sale">
  <span class="sps" id="{{d.goods_id}}" menu="{{d.is_on_sale}}" key="is_on_sale">{{d.is_on_sale==1?'<font color=009688>√</font>':'<font color=red>×</font>'}}</span>
</script>

<script>
layui.use('table', function(){
  var table = layui.table
  ,form = layui.form;
  
  table.render({
    elem: '#test'
    ,url:"<?php echo url('Goods/index'); ?>"
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[
      {type: 'checkbox'}
      ,{field:'goods_id', title:'ID'}
      ,{field:'goods_sn', title:'货号',edit:'text'}
      ,{field:'goods_name', title:'商品名称', templet: '#goods_name'}
      ,{field:'shop_price', title:'本店售价'}
      ,{field:'content', title:'品牌描述'}
      ,{field:'goods_number', title:'库存'}
      ,{field:'is_new', title:'新品', templet: '#is_new', unresize: true}
      ,{field:'is_best', title:'精品', templet: '#is_best', unresize: true}
      ,{field:'is_hot', title:'热销', templet: '#is_hot', unresize: true}
      ,{field:'is_on_sale', title:'上下架', templet: '#is_on_sale', unresize: true}
      ,{fixed: 'right', title:'操作', toolbar: '#barDemo', }
    ]]
    ,page: true
    ,limit: "<?=config('page_limit')?>"
  });
  
  
  //监听行工具事件
  table.on('tool(test)', function(obj){
    var data = obj.data;
    //console.log(obj)
    if(obj.event === 'del'){
      layer.confirm('真的删除行吗', function(index){
        $.get("<?php echo url('Goods/delete'); ?>", { id: data.goods_id},
          function(data){
            if (data == 1) {
              obj.del();
              return layer.msg('删除成功');
            }else{
              layer.close(index);
              return layer.msg('删除失败');
            }
          });
        
      });
    } else if(obj.event === 'edit'){
      // alert(obj);
      // console.log(obj);
      location.href="<?php echo url('Goods/update'); ?>?id="+data.cate_id;
    }
  });
  //监听性别操作
  form.on('switch(sexDemo)', function(obj){
    // alert(111);
    var cate_id = obj.othis.prev().attr('cate_id');
    var val = obj.value;
    // console.log(val);
    // alert(111);
    // layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
    $.post("<?php echo url('Goods/checks'); ?>", { cate_id: cate_id, is_show: val });
    
  });
  //监听显示导航栏操作
  form.on('switch(sexDemos)', function(obj){
    // alert(222);
    var cate_id = obj.othis.prev().attr('cate_id');
    var val = obj.value;
    // console.log(val);
    // console.log(cate_id);
    // alert(111);
    // layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
    $.post("<?php echo url('Goods/check'); ?>", { cate_id: cate_id, is_show: val });
    
  });
  //反选操作
  $(document).on('click','.res',function(){
      // alert(11);
      $('td .layui-form-checkbox').each(function(){
        $(this).toggleClass('layui-form-checked');
      });
    });
   //批量删除
   $(document).on('click','.delAll',function(){
      // alert(11);
      var arr = [];
      $('td .layui-form-checked').each(function(){
        // $(this).toggleClass('layui-form-checked');
        var id = $(this).parent().parent().next().find('div').text();
        // console.log(id);
        arr.push(id);
      });
      $.post("<?php echo url('Goods/delAll'); ?>",{id:arr},
      function(data){
        if (data.code == 1) {
          layer.msg(data.msg);
          window.location.reload();
        }else{
          layer.msg(data.msg);
        }
        
      },'json');
    });
    
});
//商品名称设置即点即改
$(document).on('click','.name',function(){
      var id = $(this).attr('id');
      var val = $(this).attr('menu');
      // console.log(id);
      $(this).parent().html('<input type=text id=sp value='+val+'></input>');
      $('#sp').focus();
      $('#sp').blur(function(){
        var vals = $(this).val();
        // console.log(vals);
        var obj = $(this);
        $.post("<?php echo url('Goods/ajaxUpdate'); ?>", { id: id, value: vals },
            function(data){
            if (data == 1) {
              // alert(data);
              obj.parent().html('<span id='+id+' class="name" menu="'+vals+'">'+vals+'</span>');
            }else{
              // alert(data);
              obj.parent().html('<span id='+id+' class="name" menu="'+val+'">'+val+'</span>');
            }
          });
        
      });
});
//按钮设置即点即改
$(document).on('click','.sps',function(){
      var id = $(this).attr('id');
      var val = $(this).attr('menu');
      var key = $(this).attr('key');
      var obj = $(this);
      console.log(id);
      $.post("<?php echo url('Goods/ajaxUpdates'); ?>", { id: id, value: val, key: key},
          function(data){
          if (data == 1) {
            obj.attr('menu','1');
            obj.html("<font color='#009688'>√</font>");
          }else{
            obj.attr('menu','0');
            obj.html("<font color='red'>×</font>");
          }
        });
});
</script>
    </div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    @ 备案许可证编号：京ICP备19002474
  </div>
</div>

<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>