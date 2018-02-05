/*
* 大白宠物医院注册表单JS
* */
function fleshVerify(){
    $('#imgVerify').attr('src','http://dabaipet.com/captcha?id='+Math.floor(Math.random()*100));
}
function checkReg(){
    var form = new FormData(document.getElementById("signupForm"));
    var furl = $("form").attr("action");

    var mobile = $('#regMobile').val();
    var password = $('#regPassword').val();
    var vertify = $('#imgVerifycode').val();
    var regmCode = $('#regmCode').val();
    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
    if( mobile == ''){
        layer.msg('手机号码不能为空!');
        return;
    }
    if( mobile.length!=11 || !myreg.test(mobile)){
        layer.msg('请输入有效的手机号码！');
        return;
    }
    if(vertify =='' || vertify.length!=3){
        layer.msg('请输入正确的图形验证码!');
        $('#imgVerify').trigger('click');
        return;
    }

    if(regmCode =='' || regmCode.length!=6){
        layer.msg('请输入有效的手机验证码!');
        return;
    }
    if(password =='' || password.length<6){
        layer.msg('请设置有效登录密码!');
        return;
    }
    $.ajax({
        url:furl,
        type:'post',
        dataType:'json',
        data:{regMobile:$("#regMobile").val(),regPassword:$("#regPassword").val(),imgVerifycode:$("#imgVerifycode").val(),regmCode:$("#regmCode").val()},
        success:function(res){
            if(res.status==1){
                layer.alert(res.msg, {icon: 1,btn: ['确定'],yes: function(index, layero){
                    top.location.href = res.Turl;
                }});
            }else{
                layer.alert(res.msg, {icon: 2});
            }
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            layer.alert('网络失败，请刷新页面后重试', {icon: 2});
        }
    });
}

//医生注册
function checkRegDoctor(){
    var formData = new FormData(document.getElementById("signupForm"));
    var furl = $("form").attr("action");

    var dname = $('#dname').val();
    var dtitle = $('#dtitle').val();
    var dnumber = $('#dnumber').val();
    var mobilenum = $('#mobilenum').val();
    var dpiccode = $('#imgVerifycode').val();
    var dmobilecode = $('#dmobilecode').val();
    var dpassword = $('#dpassword').val();
    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

    if( dname == ''){
        layer.msg('请填写本人真实姓名!');return;
    }
    if( dtitle == ''){
        layer.msg('请填写本人所在医院全称!'); 
        return;
    }
    if( dnumber == ''){
        layer.msg('请填写本人执业医师证号'); 
        return;
    }
    if( mobilenum == ''){
        layer.msg('请填写本人手机号码'); 
        return;
    }
    if( mobilenum.length!= 11 || !myreg.test(mobilenum)){
        layer.msg('请填写有效的手机号码！'); 
        return;
    }
    if(dpiccode =='' || dpiccode.length!=3){
        layer.msg('请填写正确的图形验证码!');
        $('#imgVerify').trigger('click');
        return;
    }
    if(dmobilecode =='' || dmobilecode.length!=6){
        layer.msg('请填写有效的手机验证码');
        return;
    }
    if(dpassword =='' || dpassword.length<6){
        layer.msg('请设置有效登录密码');
        return;
    }
    $.ajax({
        url:furl,
        type:'post',
        data:formData,
        processData:false,
        contentType:false,
        success:function(res){
            if(res.status==1){
                layer.alert(res.msg, {icon: 1,btn: ['确定'],yes: function(index, layero){
                    top.location.href = res.Turl;
                }});
            }else{
                layer.alert(res.msg, {icon: 2});
            }
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            layer.alert('网络失败，请刷新页面后重试', {icon: 2});
        }
    });
}

$(".clickCode").on("click", function() {
    var mobile = $('#regMobile').val();
    var vertify = $('#imgVerifycode').val();
    var controller = $('#controller').val();
    var s = parseInt($(".clickCode i").html());
    if( mobile == ''){
        layer.msg('请输入有效的手机号！');
        return;
    }
    if(vertify =='' || vertify.length!= 3){
        layer.msg('请输入正确的图形验证码！');
        $('#imgVerify').trigger('click');
        return;
    }
    if (s > 0) {
        return false;
    }
    $.post("http://dabaipet.com/sms/sendSms", {
        regMobile: mobile,
        controller:controller,
        vertify:vertify
    }, function(e) {
        if (e.status == 1) {
            layer.msg(e.msg);
            $(".clickCode").html("<p class=' layui-btn-disabled'><i>60</i>秒后重发</p>");
            var ping = window.setInterval(function() {
                var s = parseInt($(".clickCode i").html());
                if (s == 0) {
                    $(".clickCode").html("重发验证码")
                    clearInterval(ping);
                    return false;
                } else {
                    $(".clickCode i").html(s - 1);
                }
            }, 1000);
        }else if(e.status==2){
            layer.msg(e.msg);
            $('#imgVerify').trigger('click');
        }else {
            layer.msg(e.msg);
        }
    });
    return false;
});
