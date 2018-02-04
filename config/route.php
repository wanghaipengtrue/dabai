<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 学习 实例
//Route::rule('article/:id','index/Article/index'); //原来访问地址会自动失效 如/index/article/index?id=14
//Route::rule(['article','article/:id'],'index/Article/index'); 定义article路由命名标识
//Route::rule('article/:id','index/Article/index','POST'); //指定请求类型
/*  类型	描述
    GET	    GET请求
    POST	POST请求
    PUT	    PUT请求
    DELETE	DELETE请求
    *	    任何请求类型
 * */
//+----------------------------------------------------------------------
//路由动态注册和配置定义的方式可以共存
use \think\Route;

// 绑定默认index模块
Route::bind('index');

//域名绑定 重要不要改动
Route::domain('admin','admin');//后台 1
Route::domain('ask','ask');//问答 1
Route::domain('chaoshi','chaoshi');//宠物超市 1
Route::domain('baike','baike');//百科 1
Route::domain('tao','item');//商家项目
Route::domain('doctor','@\app\index\controller\Doctor');//医生
Route::domain('hospital','@\app\index\controller\Hospital');//医院
Route::domain('news','@\app\index\controller\News');//文章




//后台

//配置定义系统默认
return [
    '/' => '', // 首页访问路由
    //前台 nav
    //'/Register/hospital' => 'index/Register/hospital', // 首页访问路由

    //前台 医生详情ID
   /* '[doctor]'     => [
        ':id'   => ['index/doctor/details', ['method' => 'get'], ['id' => '\d+']],
    ],*/

    //前台 医院详情ID
    '[hospital]'     => [
        ':id'   => ['index/hospital/details', ['method' => 'get'], ['id' => '\d+']],
    ],



    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
