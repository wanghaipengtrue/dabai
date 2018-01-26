<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 10:51
 */

namespace app\admin\controller;

use think\Request;
/*
 * 后台 医院控制器
 * */

class Hospital extends Authbase
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function index(){

        return $this->fetch("index");
    }
    //增加
    public function add(){

        return $this->fetch("add");
    }
    //修改
    public function update(){

        return $this->fetch("update");
    }
    //删除
    public function delete(){
        // 单独和多个删除

    }
    //详情
    public function details(){

        return $this->fetch("details");
    }

}