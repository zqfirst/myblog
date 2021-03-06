<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/public/plugins/libs/ajax/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/public/plugins/libs/ajax/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/public/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/public/plugins/iCheck/square/blue.css">

    <link rel="stylesheet" href="/public/plugins/laypage/skin/laypage.css">
    <link rel="stylesheet" href="/public/plugins/layer/skin/default/layer.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:;"><b>Admin Blog Manage</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in by your password</p>

        <form action="" method="post" id="login-form">
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Account">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" value=1> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <input type="hidden" name="<?= \Yii::$app->request->csrfParam ?>"
                           value="<?= \Yii::$app->request->csrfToken ?>">
                    <button type="button" id="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="/public/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/public/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/public/plugins/iCheck/icheck.min.js"></script>

<script src="/public/plugins/layer/layer.js"></script>
<script src="/public/plugins/laypage/laypage.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        $('#login').on('click', function () {
            login();
        })

        document.onkeydown = function(e){
            var ev = document.all ? window.event : e;
            if(ev.keyCode==13) {
               login();
            }
        }
        
        function login() {
            $.post('',$('#login-form').serialize(),function (response) {
                if (response.code == <?=\ResponseCode::SUCCESS_CODE ?>) {
                    layer.closeAll('loading');
                    layer.msg(response.msg, {icon: 1});
                    location.href = response.url;
                } else {
                    layer.msg(response.msg, {icon: 2});
                }
            },'json');
        }
    });
</script>
</body>
</html>
