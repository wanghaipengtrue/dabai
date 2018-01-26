<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 10:05
 */

namespace app\admin\controller;

/*
 *  后台会员控制器
 * @index 首页
 * @add 增加
 * @update 修改
 * @delete 删除
 * @details 详情
 * */

use think\console\command\make\Model;
use think\Controller;
use think\Request;

class Member extends Authbase
{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function index(){

        $isCheck = new Ask;
        $isCheck ->add();

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