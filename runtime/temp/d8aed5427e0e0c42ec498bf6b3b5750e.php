<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"D:\wnmp\www\dabai\public/../application/index\view\login\user.html";i:1517564336;s:78:"D:\wnmp\www\dabai\public/../application/index\view\public\register_header.html";i:1516871282;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户登录</title>
    <link rel="stylesheet" type="text/css" href="__fontawesome__/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="__layui__/css/layui.css" />
    <script type="text/javascript" src="__layui__/layui.js"></script>
    <link rel="stylesheet" type="text/css" href="__css__/currency.css" />
    <link rel="stylesheet" type="text/css" href="__css__/register.css" />
    <script type="text/javascript" src="__js__/jquery-1.8.3.min.js"></script>
</head>
<body class="bodyBg">
<div class="layui-fluid bgColor">
    <div class="layui-row RegisterDoctorInfo">
        <div class="layui-col-xs12 layui-col-md12 layui-col-sm12">
            <a href="" class="logo" id="logo" title="大白宠物医院"></a>
            <p class="logo-text">
                <span>数百万宠粉社区</span>
                <span class="bor-l-r"><b>3000</b>+认证医生</span>
                <span class="last">每日<b>500</b>+求助提问</span>
            </p>
            <a href="<?php echo url('/index');; ?>" class="return-home">返回大白主页</a>
        </div>
    </div>
</div>

<!--top end -->
<div class="layui-container">
    <!--content begin-->
    <div class="layui-row ">
        <!--left begin -->
        <div class="RegisterUser mrt20 layui-col-sm12 layui-col-md12 layui-col-lg12">
            <div class="RegisterUser-login">
                <div class="layui-row layui-col-space30">
                <div class="RegisterUser-login-left left layui-form-pane layui-col-sm6 layui-col-md6 layui-col-lg6">
                    <div class="RegisterUser-tabRL">
                        <a href="<?php echo url('/Register/user'); ?>" title="大白宠物医院注册">注册</a>·
                        <a class="onAction" href="<?php echo url('/Login/user');; ?>" title="大白宠物医院登录">登录</a>
                    </div>
                    <form id="signinForm" class="layui-form" action="<?php echo url('/Login/userHandle');; ?>" method="post">
                    <input type="hidden" name="loginType" value="user">
                    <div class="layui-form-item">
                            <label class="layui-form-label">手机号</label>
                            <div class="layui-input-block">
                                <input type="text" name="signinMobile" id="signinMobile"  placeholder="请输入手机号" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">登录密码</label>
                        <div class="layui-input-block">
                            <input type="password" name="signinPassword" id="signinPassword"  placeholder="请输入登录密码" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item p-a">
                        <label class="layui-form-label imgVerify" ><img id="imgVerify" src="<?php echo captcha_src(); ?>" title="点击刷新" onclick="fleshVerify()"></label>
                        <div class="layui-input-block">
                            <input type="text" name="imgVerifycode" id="imgVerifycode"  placeholder="请输入验证码,点击可刷新" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item p-a">
                        <div class="layui-form-mid left"><p><a class="p" href="<?php echo url('/findPassword');; ?>">找回密码</a></p> </div>
                        <div class="layui-form-mid right"><p><a class="p" href="<?php echo url('/Login/userMobile');; ?>">手机验证码登录</a></p> </div>

                    </div>

                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button type="button" class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo" onclick="checkLogin()">登录</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--left-->
                <div class="RegisterUser-login-right left mrt15 layui-col-sm6 layui-col-md6 layui-col-lg6">
                <h2>使用其他帐号登录</h2>
                    <div class="RegisterUser-sdk">
                        <a href=""><i class="fa fa-weixin" aria-hidden="true"></i>
                            微信登录</a>
                    </div>
                    <div class="RegisterUser-sdk">
                        <a href=""><i class="fa fa-qq" aria-hidden="true"></i>
                            腾讯QQ登录</a>
                    </div>
                    <div class="RegisterUser-sdk">
                        <a href=""><i class="fa fa-weibo" aria-hidden="true"></i>
                            新浪微博登录</a>
                    </div>
                </div>
                    <!--left-->
            </div>
            </div>
        </div>
        <!--content end -->
    </div>
</div>
<script type="text/javascript" src="__js__/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__js__/loginForm.js"></script>
<script>
    layui.use('form', function(){
        var form = layui.form;
    });
</script>
</body>
</html>