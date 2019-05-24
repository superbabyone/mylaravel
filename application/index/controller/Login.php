<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\facade\Session;

class Login extends Common
{
//注册
    public function register()
    {
        $this->view->engine->layout(false);
        return view();
    }
    //验证邮箱格式并发送验证码
    public function checkEmail()
    {
        $reg='/^\w+@+\w+\.com$/';
        $email = input('post.email');
        //清除SESSION
        session('emailInfo',null);
        if($email==''){
            fail('邮箱不能为空');
        }else if(!preg_match($reg,$email)){
            fail('邮箱格式不正确');
        }else{
            $count=model('User')->where('u_email',$email)->count();
            if($count>0){
                fail('邮箱已存在');
            }else{
                $code=createCode();
                $res = sendEmail($email,$code);
                // echo $email;
                if($res){
                    $emailInfo=[
                        'u_email'=>$email,
                        'u_code'=>$code,
                        'create_time'=>time(),
                    ];
                    session('emailInfo',$emailInfo);
                    // echo session("emailInfo['u_code']");exit;
                    successly('发送成功！');
                }else{
                    fail('发送失败！');
                }
            }
        }
    }
    //验证验证码
    public function checkCode()
    {
        $time = time();
        $code = input('post.code');
        $email = input('post.email');
        Session::start();
        $emailInfo = session('emailInfo');
        if(!empty($code) || !empty($email)){
            $oldCode = session('emailInfo.u_code');
            $oldEmail = $emailInfo['u_email'];
            $oldTime = $emailInfo['create_time'];
            //  dump($oldCode);dump($oldEmail);dump($oldTime);
            if($code != $oldCode || $email !=$oldEmail){
                fail('验证码或邮箱不正确！');
            }else{
                if($time - $oldTime >300){
                    fail('验证码失效！');
                }else{
                        successly('请填写密码！');
                }
            }
        }
    }
    //验证密码  并入库
    public function checkPwd()
    {
        $email = input('post.email');
        $code = input('post.code');
        $pwd = input('post.pwd');
        $unPwd = input('post.unPwd');
        if(!empty($pwd) || !empty($unPwd)){
            if($pwd == $unPwd){
                $res = model('User')->save([
                    'u_email' => $email,
                    'u_code' => $code,
                    'u_pwd' => md5($pwd),
                    'create_time' => time(),
                ]);
                if($res){
                    successly('注册成功！');
                }else{
                    fail('注册失败！');
                }
            }else{
                fail('两次密码不一致！');
            }
        }else{
            fail('密码个确认密码都得填！');
        }
    }

    //session测值
    public function test(){
        $data = session("sessionInfo");
        $arr = cookie('rememberInfo');
        dump($data);dump($arr);
    }
//登陆
    public function login()
    {
        $this->view->engine->layout(false);
        return view();
    }
    //验证登录 
    public function checkLogin()
    {
        $account = input('post.account');
        $user_pwd = input('post.user_pwd');
        $remember_me = input('post.remember_me');
        $data['u_pwd'] = $user_pwd;
        $data['u_email'] = $account;
        $info = model('User')->where('u_email',$account)->find();
        //准备数据
        $oldPwd = $info['u_pwd'];
        $oldEmail = $info['u_email'];
        $error_num = $info['error_num'];
        $last_error_time = $info['last_error_time'];
        $time = time();
        $where = [
            ['u_id','=',$info['u_id']]
        ];
        //验证数据
        $validate = validate('User');
        if(!$validate->check($data)){
            fail($validate->getError());exit;
        }
        if($oldPwd == md5($user_pwd)){
            // echo '密码正确';
            if($error_num>=3 && ($time-$last_error_time) < 3600){
                $newTime = 60-ceil(($time-$last_error_time)/60);
                fail('证号被关进小黑屋啦，请在'.$newTime.'分钟后再试');
                $updateInfo = ['error_num'=>0,'last_error_time'=>''];
                $res = model('User')->where($where)->update($updateInfo);
            }else{
                //记住密码勾选的话 把密码和证号存在cookie中
                if($remember_me == 'true'){
                    $rememberInfo = [
                        'u_email' => $account,
                        'u_pwd' => $user_pwd
                    ];
                    cookie('rememberInfo',$rememberInfo,60*60*24*10);
                }
            }
            //登陆成功  把用户ID和账号存入session
            $sessionInfo = [
                'u_id' => $info['u_id'],
                'u_email' => $info['u_email']
            ];
            session('sessionInfo',$sessionInfo);
            //登陆成功后同步浏览记录
            $this->asyncHistory();
            //同步购物车数据
            $this->asyncCar();
            successly('成功逃出！');
        }else{
            // echo '密码错误';
            if($time - $last_error_time >3600){
                $updateInfo = ['error_num'=>1,'last_error_time'=>$time];
                $res = model('User')->where($where)->update($updateInfo);
                if($res){
                    fail('您还有2次机会');
                }
            }else{
                    if($error_num >= 3){
                    fail('您的证号被关进小黑屋啦，一小时后登陆');
                }else{
                    $updateInfo = ['error_num'=>$error_num+1,'last_error_time'=>$time];
                    $res = model('User')->where($where)->update($updateInfo);
                    if($res){
                        fail('您还有'.(3-($error_num+1)).'次机会');
                    }
                }
            }
        }   
    }
    //退出 清除session和cookie
    public function loginOut()
    {
        session('sessionInfo',null);
        cookie('rememberInfo',null);
        $this->redirect('login/login');
    }

//找回密码
    public function findPwd()
    {
        $this->view->engine->layout(false);
        return view();
    }
    //ajax接受数据  验证邮箱 发送邮件
    public function checkBelongEmail()
    {
        $email = input('post.email');
        $info = model('User')->where('u_email',$email)->find();
        if(empty($info)){
            fail('请输入要找回密码的邮箱'); 
        }else{
            $res = sendLink($email);
            $sessionInfo = [
                'email'=>$email,
            ];
            session('reEmail',$sessionInfo);
            if($res){
                successly('发送成功,请前往邮箱查收邮件');
            }else{
                fail('发送失败');
            }
        }
    }
    //找回密码界面
    public function newPwd()
    {
        $this->view->engine->layout(false);
        return view();
    }
   //ajax  接受数据 修改密码
    public function setNewPwd()
    {
        $email = session('reEmail.email');
        $pwd = input('post.pwd');
        $rePwd = input('post.rePwd');
        $info = model('User')->where('u_email',$email)->find();
        if(empty($pwd)){
            fail('密码必填');
        };
        if(empty($rePwd)){
            fail('确认密码必填');
        };
        if($pwd != $rePwd){
            fail('两次密码输入的不一致！');
        }else{
            if(md5($pwd) == $info['u_pwd']){
                fail('修改密码不能和原密码一致！');
            }else{
                $res = model('User')->where('u_email',$email)->update(['u_pwd' => md5($pwd)]);
                if($res){
                    successly('修改成功');
                }else{
                    fail('修改失败');
                }
            }
        }
    }
}
    //