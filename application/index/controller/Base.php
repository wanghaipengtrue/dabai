<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17
 * Time: 14:26
 */

namespace app\index\controller;

use app\index\model\Member;
use think\Request;
//use think\Session;
use think\cache\driver\Redis;
use think\session\driver\Redis as RedisSession;
use think\Log;

class Base extends ReturnCode
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
    /**
     * @param string $code
     * @param array $data
     * @param string $msg
     * @return array
     */
    static public function showReturnCode($code = '', $msg = '')
    {
        $returnData = [
            'code' => '500',
            'msg' => '未定义消息'
        ];
        if (empty($code)) return $returnData;
        $returnData['code'] = $code;
        if(!empty($msg)){
            $returnData['msg'] = $msg;
        }else if (isset(ReturnCode::$return_code[$code]) ) {
            $returnData['msg'] = ReturnCode::$return_code[$code];
        }
        return $returnData;
    }

    static public function showReturnCodeMsg($code = '', $msg = '')
    {
        return self::showReturnCode($code,$msg);

    }


}