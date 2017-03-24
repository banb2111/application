<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link href="<?php echo base_url(); ?>/static/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo base_url(); ?>static/fonts/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="<?php echo base_url(); ?>static/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>static/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="<?php echo base_url(); ?>static/css/base.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>/static/js/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">CRM</h1>

            </div>
            <h3>欢迎使用</h3>

            <form class="m-t" role="form" method="post" id="login">
                <div class="form-group tl">
                    <input type="text" class="form-control" name="username" placeholder="用户名" required="">
                </div>
                <div class="form-group tl">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                    <span id="password-error_1" class="help-block m-b-none" style="color:red;display:none">
                        <i class="fa fa-times-circle"></i>
                        <span class="err_span"></span>
                    </span>
                </div>
                <button type="button" class="btn btn-primary block full-width m-b sublogin">登 录 </button>

                <p class="text-muted text-center hide"> <a href="login.html#"><small>忘记密码了？</small></a> 
                    <!-- | <a href="register.html">注册一个新账号</a> -->
                </p>

            </form>
        </div>
    </div>
     <script src="<?php echo $base_url; ?>/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="<?php echo $base_url; ?>/static/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="<?php echo $base_url; ?>/static/js/content.min.js?v=1.0.0"></script>
    <script src="<?php echo $base_url; ?>/static/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="<?php echo $base_url; ?>/static/js/plugins/validate/messages_zh.min.js"></script>
    <script src="<?php echo $base_url; ?>/static/js/demo/login-validate-demo.min.js"></script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
<script type="text/javascript">


    $(function(){

        $('.sublogin').click(function(){
            
            var username = $('input[name=username]').val();
            var password = $('input[name=password]').val();
            // alert(password.length)
            $.post("<?= base_url(); ?>index.php/users/ajax_check_user",{'username':username,'password':password},function(data){
                var info = eval(data);
                if(info.s == 'ok'){
                    $("#login").submit();
                }else{

                    if(password.length >= 5){
                        $('#password-error_1').css('display','block');    
                        $('.err_span').text(info.msg);
                    }
                }
            },'json');

            return false;
        });

    });


</script>

<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
</html>
