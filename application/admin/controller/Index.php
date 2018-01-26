<?php
/**
 * Created by dabaipet.
 * File: index.php
 * User: Mr.Wang
 * Date: 2017/9/12 0012
 */

namespace app\admin\controller;

use app\admin\controller\Authbase;


class Index extends Authbase{

    public function  index(){

        return $this->fetch("index");
    }
}