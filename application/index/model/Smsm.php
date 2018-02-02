<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * Time: 14:18
 */

namespace app\index\model;

use think\Request;
use think\Session;
use think\cache\Driver;
//use think\session\driver\Redis;不适合使用session 验证码
//use think\cache\driver\Redis; //缓存验证码

class Smsm extends BaseModel
{

    protected $accessKeyId = "UBmLTvamZ2FR1QYg"; // 阿里云KEY
    protected $accessKeySecret ="fM4e4IIIUaIfuDBZJJyOkVCPLEFDK6"; // 阿里Secret
    protected $signName="大白宠物"; // 阿里签名
    protected $phoneNumbers='';
    protected $templateCode='';

    //用户注册
    public  function __construct(Request $request = null)
    {
        parent::__construct();
        $this->phoneNumbers =input('phoneNumbers/d');
        $this->templateCode =input('templateCode/d');

    }

    //发送手机验证码
    public function smsmSend($phoneNumbers,$templateCode){
        if (empty($this->RedisSession->read($phoneNumbers))){
            return '202';
            }else{
            $code = rand(100000, 999999);
            $sms =  new \Sms("$this->accessKeyId","$this->accessKeySecret");
            $Code = $sms->sendSms("$this->signName","$templateCode","$phoneNumbers",Array("code"=>"$code"
            ));
            $codeState = $Code->Code;
            if ($codeState == 'OK') {
                $this->RedisSession->write("$phoneNumbers","$code");
                return true ;
            }else{
                return false ;
            }
        }
    }
}