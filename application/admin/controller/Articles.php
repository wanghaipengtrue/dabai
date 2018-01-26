<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 10:05
 */

namespace app\admin\controller;

/*
 *  后台 文章控制器
 * @index 首页
 * @add 增加
 * @update 修改
 * @delete 删除
 * @details 详情
 * */

use app\admin\model\Category;
use app\admin\model\Articles as ArticlesModel;
use app\admin\model\Bodyarticle;
use think\Request;
use think\Db;
use \think\File;


class Articles extends Authbase
{


    public function index(){
        $reslut =Db::table('dabai_articles')
            ->alias('a')
            ->join('dabai_category c','a.typeid = c.id')
            ->field('a.id,a.typeid,a.flag,a.click,a.titles,c.title')
            ->select();

        return $this->fetch("index",['reslut'=>$reslut]);
    }

    //增加
    public function add(){


        $Category = new Category();
        $Level = $Category ->ForLevel();

        return $this->fetch("add",['Level'=>$Level]);

    }
    //修改
    public function update(Request $request = null){
        $id = $request->param('id');
        $Articles = ArticlesModel::get($id);
        $body = $Articles->Bodyarticle->body;

        $Category = new Category();
        $Level = $Category ->ForLevel();
        return $this->fetch("update",['Level'=>$Level,'articles' => $Articles,'body'=>$body]);
    }

    //详情
    public function details(){

        return $this->fetch("details");
    }

    public function save(Request $request = null){
        if ($request->isPost()) {
            $savetype = $request->param('savetype');
            $filePic = $request->file('thumpic');
            $flag = $request->param('flag/a');
            $titles = $request->param('titles');
            $shorttitle = $request->param('shorttitle');
            $sortrank = $request->param('sortrank');
            $tag = $request->param('tag');
            $source = $request->param('source');
            $writer = $request->param('writer');
            $idtitle = $request->param('idtitle');//文章ID
            $keywords = $request->param('keywords');
            $description = $request->param('description');
            $click = $request->param('click');
            $titlecolor = $request->param('titlecolor');
            $body = $request->param('body'); //类型
            //图片处理
            if($filePic){
                $info = $filePic->move(ROOT_PATH . 'public' . DS . 'upload');
                if($info){
                    // 成功上传后 获取上传信息
                    // 输出 jpg
                    //$info->getExtension();
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    $picPath = '/upload/'.$info->getSaveName();
                    //$info->getSaveName();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
                    //$info->getFilename();
                }else{
                    // 上传失败获取错误信息
                    $filePic->getError();
                }
            }
            //文章属性
            if (!empty($flag)){
                $Flag= '';
                foreach( $flag as $i)
                {
                    $Flag .= $i.',';
                }
                $Flag =substr($Flag,0,strlen($Flag)-1);
            }else{
                $Flag = 'null';
            }
            //截取pid 和 层级
            $str=explode(",","$idtitle");
            $id =$str[0];
            $typetitle = $str[1];
            //数据
            $data = ['typeid'   =>  $id,
                'titles'    =>  $titles,
                'shorttitle'    =>  $shorttitle,
                'flag'  =>  $Flag,
                'sortrank'  =>  $sortrank,
                'source'    =>  $source,
                'litpic'    =>  $picPath,
                'writer'    =>  $writer,
                'keywords'  =>  $keywords,
                'description'   =>  $description,
                'click' =>   $click,
                'titlecolor'    =>  $titlecolor,
                'typetitle' =>   $typetitle
            ];
            //一对一关联写入
            $Article = new ArticlesModel();
            if ($savetype == 'add'){
                $Article->data($data);
                $Bodyarticle = new Bodyarticle();
                if ($Article->save()){
                    $Bodyarticle->body = $body;
                    $Bodyarticle->typeid = $id;
                   if ($Article->Bodyarticle()->save($Bodyarticle)){
                    return ['status'=>1,'msg'=>"添加成功",'Turl'=>Url('/articles/index')];
                   }
                }
            }elseif ($savetype == 'update'){
                $id = $request->param('id');
                if ($Article->save($data,['id' => $id])){
                    return ['status'=>1,'msg'=>"更新成功",'Turl'=>Url('/articles/index')];
                }else{
                    return ['status'=>0,'msg'=>"更新失败"];
                }
            }
        else{
            return ['status'=>0,'msg'=>"提交方式错误"];
        }
   }
}
    //删除
    public function delete(Request $request = null){
        // 单独和多个删除
        if ($request->isAjax()){
            $id = $request->param('did');
            //$Articles = ArticlesModel::get($id);
            $reslut = db('Articles')->delete("$id");
            if ($reslut){
                //$reslut->aid->delete();
                return ['status'=>1,'msg'=>"删除成功"];
            }else{
                return ['status'=>0,'msg'=>"删除失败"];
            }
        }
        return ['status'=>0,'msg'=>"提交方式错误"];

    }

}