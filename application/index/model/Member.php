<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 17:26
 */

namespace app\index\model;

use think\Model;
use think\Db;
use think\Request;

class Member extends Model
{
    public  $regIp; //ip
    protected $autoWriteTimestamp = true; //时间戳

    public  function __construct(Request $request = null)
    {
        parent::__construct();
        $request = Request::instance();
        $this->regIp = $request->ip();
    }
    //注册用户

    public function addMember($Mobile,$Password){
        //加密插件 phpass-3.0
        $hashedPassword = self::PassWordHashs("$Password");
        $this->data([
            'phone' => "$Mobile",
            'nikename' => '大白'.$Mobile,
            'password' => "$hashedPassword",
            'regip' =>$this->regIp,
            'logip' =>$this->regIp
        ]);
        if ($this->save() == true){
            return true;
        }else{
            return false;
        }
    }
    //密码加密插件 phpass-3.0
    static public function PassWordHashs($Password){
        $PasswordHashs = new \PasswordHashs(8, false);
        $hashedPassword = $PasswordHashs->HashPassword("$Password"); // 计算密码的哈希
        return $hashedPassword;
    }
    /* 密码校验 医生 用户 医院 公用
     * @param table 数据表全称
     * @param string phone 手机号
     * @param string Password 密码
    */
    static public function PassWordCheck($table,$phone,$password){
        $TableList = Db::table($table)->where('phone',"$phone")->find();
        $PasswordHashs = new \PasswordHashs(8, false);
        $PassworCheck = $PasswordHashs->CheckPassword("$password", $TableList['password']);
        return $PassworCheck;
    }
    //查询会员
    public function getMemberone($table,$phone){
        $memberOne =  Db::table($table)->where('phone',"$phone")->find();
        return $memberOne;
    }
    //登录次数
    public function MemberSetInc($table,$phone){
        $memberInc =  Db::table($table)->where('phone', $phone)->setInc('more');
        return $memberInc;
    }
    //更新密码 作废
    public function updateMemberone($Mobile,$hashedPassword){
        $updateStats = $this->where('phone', $Mobile)->update(['password' => $hashedPassword]);
        return $updateStats;
    }



    }