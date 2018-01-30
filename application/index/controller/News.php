<?php
namespace app\index\controller;

/*大白新闻首页*/
class News extends Base
{
    public function index()
    {
        echo "11";
        return $this->fetch("news/index");
    }


}
