<?php
/**
 * Created by dabaipet.
 * File: Hospital.php
 * User: Mr.Wang
 * Date: 2017/8/28 0028
 * Remarks: 医院列表页
 */
namespace app\index\controller;

use think\Controller;
use think\Request;

/*
 * @funtion index 默认页面
 * */
class Hospital extends \think\Controller{
    #默认首页
    public function index(){

        return $this->fetch('index',['name'=>'wanghaipeng','email'=>'jdlfjslf@qq.com']);
    }
    #医院页面
    public function details(Request $request=null){




        return $this->fetch('details');
    }


}