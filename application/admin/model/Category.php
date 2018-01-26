<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/12/12
 * Time: 0:28
 */

namespace app\admin\model;


use think\Model;

class Category extends Model
{

    public  function getCate(){
        return $this->order('sort asc,id asc')->select();
    }

    //组合一维数组
     Public function ForLevel ($html = '&nbsp;&nbsp;|--', $pid = 0, $level = 0) {
        $arr = array();
        foreach ($this->getCate() as $k => $v) {
            if ($v['pid'] == $pid) {
                $v['level'] = $level + 1;
                $v['html']  = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, self::ForLevel($html, $v['id'], $level + 1));
            }
        }
        return $arr;
    }
    //组合多维数组
    Public function unlimitedForLayer ($cate, $name = 'child', $pid = 0) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
    //传递一个子分类ID返回所有的父级分类
    Public function getParents ($cate, $id) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['id'] == $id) {
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate, $v['pid']), $arr);
            }
        }
        return $arr;
    }
    //传递一个父级分类ID返回所有子分类ID
    Public function getChildsId ($pid) {
        $arr = array();
        $cate = $this->getCate();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v['id'];
                $arr = array_merge($arr, self::getChildsId($cate, $v['id']));
            }
        }
        return $arr;
    }
    //传递一个父级分类ID返回所有子分类
    Public function getChilds ($cate, $pid) {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['pid'] == $pid) {
                $arr[] = $v;
                $arr = array_merge($arr, self::getChilds($cate, $v['id']));
            }
        }
        return $arr;
    }
    //获取一条数据
    public  function  getOne($id=''){
        return $Category = Category::get("$id");
    }
    //删除一条数据
    public  function  delOne($id=''){
        return $Category = Category::get("$id");
    }
}