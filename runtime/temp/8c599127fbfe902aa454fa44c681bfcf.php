<?php /*a:5:{s:61:"D:\phpStudy\WWW\tp5.1\application\admin\view\index\admin.html";i:1551844298;s:56:"D:\phpStudy\WWW\tp5.1\application\admin\view\layout.html";i:1550652373;s:63:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\header.html";i:1554427842;s:61:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\left.html";i:1551940195;s:63:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\footer.html";i:1551775700;}*/ ?>

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
      <span class="layui-breadcrumb">
    <a href="/demo/">首页</a>
    <a><cite>管理员添加</cite></a>
    <a href="<?php echo url('Index/add'); ?>"><button class="layui-btn">＋添加管理员</button></a>
</span>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  </fieldset>

  <form class="layui-form layui-form-pane" action="<?php echo url('Index/admin'); ?>">
      <div class="layui-form-item">
        <label class="layui-form-label">搜索条件</label>
        <div class="layui-input-inline">
          <select name="types">
            <option value="">请选择搜索条件</option>
            <option value="admin_name" <?php if(isset($_GET['types']) && ($_GET['types'] == 'admin_name')): ?>selected<?php endif; ?>>用户名</option>
            <option value="email" <?php if(isset($_GET['types']) && ($_GET['types'] == 'email')): ?>selected<?php endif; ?>>邮箱</option>
          </select>
        </div>
          <div class="layui-input-inline">
              <input type="text" name="keywords" placeholder="请输入搜索内容" autocomplete="off" class="layui-input" value="<?php echo isset($_GET['keywords']) ? htmlentities($_GET['keywords']) : '';; ?>">
          </div>
          <button class="layui-btn layui-btn-primary">搜索</button>
    </form>

    <div style="margin-bottom: 20px;"></div>

  <div class="layui-form page">
    <table class="layui-table">
      <colgroup>
        <col width="150">
        <col width="150">
        <col width="200">
        <col>
      </colgroup>
      <thead>
        <tr>
          <th><input type="checkbox" name="ids[]">ID</th>
          <th>用户名</th>
          <th>邮箱</th>
          <th>注册时间</th>
          <th>IP地址</th>
          <th>最后登陆时间</th>
          <th>操作</th>
        </tr> 
      </thead>
      <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>    
        <tr>
            <td><input type="checkbox" name="ids[]" id="<?php echo htmlentities($vo['admin_id']); ?>"><span id="<?php echo htmlentities($vo['admin_id']); ?>" class="sps"><?php echo htmlentities($vo['admin_id']); ?></span></td>
            <td><span id="<?php echo htmlentities($vo['admin_id']); ?>" class="sps"><?php echo htmlentities($vo['admin_name']); ?></span></td>
            <td><?php echo htmlentities($vo['email']); ?></td>
            <td><?php echo htmlentities(date('Y-m-d H:i:s',!is_numeric($vo['addtime'])? strtotime($vo['addtime']) : $vo['addtime'])); ?></td>
            <td><?php echo htmlentities($vo['ip']); ?></td>
            <td><?php echo $vo['lasttime']==0 ? '从未登录' : htmlentities(date('Y-m-d H:i:s',!is_numeric($vo['lasttime'])? strtotime($vo['lasttime']) : $vo['lasttime'])); ?></td>
            <td>
                <a class="layui-btn" href="<?php echo url('Index/update','admin_id='.$vo['admin_id']); ?>">修改</a>
                <a href="javascript:if(confirm('您确定删除这条记录吗')) location='<?php echo url('Index/del',['admin_id'=>$vo['admin_id']]); ?>'" class="layui-btn layui-btn-danger">删除</a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
      
    </table>
    <a class="layui-btn toggle" href="javascript:">反选</a>
    <a class="layui-btn layui-btn-danger delAll" href="javascript:">批量删除</a>
    <div id="page" style="margin: 0 auto;">
      <?php echo $list; ?>
    </div>

  </div>
             
    <script>
    layui.use(['form'], function(){
      var form = layui.form
    });
    //获取分页的盒子宽度
    var width = $('.pagination').width();
    //动态设置盒子的宽度
    $('#page').css('width',width+1);
    //设置即点即改
    // $(document).on();
    $(document).on('click','.sps',function(){
      var id = $(this).attr('id');
      var val = $(this).text();
      // console.log(val);
      $(this).parent().html('<input type=text id=sp value='+val+'></input>');
      $('#sp').focus();
      $('#sp').blur(function(){
        var vals = $(this).val();
        // console.log(vals);
        var obj = $(this);
        $.post("<?php echo url('Index/ajaxUpdate'); ?>", { id: id, value: vals },
            function(data){
            if (data == 1) {
              // alert(data);
              obj.parent().html('<span id='+id+' class="sps">'+vals+'</span>');
            }else{
              // alert(data);
              obj.parent().html('<span id='+id+' class="sps">'+val+'</span>');
            }
          });
        
      });
    });
    //无刷新分页
    $(document).on('click','.pagination a',function(){
      var url = $(this).attr('href');
      $.post(url, 
          function(data){
            $('.page').html(data);
          });
      return false;
    });
    // 全选/全不选操作
    $(document).on('click','th .layui-form-checkbox',function(){
      // alert(111);
      var className = $(this).attr('class');
      $('td .layui-form-checkbox').each(function(){
        $(this).attr('class',className);
      });
    });
    // 反选操作
    $(document).on('click','.toggle',function(){
      $('td .layui-form-checkbox').each(function(){
        $(this).toggleClass('layui-form-checked');
      });
    });
    //批量删除操作
    $('.delAll').click(function(){
      if (confirm('您确定要删除吗？')) {
        var arr = new Array();
      $('td .layui-form-checked').each(function(index){
        var id = $(this).prev().attr('id');
        arr.push(id);
      });
      $.post("<?php echo url('Goods/delAll'); ?>", { ids: arr },
          function(data){
            if (data == 1) {
              layer.msg('删除成功');
              window.location.reload();
            }else{
              return layer.msg('未知错误，删除失败');
            }
          });
      }
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