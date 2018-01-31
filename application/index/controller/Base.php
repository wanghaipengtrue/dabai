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
use think\Session;
use think\cache\driver\Redis;

class Base extends ReturnCode
{
    public  $regIp = ""; //ip
    public  $controller;

    public  function __construct(Request $request = null)
    {
        parent::__construct();
        $request = Request::instance();
      /*  $this->regIp = $request->ip();*/
        $this->controller = $request->controller();
    }
    /**
     * @param string $code
     * @param array $data
     * @param string $msg
     * @return array
     */
    static public function showReturnCode($code = '', $msg = '')
    {
        $return_data = [
            'code' => '500',
            'msg' => '未定义消息'
        ];
        if (empty($code)) return $return_data;
        $return_data['code'] = $code;
        if(!empty($msg)){
            $return_data['msg'] = $msg;
        }else if (isset(ReturnCode::$return_code[$code]) ) {
            $return_data['msg'] = ReturnCode::$return_code[$code];
        }
        return $return_data;
    }

    static public function showReturnCodeMsg($code = '', $msg = '')
    {
        return self::showReturnCode($code,$msg);
    }
}