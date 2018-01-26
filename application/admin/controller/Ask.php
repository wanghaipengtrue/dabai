<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 10:05
 */

namespace app\admin\controller;

/*
 *  后台会员管理
 * @index 首页
 * @add 增加
 * @update 修改
 * @delete 删除
 * @details 详情
 * */

use think\Request;

class Ask extends Authbase
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