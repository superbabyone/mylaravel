<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/*
    随机盐值
*/
function setSale()
{
    $long = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRETUVWXYZ~!@#$%^&*_+';
    // substr($long,26,5);
    $sale = substr(str_shuffle($long),0,5);
    return $sale;
}
// 无限极分类
function createTree($data,$field='cate_id',$parent_id = 0,$level = 1)
{
    static $result = [];
    if ($data) {
        foreach ($data as $key => $val) {
            if ($val['parent_id'] == $parent_id) {
                $val['level'] = $level;
                $result[] = $val;
                createTree($data,$field='cate_id',$val[$field],$level+1);
            }
        }
        return $result;
    }

}
// 无限极分类
function createTrees($data,$parent_id = 0,$level = 1)
{
    static $result = [];
    if ($data) {
        foreach ($data as $key => $val) {
            if ($val['parent_id'] == $parent_id) {
                $val['level'] = $level;
                $result[] = $val;
                createTrees($data,$val['menu_id'],$level+1); 
            }
        }
        return $result;
    }

}
// 无限极分类
function createSonTree($data,$parent_id=0)
{
    $result = [];
    if ($data) {
        foreach ($data as $key => $val) {
            if ($val['parent_id'] == $parent_id) {
                $result[$key] = $val;
                $result[$key]['son'] = createSonTree($data,$val['cate_id']);
            }
        }
        return $result;
    }

}
//上传文件
function upload($img)
{
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file($img);
    // 移动到框架应用根目录/uploads/ 目录下
    $info = $file->move('./uploads');
    if($info){
        // 成功上传后 获取上传信息
        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        return json_encode(['code'=>0,'msg'=>$info->getSaveName()]);
    }else{
        // 上传失败获取错误信息 
        return json_encode(['code'=>1,'msg'=>$file->getError()]);
    }
}

//无限极分类
function getInfo($c_info,$parent_id=0)
{
    $info=[];
    foreach($c_info as $k=>$v){
        if($v['parent_id']==$parent_id){
            $son=getInfo($c_info,$v['cate_id']);
            $v['son']=$son;
            $info[]=$v;
        }
    }
    return $info;
}
//获取cateid
function getCateId($cateInfo,$parent_id)
{
    static $id=[];
    foreach($cateInfo as $k=>$v){
        if($v['parent_id']==$parent_id){
            $id[]=$v['cate_id'];
            getCateId($cateInfo,$v['cate_id']);
        }
    }
    return $id;
}
//成功后返回的JSON
function successly($font)
{
    echo json_encode(['font'=>$font,'code'=>'1']);
}
//失败后返回的JSON
function fail($font)
{
    echo json_encode(['font'=>$font,'code'=>'2']);exit;
}

function createCode()
{
    return rand(100000,999999);
}

//邮件发送
function sendEmail($email,$code)
{
    //实例化PHPMailer核心类
    $mail = new \email\PHPMailer();


    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug =0;

    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();

    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;

    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.163.com';//163邮箱：smtp.163.com

    //设置使用ssl加密方式登录鉴权
    //$mail->SMTPSecure = 'ssl';//163邮箱就注释

    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 25;//163邮箱：25

    //设置smtp的helo消息头 这个可有可无 内容任意
    // $mail->Helo = 'Hello smtp.qq.com Server';

    //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    //$mail->Hostname = 'http://localhost/';

    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';

    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = 'root';

    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='achenvaya@163.com';

    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
    $mail->Password = 'admin123';//163邮箱也有授权码 进入163邮箱帐号获取

    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = 'achenvaya@163.com';

    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);

    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($email);

    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','爱代码，爱生活世界');

    //添加该邮件的主题
    $mail->Subject = '注册成功';

    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = '验证码为:'.$code.'请妥善保管，打死不要说！';

    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    // $mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

    $status = $mail->send();

    //简单的判断与提示信息
    if($status) {
    return 'ok';
    }else{
    return 'no';
    }

}

//给字符串加密 传数组  返回加密的字符串
function createBase64Info($info)
{
    $str = base64_encode(serialize($info));
    return $str;
}
//取加密的数据(解密)  传字符串 返回解密的数组
function getBase64Info($str)
{
    $arr = unserialize(base64_decode($str));
    return $arr;
}
//发送链接
function sendLink($email)
{
    //实例化PHPMailer核心类
    $mail = new \email\PHPMailer();


    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug =0;

    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();

    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;

    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.163.com';//163邮箱：smtp.163.com

    //设置使用ssl加密方式登录鉴权
    //$mail->SMTPSecure = 'ssl';//163邮箱就注释

    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 25;//163邮箱：25

    //设置smtp的helo消息头 这个可有可无 内容任意
    // $mail->Helo = 'Hello smtp.qq.com Server';

    //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
    //$mail->Hostname = 'http://localhost/';

    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';

    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = 'root';

    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username ='achenvaya@163.com';

    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
    $mail->Password = 'admin123';//163邮箱也有授权码 进入163邮箱帐号获取

    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = 'achenvaya@163.com';

    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);

    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($email);

    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','爱代码，爱生活世界');

    //添加该邮件的主题
    $mail->Subject = '爬进去  有惊喜！*.*！';

    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = '复制此链接到浏览器自己看着办吧: http://w3.shop.com/index/login/newpwd';

    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    // $mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

    $status = $mail->send();

    //简单的判断与提示信息
    if($status) {
    return 'ok';
    }else{
    return 'no';
    }

}