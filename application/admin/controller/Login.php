<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

/*
 * 后台登录
 * @function index 登录首页
 * @function adminDo 处理
 * */
class Login extends  Controller{

    //后台登录首页
    public function  index(){
        return $this->fetch("index");
    }
    //登录处理
    public function adminDo(){
        $name =  input('name'); // 手机号
        $password = input('password');//密码
        $Verifycode = input('vertify');// 图形

       /* $data = [
            'name'  =>  $name,
            'password' =>  $password
        ];
        //验证场景
        $result = $this->validate($data,'User.edit');
        if(true !== $result){
            // 验证失败 输出错误信息
            dump($result);
        }*/

        //验证数据
       /* $rule = [
            'name'  =>  $name,
            'regPassword' =>  $password
        ];
        //加载验证器
        $msgValidate = $this->validate($rule,'Register');
        if(true !== $msgValidate){
            return ['status'=>0,'msg'=>"$msgValidate"];
        }*/
        //验证图形验证码
        if(!captcha_check($Verifycode)){
            return ['status'=>0,'msg'=>"请输入正确的图形验证码!"];
            die();
        };
       /* $adminR = db('admin')->where('name',"$name")->find();
        var_dump($adminR);
        die();*/
        $PasswordHashs = new \PasswordHashs(8, false);
        $PassworCheck = $PasswordHashs->CheckPassword("$password", '$08$CJNYalp4QyTJYGMum9a0D.S//6SheWaV/fvO0iB2HckJpRD1QP15e');
        if ($PassworCheck){
            Session::set('isAdmin',"11111");
            //db('admin')->where('id', $adminR['id'])->setInc('more');
            $Tmsg = "登录成功！";
            $Turl = Url('/admin');
            return ['status'=>1, 'msg'=>"$Tmsg",'Turl'=>"$Turl"];
        }else{
            $Tmsg = "密码错误,请重新输入!";
            return ['status'=>0, 'msg'=>"$Tmsg"];
        }


    }


}