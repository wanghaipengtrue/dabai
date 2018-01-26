<?php
/**
 * Created by dabaipet.
 * File: Hospital.php
 * User: Mr.Wang
 * Date: 2017/8/28 0028
 * Remarks: 医院列表页
 */
namespace app\hospital\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{
    /*
    * @funtion index 默认页面
     *@parameter hid 医院ID
    * */
    public function index( Request $request=null)
    {
        echo $request->param('id');

        return $this->fetch('index',['name'=>'wanghaipeng','email'=>'jdlfjslf@qq.com']);
    }
}
