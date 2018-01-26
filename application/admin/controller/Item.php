<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/4
 * Time: 17:28
 */

namespace app\admin\controller;


use think\Controller;
use app\admin\model\Category;

class Item extends Controller
{
    public function index(){
        $Category = new Category();
        $reslut = $Category ->ForLevel();

        return $this->fetch("index",['reslut' => $reslut]);
    }

}