<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Smsm;
use think\Request;
use think\Session;

/*
 * ==用户登录控制器==
 * @user    用户登录页面
 * @userDo  用户登录处理
 * @userMobile  用户手机登录
 * @userMobileDo    用户手机登录处理
 * @doctor  医生登录
 * @doctor  医生登录处理
 * @loginSms    手机发送短信 登录所有适用 *
 * */

class Login extends Controller
{
    public  $regIp = ""; //ip
    public  $controller;
   public function __construct(Request $request = null)
   {
       parent::__construct($request);
       $request = Request::instance();
       $this->regIp = $request->ip();
       $this->controller = $request->controller();
       //检测用户登录
       /*$isCheck =new Check();
       $isCheck->isCheckUser();*/
   }

    public function  index()
    {

        return $this->fetch("user");
    }
    public function  user()
    {

        return $this->fetch("user");
    }
    public  function userDo(){
        $Mobile =  input('regMobile'); // 手机号
        $captcha = input('imgVerifycode');//图形
        $Password = input('regPassword');// 密码
        //验证数据
        $rule = [
            'regMobile'  =>  $Mobile,
            'regPassword' =>  $Password
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
        $memberR = db('member')->where('phone',"$Mobile")->find();
        if(empty($memberR)){
            return ['status'=>0,'msg'=>"账号不存在!"];
            die();
        }
        $PasswordHashs = new \PasswordHashs(8, false);
        $PassworCheck = $PasswordHashs->CheckPassword("$Password", $memberR['password']);
        if ($PassworCheck){
            Session::set('isPhone',$memberR['phone']);
            db('member')->where('id', $memberR['id'])->setInc('more');
            $Tmsg = "登录成功！";
            $Turl = Url('/index');
            return ['status'=>1, 'msg'=>"$Tmsg",'Turl'=>"$Turl"];
        }else{
            $Tmsg = "密码错误,请重新输入!";
            return ['status'=>0, 'msg'=>"$Tmsg"];
        }

    }
    //用户手机登录
    public function  userMobile()
    {
        $controller = $this->controller;

        return $this->fetch("usermobile",['controller'=>$controller]);
    }
    //用户手机登录操作
    public function  userMobileDo()
    {
        $Mobile =  input('regMobile'); // 手机号
        $captcha = input('imgVerifycode');//图形
        $regmCode = input('regmCode');// 密码
        //验证数据
        $rule = [
            'regMobile'  =>  $Mobile,
            'code' =>  $regmCode
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
        }
        if(Session::get("$Mobile") == $regmCode){
            Session::set('isPhone',$Mobile);
            $Tmsg = "登录成功！";
            $Turl = Url('/index');
            return ['status'=>1, 'msg'=>"$Tmsg",'Turl'=>"$Turl"];
        }else{
            return ['status'=>0,'msg'=>"手机验证码错误!"];
            die();
        }

    }
    //医生登录
    public function  doctor()
    {
        echo 1112222;

    }
    //找回密码
    public function  findPassword()
    {
        return $this->fetch("findpassword");
    }

    //登录手机验证码
    /*public function loginSms(){
        $phoneNumbers =  input('regMobile');
        $templateCode = "SMS_109420230";
        $regSms = new Smsm();
        $codeState = $regSms ->smsmSend("$phoneNumbers","$templateCode");

        if ($codeState == true) {
            return ['status'=>1,'msg'=>"发送成功"];
        }else{
            return ['status'=>0,'msg'=>"发送失败"];
        }
    }*/

}
