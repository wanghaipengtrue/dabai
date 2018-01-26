<?php
/*
 * @注册
 * user
 * doctor
 * hospital
 * */
namespace app\index\controller;

use app\index\model\Member;
use think\Request;
use think\Session;
use think\cache\driver\Redis;

class Register extends Base
{

   //用户注册

    public function  user()
    {
        $redis = new redis();

        echo $redis->get("15210086671");

        $controller = $this->controller;
        return $this->fetch('user',['controller'=>$controller]);
    }
    public function  userDo()
    {
        $Mobile =  input('regMobile'); // 手机号
        $captcha = input('imgVerifycode');//图形
        $code = input('regmCode');//手机验证码
        $Password = input('regPassword');// 密码
        //验证数据
        $rule = [
            'regMobile'  =>  $Mobile,
            'code' =>  $code,
            'regPassword' =>  $Password,
        ];
        //加载验证器
        $msgValidate = $this->validate($rule,'Register');
        if(true !== $msgValidate){
            return ['status'=>0,'msg'=>"$msgValidate"];
        }
        //验证图形验证码
       if(!captcha_check($captcha)){
            return ['status'=>0,'msg'=>"请输入正确的图形验证码!"];
           die();
        };
        //验证手机验证码
        $redis = new redis();
        if($redis->get("$Mobile") != $code){
            return ['status'=>0,'msg'=>"手机验证码错误!"];
            die();
        };
        $member = new Member();
        $memberR = $member->getMemberone("$Mobile");
        if (!empty($memberR)){
            return ['status'=>0,'msg'=>"手机号已注册!"];
        }

        //加密插件 phpass-3.0
        $PasswordHashs = new \PasswordHashs(8, false);
        $hashedPassword = $PasswordHashs->HashPassword("$Password"); // 计算密码的哈希
        $memberStats = $member->addMember("$Mobile","$hashedPassword");
        if ($memberStats == true){
            $Tmsg = "注册成功！";
            $Turl = Url('/index');
            return ['status'=>1,'msg'=>"$Tmsg",'Turl'=>"$Turl"];
            exit();
        }else{
            $Tmsg = "注册失败！";
            return ['status'=>0,'msg'=>"$Tmsg"];
            exit();
        }
    }

    //医生注册
    public function  doctor()
    {


        return $this->fetch('doctor');

    }

    //医院入驻
    public function  hospital()
    {
        return $this->fetch('hospital');

    }
    public function  upload()
    {


    }



}
