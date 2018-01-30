<?php
/**
 * Created by dabaipet.
 * File: Hospital.php
 * User: Mr.Wang
 * Date: 2017/8/28 0028
 * Remarks: 医生列表页
 */
namespace app\index\controller;

/*
 * @funtion index 默认页面
 * */
use think\Controller;
use think\Request;

class Doctor extends Controller {

    public function index(Request $request=null){



        return $this->fetch('doctor/index',['name'=>'wanghaipeng','email'=>'jdlfjslf@qq.com']);
    }


}