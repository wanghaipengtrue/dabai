<?php
/*
 * @注册
 * user
 * doctor
 * hospital
 * */
namespace app\index\controller;

use app\index\model\Member;
use app\index\model\Doctor as DoctorModel;
use think\Request;

class Register extends Base
{
   //用户注册
    public function  user()
    {
        echo $this->RedisSession->read("15210086671");
        return $this->fetch('user',['controller'=>$this->controller]);
    }
    public function reguser(Request $request=null)
    {
        if($request->isAjax()){
            $Mobile =  input('regMobile'); // 手机号
            $code = input('regmCode');//手机验证码
            $Password = input('regPassword');// 密码
            //验证数据
            $rule = [ 'regMobile'=>$Mobile,'code'=>$code,'regPassword'=>$Password];
            //加载验证器
            $msgValidate = $this->validate($rule,'Register');
            if(true !== $msgValidate){
                return ['status'=>0,'msg'=>"$msgValidate"];
            }
            //验证手机验证码
            if($this->RedisSession->read("$Mobile") != $code){
                $codeMsg = $this->showReturnCodeMsg('3003');
                return ['status'=>0,'msg'=>"$codeMsg[msg]"];
            };
            $member = new Member();
            if (!empty($member->getMemberone("dabai_member","$Mobile"))){
                $codeMsg = $this->showReturnCodeMsg('4005');
                return ['status'=>0,'msg'=>"$codeMsg[msg]"];
            }
            $memberStats = $member->addMember("$Mobile","$Password");
            if ($memberStats == true){
                $codeMsg = $this->showReturnCodeMsg('1006');
                $Turl = Url('/');
                return ['status'=>1,'msg'=>"$codeMsg[msg]",'Turl'=>"$Turl"];
            }else{
                $codeMsg = $this->showReturnCodeMsg('1007');
                return ['status'=>0,'msg'=>"$codeMsg[msg]"];
            }
        }
    }

    //医生注册
    public function  doctor()
    {
        return $this->fetch('doctor');
    }

    public function  regdoctor(Request $request=null)
    {
        if ($request->isAjax()){
            $dname = input('dname');
            $dsex = input('dsex');
            $dtitle = input('dtitle');
            $dnumber = input('dnumber');
            $dmobilenum = input('dmobilenum');
            $dpiccode = input('dpiccode');
            $dmobilecode = input('dmobilecode');
            $dpassword = input('dpassword');
            //验证数据
            $rule = [
                'regMobile'  =>  $dmobilenum,
                'code' =>  $dmobilecode,
                'regPassword' =>  $dpassword,
            ];
            //加载验证器
            $msgValidate = $this->validate($rule,'ListRegister');
            if(true !== $msgValidate){
                return ['status'=>0,'msg'=>"$msgValidate"];
            }
            //验证图形验证码
            if(!captcha_check($dpiccode)){
                $codeMsg = $this->showReturnCodeMsg('4000');
                return ['status'=>0,'msg'=>"$codeMsg"];
            };
            //验证手机验证码
            if($this->RedisSession->read("$Mobile") != $code){
                $codeMsg = $this->showReturnCodeMsg('3003');
                return ['status'=>0,'msg'=>"$codeMsg[msg]"];
            };
            $data = [
                'phone' => "$Mobile",
                'nikename' => '大白'.$Mobile,
                'password' => "$hashedPassword",
                'regip' =>$this->regIp,
                'logip' =>$this->regIp
            ];
            $doctor = new DoctorModel();
            $doctor->data($data);
            $doctorR = $doctor->getDoctorOne("$dmobilenum");
            if (!empty($doctorR)){
                return ['status'=>0,'msg'=>"手机号已注册!"];
            }


        }
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
