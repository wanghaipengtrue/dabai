<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 14:26
 */

namespace app\index\controller;

use app\index\model\Member;
use think\Controller;
use think\Request;
use think\Session;
use think\cache\driver\Redis;

class Base extends Controller
{
   // public  $regIp = ""; //ip
    public  $controller;

    public  function __construct(Request $request = null)
    {
        parent::__construct();
        $request = Request::instance();
      /*  $this->regIp = $request->ip();*/
        $this->controller = $request->controller();
    }
}