<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
class News extends Controller
{
    public function read()
    {
        Db::table('think_user')->where('id',1)->find();
    }

    public function hello($name)
    {
        return 'Hello,'.$name;
    }
}
