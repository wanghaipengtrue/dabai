<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/30
 * Time: 11:45
 */

namespace app\item\controller;
use think\Controller;

class Detail extends  Controller
{
    public function  index()
    {
        return $this->fetch("index");

    }
}