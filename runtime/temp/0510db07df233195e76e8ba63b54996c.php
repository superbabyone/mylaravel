<?php /*a:5:{s:62:"D:\phpStudy\WWW\tp5.1\application\admin\view\index\update.html";i:1551067225;s:56:"D:\phpStudy\WWW\tp5.1\application\admin\view\layout.html";i:1550652373;s:63:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\header.html";i:1554427842;s:61:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\left.html";i:1551940195;s:63:"D:\phpStudy\WWW\tp5.1\application\admin\view\public\footer.html";i:1551775700;}*/ ?>

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
        <a href="<?php echo url('Index/admin'); ?>">首页</a>
        <a><cite>管理员添加</cite></a>
    </span>
    <?php echo !empty($errorMsg) ? "<script>alert('$errorMsg');</script>" : '';; ?>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend></legend>
      </fieldset>
    <form class="layui-form" action="<?php echo url('Index/doUpdate'); ?>" method="post">
        <input type="hidden" name="admin_id" value="<?php echo htmlentities($list['admin_id']); ?>">
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">用户名</label>
                <div class="layui-input-inline">
                    <input type="text" name="admin_name" value="<?php echo htmlentities($list['admin_name']); ?>"  autocomplete="off" placeholder="请输入用户名" class="layui-input" value="<?php echo !empty($data['admin_name']) ? htmlentities($data['admin_name']) : '';; ?>">
                </div>
            </div>
            <span class="sp"></span>
        </div>
        <div class="layui-form-item">
                <div class="layui-inline">
                  <label class="layui-form-label">邮箱</label>
                  <div class="layui-input-inline">
                    <input type="text" name="email" value="<?php echo htmlentities($list['email']); ?>" placeholder="请输入邮箱" autocomplete="off" class="layui-input" value="<?php echo !empty($data['email']) ? htmlentities($data['email']) : '';; ?>">
                  </div>
                </div>
                <span class="sp"></span>
              </div>
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                    <input type="password" name="pwd" placeholder="请输入密码" autocomplete="off" class="layui-input" value="<?php echo !empty($data['pwd']) ? htmlentities($data['pwd']) : '';; ?>">
                </div>
            </div>
            <span class="sp"></span>
        </div>
    
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">确认密码</label>
                <div class="layui-input-inline">
                    <input type="password" name="repwd" placeholder="请再次密码" autocomplete="off" class="layui-input" value="<?php echo !empty($data['re_pwd']) ? htmlentities($data['re_pwd']) : '';; ?>">
                </div>
            </div>
            <span class="sp"></span>
        </div>
        
        
    
        <div class="layui-form-item">
          <div class="layui-input-block">
              
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </form>
    <script>
        $('input:eq(1)').blur(function(){
            name();
        });
        $('input:eq(2)').blur(function(){
            email();
        });
        $('input:eq(3)').blur(function(){
            pwd();
        });
        $('input:eq(4)').blur(function(){
            repwd();
        });
        var flag = false;
        var flag1 = false;
        var flag2 = false;
        var flag3 = false;
        function name() {
            var data = $('input:eq(1)').val();
            var span = $('.sp:eq(0)');
            if (data == '') {
                span.html("<font color='red'>用户名不能为空！</font>");
                flag = false;
            }else{
                var reg = /^[\w\u4E00-\u9FA5-]{2,20}$/;
                var id = $("input[name='admin_id']").val();
                if (reg.test(data)) {
                    $.post("<?php echo url('Index/doUser'); ?>", { name: data ,id:id},
                    function(data){
                        if (data == 1) {
                            span.html("<font color='red'>该用户名已存在</font>");
                            flag = false;
                        }else{
                            span.html("<font color='green'>√</font>");
                            flag = true;
                        }
                    });
                }else{
                    span.html("<font color='red'>请输入2-20位的数字、字母、下划线或中文！</font>");
                    flag = false;
                }
            }
        };
        function pwd() {
            var data = $('input:eq(3)').val();
            var span = $('.sp:eq(2)');
            if (data == '') {
                span.html("<font color='red'>密码不能为空！</font>");
                flag1 = false;
            }else{
                var reg = /^\w{8,20}$/;
                if (reg.test(data)) {
                    span.html("<font color='green'>√</font>");
                    flag1 = true;
                }else{
                    span.html("<font color='red'>请输入8-20位的数字、字母、下划线！</font>");
                    flag1 = false;
                }
            }
        };
        function repwd() {
            var pwd = $('input:eq(3)').val();
            var data = $('input:eq(4)').val();
            var span = $('.sp:eq(3)');
            if (data == '') {
                span.html("<font color='red'>重复密码不能为空！</font>");
                flag2 = false;
            }else{
                if (pwd == data) {
                    span.html("<font color='green'>√</font>");
                    flag2 = true;
                }else{
                    span.html("<font color='red'>两次密码不一致！</font>");
                    flag2 = false;
                }
            }
        };
        function email() {
            var data = $('input:eq(2)').val();
            var span = $('.sp:eq(1)');
            if (data == '') {
                span.html("<font color='red'>邮箱不能为空！</font>");
                flag3 = false;
            }else{
                var reg=/^\w+@[a-zA-Z0-9]{2,10}(?:\.[a-z]{2,4}){1,3}$/;
                if (reg.test(data)) {
                    span.html("<font color='green'>√</font>");
                    flag3 = true;
                }else{
                    span.html("<font color='red'>邮箱地址不合法！</font>");
                    flag3 = false;
                }
            }
        };
        $('.layui-btn:eq(0)').click(function() {
            name();
            email();
            if ($('input:eq(3)').val() != '') {
                pwd();
                repwd();
                return flag && flag1 && flag2 && flag3;
            }else{
                return flag && flag3;
            }
            // return flag && flag1 && flag2 && flag3;
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