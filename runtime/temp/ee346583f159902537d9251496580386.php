<?php /*a:5:{s:62:"D:\phpStudy\WWW\tp5.1\application\admin\view\brands\index.html";i:1551353174;s:56:"D:\phpStudy\WWW\tp5.1\application\admin\view\layout.html";i:1550652373;s:63:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\header.html";i:1554427842;s:61:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\left.html";i:1551940195;s:63:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\footer.html";i:1551775700;}*/ ?>

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
    <a href="<?php echo url('Brands/index'); ?>">首页</a>
    <a><cite>品牌添加</cite></a>
    <a href="<?php echo url('Brands/add'); ?>"><button class="layui-btn">＋添加品牌</button></a>
</span>
<?php echo !empty($errorMsg) ? "<script>alert('$errorMsg');</script>" : '';; ?>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend></legend>
  </fieldset>
<table class="layui-hide" id="test" lay-filter="test"></table>
 
<script type="text/html" id="toolbarDemo">
  <div class="layui-btn-container">
    <button class="layui-btn layui-btn-sm" lay-event="getCheckData">获取选中行数据</button>
    <button class="layui-btn layui-btn-sm" lay-event="getCheckLength">获取选中数目</button>
    <button class="layui-btn layui-btn-sm" lay-event="isAll">验证是否全选</button>
  </div>
</script>
 
<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<!-- 品牌名称的跳转 -->
<script type="text/html" id="usernameTpl">
  <a href="{{d.brand_url}}" class="layui-table-link" target="_blank">{{ d.brand_name }}</a>
</script>
<!-- 状态的显示 -->
<script type="text/html" id="switchTpl">
  <!-- 这里的 checked 的状态只是演示 -->
  <input type="checkbox" name="is_show" brand_id="{{d.brand_id}}" value="{{d.is_show}}" lay-skin="switch" lay-text="是|否" lay-filter="sexDemo" {{ d.is_show == 1 ? 'checked' : '' }}>
</script>
 
<script type="text/html" id="brand_logo">
  <img src="http://uploads.com/{{d.brand_logo}}" >
</script>

<script>
layui.use('table', function(){
  var table = layui.table
  ,form = layui.form;
  
  table.render({
    elem: '#test'
    ,url:"<?php echo url('Brands/index'); ?>"
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[
      {type: 'checkbox'}
      ,{field:'brand_id', title:'ID'}
      ,{field:'brand_name', title:'品牌名称', edit: 'text', templet: '#usernameTpl'}
      ,{field:'brand_url', title:'品牌地址',  edit: 'text'}
      ,{field:'brand_logo', title:'品牌logo', edit: 'text', templet: '#brand_logo'}
      ,{field:'brand_desc', title:'品牌描述', }
      ,{field:'is_show', title:'是否显示', templet: '#switchTpl', unresize: true}
      ,{fixed: 'right', title:'操作', toolbar: '#barDemo', }
    ]]
    ,page: true
    ,limit: "<?=config('page_limit')?>"
  });
  
  //头工具栏事件
  table.on('toolbar(test)', function(obj){
    var checkStatus = table.checkStatus(obj.config.id);
    switch(obj.event){
      case 'getCheckData':
        var data = checkStatus.data;
        layer.alert(JSON.stringify(data));
      break;
      case 'getCheckLength':
        var data = checkStatus.data;
        layer.msg('选中了：'+ data.length + ' 个');
      break;
      case 'isAll':
        layer.msg(checkStatus.isAll ? '全选': '未全选');
      break;
    };
  });
  
  //监听行工具事件
  table.on('tool(test)', function(obj){
    var data = obj.data;
    //console.log(obj)
    if(obj.event === 'del'){
      layer.confirm('真的删除行吗', function(index){
        $.get("<?php echo url('Brands/delete'); ?>", { id: data.brand_id},
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
      console.log(obj);
      location.href="<?php echo url('Brands/update'); ?>?id="+data.brand_id;
    }
  });
  //监听性别操作
  form.on('switch(sexDemo)', function(obj){
    var brand_id = obj.othis.prev().attr('brand_id');
    var val = obj.value;
    // console.log(val);
    // alert(111);
    // layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
    $.post("<?php echo url('Brands/check'); ?>", { brand_id: brand_id, is_show: val });
    
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