<?php /*a:1:{s:61:"D:\phpStudy\WWW\tp5.1\application\admin\view\login\index.html";i:1551263128;}*/ ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理-登陆</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin.css">
    <script src="/static/js/jquery-3.3.1.min.js"></script>
</head>
<body>
<div id="container">
    <div></div>
    <div class="admin-login-background">
        <!-- <div class="admin-header">
        <img src="image/ex_logo.png" class="admin-logo">
        </div> -->
        <form class="layui-form" action="<?php echo url('Login/index'); ?>" method="POST">
            <div>
                <i class="layui-icon layui-icon-username admin-icon admin-icon-username"></i>
                <input type="text" name="admin_name" placeholder="请输入用户名"
                       autocomplete="off"
                       class="layui-input admin-input admin-input-username" value="<?php echo isset($data['admin_name']) ? htmlentities($data['admin_name']) : ''; ?>">
            </div>
            <div>
                <i class="layui-icon layui-icon-password admin-icon admin-icon-password"></i>
                <input type="password" name="admin_pwd"
                       placeholder="请输入密码"
                       autocomplete="off"
                       class="layui-input admin-input" value="<?php echo isset($data['admin_pwd']) ? htmlentities($data['admin_pwd']) : ''; ?>">
            </div>
            <div>
                <input type="text" name="verify"
                       placeholder="请输入验证码"
                       autocomplete="off"
                       class="layui-input admin-input admin-input-verify">
                <img class="admin-captcha" width="90" height=30 src="<?php echo url('Login/verify'); ?>" alt="captcha"
                     onclick="this.src='<?php echo url('Login/verify'); ?>';">
                <p style="color:red;"> <b><?php echo isset($errorMsg) ? htmlentities($errorMsg) : ''; ?></b> </p>
            </div><span id="span"></span>
            <button class="layui-btn admin-button" lay-submit lay-filter="formDemo">登陆</button>


        </form>
    </div>
</div>
<script src="/static/layui/layui.js"></script>
<script>
    $("button").click(function(){
        if ($("input[name='admin_name']").val()=='') {
            $('#span').html('<font color="red">用户名不能为空</font>');
            return false;
        }else if($("input[name='admin_pwd']").val()==''){
            $('#span').html('<font color="red">密码不能为空</font>');
            return false;
        }else if($("input[name='verify']").val()==''){
            $('#span').html('<font color="red">验证码不能为空</font>');
            return false;
        }
    });
    

</script>
</body>
</html>
