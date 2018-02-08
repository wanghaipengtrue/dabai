<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/30
 * Time: 15:13
 */

namespace app\index\model;


use think\Model;
use think\Request;

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
    /*添加单条数据*/
    public function addDoctorOne($regData){
        //自动获取值 和 注册数据 合并插入
        $dataCustom = [
            'regip' =>$this->regIp,
            'logip' =>$this->regIp
        ];
        $dataMerge = array_merge($dataCustom,$regData);
        $this->data($dataMerge);
        if ($this->allowField(true)->save()){
            return true;
        }
    }
    /*删除单条数据*/
    public function delDoctorOne(){

    }
    /*获取手机号单条数据
     * @parm $mobile 手机号
    */
    public function getDoctorOne($mobile){
        $onePlus = $this->where('phone', "$mobile")->find();
        return $onePlus;
    }
    /*获取证书编号单条数据
     * @parm $certificatenu 证书编号
    */
    public function getCertificatenu($certificatenu){
        $onePlus = $this->where('certificatenu', "$certificatenu")->find();
        return $onePlus;
    }
    /*更新单条数据*/
    public function upDoctorOne(){

    }

}