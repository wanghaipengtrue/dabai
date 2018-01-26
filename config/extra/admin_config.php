<?php
// +----------------------------------------------------------------------
// | 大白宠物医院 后台配置文件
// +----------------------------------------------------------------------
use think\Config;
$config = array(
    "admin_web"=>array(
            'title'=>11122221,
            'keyword'=>3333
        ),
    "admin_picture"=>array(
        'title'=>1111,
        'keyword'=>3333
    ),
    "admin_email"=>array(
        'title'=>1111,
        'keyword'=>3333
    ),
    "admin_sms"=>array(
        'title'=>1111,
        'keyword'=>3333
    ),
    "admin_csrf"=>array(
        'title'=>1111,
        'keyword'=>3333
    ),
    "admin_code"=>array(
        'title'=>1111,
        'keyword'=>3333
    )
);
/*
$config = [
    //网站配置
    'admin_web'  =>  [
        'title'  =>  1222,
        'keyword'  =>  '',
        'describe'  =>  ''
    ],
    //图片
    'admin_picture'    =>  [
        'state'      =>  '',
        'url'      =>  '',
        'password'  =>  '',
    ],
    //邮件
    'admin_email'    =>  [
        'type'      =>  'mysql',
        'user'      =>  'root',
        'password'  =>  '',
    ],
    //短信
    'admin_sms'    =>  [
        'openid'      =>  'mysql',
        'secretkey'      =>  'root',
        'password'  =>  '',
    ],
    //csrf 防御
    'admin_csrf'    =>  [
        'state'      =>  'mysql'
    ],
    //验证码
    'admin_code'    =>  [
        'state'      =>  '',
        'width'      =>  '',
        'height'  =>  '',
    ],
];*/


Config::set($config);