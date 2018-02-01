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
//use think\session\driver\Redis;
//use think\cache\driver\Redis;
use think\Db;

class Register extends Base
{

   //用户注册
    public function  user()
    {

        return $this->fetch('user',['controller'=>$this->controller]);
    }
    public function  reguser()
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
           $codeMsg = $this->showReturnCodeMsg('4000');
           return ['status'=>2,'msg'=>"$codeMsg[msg]"];
           die();
        };
        //验证手机验证码
        $redis = new redis();
        if($this->RedisSession->read("$Mobile") != $code){
            return ['status'=>0,'msg'=>"手机验证码错误!"];
            die();
        };
        $member = new Member();
        $memberR = $member->getMemberone("$Mobile");
        if (!empty($memberR)){
            return ['status'=>0,'msg'=>"手机号已注册!"];
        }

        $memberStats = $member->addMember("$Mobile","$Password");
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
    public function  regdoctor(Request $request=null)
    {
        //ajax
        if ($request->isAjax()){
            $dname = input('dname');
            $dsex = input('dsex');
            $dtitle = input('dtitle');
            $dnumber = input('dnumber');
            $dmobilenum = input('dmobilenum');
            $dpiccode = input('dpiccode');
            $dmobilecode = input('dmobilecode');
            $dpassword = input('dpassword');
            //校验数据
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
                return ['status'=>2,'msg'=>"$codeMsg"];
                die();
            };
            //验证手机验证码
            $redis = new redis();
            if($redis->get("$dmobilenum") != $dmobilecode){

                return ['status'=>0,'msg'=>"手机验证码错误!"];
                die();
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
