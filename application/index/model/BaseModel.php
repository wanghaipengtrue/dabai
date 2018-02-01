<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 15:43
 */

namespace app\index\model;


use think\Model;
use think\Request;
use think\cache\driver\Redis;
use think\session\driver\Redis as RedisSession;

class BaseModel extends Model
{
    protected  $regIp = ""; //ip
    protected  $controller;
    protected  $module;
    protected  $action;

    protected  $RedisSession;

    public  function __construct(Request $request = null)
    {
        parent::__construct();
        $request = Request::instance();
        $this->regIp = $request->ip();
        $this->controller = $request->controller();
        $this->module = $request->module();
        $this->action = $request->action();
        //session redis 连接
        $this->RedisSession = new RedisSession();
        $this->RedisSession->open('','');
    }

}