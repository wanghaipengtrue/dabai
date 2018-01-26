<?php
namespace app\index\controller;

class News
{
    public function read($id)
    {
        return $id;
    }

    public function hello($name)
    {
        return 'Hello,'.$name;
    }
}
