<?php
namespace app\admin\controller;

/*
 *  后台会员管理
 * @index 首页
 * @add 增加
 * @update 修改
 * @delete 删除
 * @details 详情
 * */

use app\admin\model\Category;
use think\Request;

class Column extends Authbase
{

    public function index(){

        $Category = new Category();
        $reslut = $Category ->ForLevel();

        return $this->fetch("index",['reslut' => $reslut]);
    }
    //增加
    public function add(){

        $Category = new Category();
        $reslut = $Category ->ForLevel();

        return $this->fetch("add",['reslut' => $reslut]);
    }
    //保存  根据传递类型 判断增加还是修改
    public function save(Request $request = null){
        if ($request->isPost()){
        $savetype = $request->param('savetype'); //类型
        $title = $request->param('title');
        $sort = $request->param('sort');
        $pidlevel = $request->param('pidlevel');
        $ishidden = $request->param('ishidden');
        $seotitle = $request->param('seotitle');
        $keywords = $request->param('keywords');
        $describe = $request->param('describe');

        //截取pid 和 层级
        $str=explode(",","$pidlevel");
        $pid =$str[0];
        $level = $str[1];


        $data = ['title'=>$title,
            'sort'=>$sort,
            'pid'=>$pid,
            'level'=>$level,
            'ishidden'=>$ishidden,
            'seotitle'=>$seotitle,
            'keywords'=>$keywords,
            'describe'=>$describe
            ];
        $Category = new Category();
        if ($savetype == 'add'){
            $Category->data($data);
            if ($Category->save()){
                $this->success('添加成功!','/admin/column/index');
            }
        }elseif ($savetype == 'update'){

            $id = $request->param('id');
            if ($Category->save($data,['id' => $id])){
                $this->success('更新成功!','/admin/column/index');
            }


        }
    }else{

    $this->error('提交方式错误！','./');
}
    }
    //修改
    public function update(Request $request = null){
        $id = $request->param('id');
        $Category = new Category();
        $reslut = $Category ->getOne("$id");

        $Level = $Category ->ForLevel();

        return $this->fetch("update",['reslut' => $reslut,'Level'=>$Level]);
    }

    //删除
    public function delete(Request $request = null){
        // 单独和多个删除
       if ($request->isAjax()){
            $id = $request->param('did');
        $Category = new Category();
        // 判断父类下有子类不能删除
        $isPid = $Category -> getChildsId("$id");
        if (!empty($isPid)){
            return ['status'=>0,'msg'=>"当前栏目还有子栏目"];
        }
        $reslut = $Category ->getOne("$id");
        if ($reslut->delete()){
            return ['status'=>1,'msg'=>"删除成功"];
        }else{
            return ['status'=>0,'msg'=>"删除失败"];
        }
       }
        return ['status'=>0,'msg'=>"提交方式错误"];

    }
    //详情
    public function details(){

        return $this->fetch("details");
    }

}