<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Cache;
use think\Env;
use think\Config;

class Index extends Controller
{
    public function _empty($name)
    {
        return $this->showCity($name);
    }
    protected function showCity($name)
    {
        //和$name这个城市相关的处理

        return '当前城市' . $name;
    }
    public function  index()
    {
        /*Config::load(APP_PATH.'config/extra/admin_config.php');
        echo Config::get('admin_web.title');*/
        //echo Env::get('database.username');
        return $this->fetch("index");
    }
    public function hospitals(Request $request=null){
        echo "11111111111111111";
        $id = $request->param('id');

        return $this->fetch('hospitals');
    }

}
