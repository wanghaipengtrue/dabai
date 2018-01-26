<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25
 * Time: 11:18
 */

namespace app\index\controller;


use think\Controller;
use think\Request;
use app\index\model\Article as ArticleModel;

class Article extends Controller
{


    public function index(Request $request = null)
    {
        echo "11122";



        return $this->fetch("index",['sss'=>'44444444444']);
    }

    public function details()
    {

        echo "213123sdfsffsfsfds";

       /* $id = $request->param('id');
        if (empty($id)){
            $this->error('文章不存在1','/index');
            exit();
        }
        $Article = ArticleModel::get($id);
        if (empty($Article)){
            $this->error('文章不存在','/index');
            exit();
        }

        $body = htmlspecialchars_decode($Article->Bodyarticle->body);
        $reslut = db('Articles')->where('id', $id)->find();
        return $this->fetch("index", ['reslut' => $reslut, 'body' => $body]);*/
    }

}