<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 16:34
 */

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Smsm;

class Sms extends Base
{
   public  function sendSms(){
       $phoneNumbers =  input('regMobile'); // 手机号
       $controller = input('controller');//图形
       $vertify = input('vertify');//图形
       $rule = [
           'regMobile'  =>  $phoneNumbers
       ];
       //加载验证器
       $msgValidate = $this->validate($rule,'Register');
       if(true !== $msgValidate){
           return ['status'=>0,'msg'=>"$msgValidate"];
       }
       //验证图形验证码
       if(!captcha_check($vertify)){
           $codeMsg = $this->showReturnCodeMsg('4000');
           return ['status'=>2,'msg'=>"$codeMsg[msg]"];
           exit();
       };
       if ($controller == 'Register'){
           $templateCode = "SMS_109400226"; //注册
       } elseif($controller == 'Login'){
           $templateCode = "SMS_109420230"; //登录
       }elseif($controller == 'Findpassword'){
           $templateCode = "SMS_109485200"; //找回密码
       }   //SMS_110830187绑定
       $regSms = new Smsm();
       $codeState = $regSms ->smsmSend("$phoneNumbers","$templateCode");
       //判断是否重复发送
       if($codeState == '202'){
           $codeMsg = $this->showReturnCodeMsg('3002');
           return ['status'=>0,'msg'=>"$codeMsg[msg]"];
           exit();
       }
       if ($codeState == true) {
           $codeMsg = $this->showReturnCodeMsg('3000');
           return ['status'=>1,'msg'=>"$codeMsg[msg]"];
       }else{
           $codeMsg = $this->showReturnCodeMsg('3001');
           return ['status'=>0,'msg'=>"$codeMsg[msg]"];
       }

   }

}