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
   /*用户注册*/
    public function  user()
    {
        return $this->fetch('user',['controller'=>$this->controller]);
    }
    /*普通用户注册处理*/
    public function reguser(Request $request=null)
    {
        if($request->isAjax()){
            $Mobile =  input('regMobile'); // 手机号
            $code = input('regmCode');//手机验证码
            $Password = input('regPassword');// 密码
            //验证数据
            $rule = [ 'mobile'=>$Mobile,'code'=>$code,'password'=>$Password];
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
    /*医生注册*/
    public function  doctor()
    {
        return $this->fetch('doctor');
    }
    /*医生注册处理*/
    public function  regdoctor(Request $request=null)
    {
        if ($request->isAjax()){
            $dname = input('dname');
            $dsex = input('dsex');
            $dtitle = input('dtitle');
            $certificatenu = input('doctornumber');
            $dmobilenum = input('mobilenum');
            $dpiccode = input('dpiccode');
            $dmobilecode = input('dmobilecode');
            $dpassword = input('dpassword');

            return ['status'=>0,'msg'=>"$dsex"];
            die;
            //验证数据
            $rule = ['name' => $dname, 'sex' => $dsex, 'title' => $dtitle, 'certificatenu' => $certificatenu,'mobile' => $dmobilenum,'code' => $dmobilecode,'password' => $dpassword];
            //加载验证器
            $msgValidate = $this->validate($rule,'Register');
            if(true !== $msgValidate){
                return ['status'=>0,'msg'=>"$msgValidate"];
            }
            //验证图形验证码
            if(!captcha_check($dpiccode)){
                $codeMsg = $this->showReturnCodeMsg('4000');
                return ['status'=>0,'msg'=>"$codeMsg"];
            };
            //验证手机验证码
            /*if($this->RedisSession->read("$dmobilenum") != $dmobilecode){
                $codeMsg = $this->showReturnCodeMsg('3003');
                return ['status'=>0,'msg'=>"$codeMsg[msg]"];
            };*/
            $doctor = new DoctorModel();
            //证书编号查询
            if (!empty($doctor->getCertificatenu("$certificatenu"))){
                $codeMsg = $this->showReturnCodeMsg('4006');
                return ['status'=>0,'msg'=>"$codeMsg[msg]"];
            }
            //医生手机号是否已注册
            /*if (!empty($doctor->getDoctorOne("$dmobilenum","$certificatenu"))){
                $codeMsg = $this->showReturnCodeMsg('4005');
                return ['status'=>0,'msg'=>"$codeMsg[msg]"];
            }*/
            //数据插入
            $regData = ['name' => $dname, 'sex' => $dsex, 'phone' => $dmobilenum,'password' => $dpassword];
            $doctorStats = $doctor->addDoctorOne("$regData");
            if ($doctorStats == true){
                $codeMsg = $this->showReturnCodeMsg('1006');
                $Turl = Url('/');
                return ['status'=>1,'msg'=>"$codeMsg[msg]",'Turl'=>"$Turl"];
            }else{
                $codeMsg = $this->showReturnCodeMsg('1007');
                return ['status'=>0,'msg'=>"$codeMsg[msg]"];
            }
        }
    }
    /*医院入驻*/
    public function  hospital()
    {
        return $this->fetch('hospital');

    }
    public function  upload()
    {

    }

}
