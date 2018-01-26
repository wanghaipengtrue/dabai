<?php
/*
 * 服务项目文件
 * */
namespace app\item\controller;

use think\Controller;
class Index extends  Controller
{
    #服务项目
    public function  index()
    {
        return $this->fetch("index");

    }



}
