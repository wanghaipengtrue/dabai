<?php
namespace app\ask\controller;
use think\Controller;

class Index extends Controller
{
    public function  index()
    {
        return $this->fetch("index");

    }



}
