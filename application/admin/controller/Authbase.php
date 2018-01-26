<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/20
 * Time: 17:35
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Db;
class Authbase extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //测试
        Session::set('isAdmin','王海鹏');
        if (!Session::has('isAdmin')){
            $this->error("跳转登录页面",Url('/admin/login'));
        }
    }

}