<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/14
 * Time: 17:35
 */

namespace app\index\model;


use think\Model;

class Article extends Model
{
    // 开启自动写入时间戳
    //protected $autoWriteTimestamp = true;

    // 定义自动完成的属性
    //protected $insert = ['status' => 1];
    //protected $pk = 'uid'; 主键

    // 定义关联
    public function bodyarticle()
    {
        return $this->hasOne('Bodyarticle','aid','id');
    }




}