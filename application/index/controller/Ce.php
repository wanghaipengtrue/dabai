<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/22
 * Time: 14:41
 */

namespace app\index\controller;

use think\cache\driver\Redis;
use think\Controller;
use think\Cache;

class Ce extends Controller
{
public function index(){
    $redis = new Redis();
    $redis->set('name','aaasss');
    echo $redis->get('name');
}

}