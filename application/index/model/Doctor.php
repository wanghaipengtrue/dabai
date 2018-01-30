<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/30
 * Time: 15:13
 */

namespace app\index\model;


use think\Model;

class Doctor extends Model
{
    public  $regIp; //ip
    protected $autoWriteTimestamp = true; //时间戳

    public  function __construct(Request $request = null)
    {
        parent::__construct();
        $request = Request::instance();
        $this->regIp = $request->ip();
    }
    //添加单条数据
    public function addDoctorOne($data){
       /* $this->data($data);
        if ($this->save()){
            return true;
        }else{
            return false;
        }*/
    }
    //删除单条数据
    public function delDoctorOne(){

    }
    //获取单条数据
    public function getDoctorOne($mobile){
        $onePlus = $this->where('phone', "$mobile")->find();
        return $onePlus;
    }
    //更新单条数据
    public function upDoctorOne(){

    }

}