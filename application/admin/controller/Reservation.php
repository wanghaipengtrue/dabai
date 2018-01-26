<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 11:39
 */

namespace app\admin\controller;


class Reservation extends Authbase
{


    public function index(){

        return $this->fetch("index");
    }
}