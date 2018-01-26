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
    public function addMember($Mobile,$hashedPassword){
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
    //查询会员
    public function getMemberone($Mobile){
        //数据查询
        $memberR = db('member')->where('phone',"$Mobile")->find();
        return $memberR;
    }
    //更新密码 作废
    public function updateMemberone($Mobile,$hashedPassword){
        $updateStats = $this->where('phone', $Mobile)->update(['password' => $hashedPassword]);
        return $updateStats;
    }



    }