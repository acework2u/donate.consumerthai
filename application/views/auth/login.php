<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH."bootstrap.min.css";?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH?>font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH?>AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH?>iCheck/square/blue.css">



    <script src="<?php echo HTTP_JS_PATH;?>vue.js"></script>
    <script src="<?php echo HTTP_JS_PATH;;?>axios.js"></script>
    <script src="<?php echo HTTP_JS_PATH;;?>vee-validate.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box" id="app">
    <div class="login-logo">
        <a><b>Admin</b> DONATE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <div v-if="is_success.length" class="alert alert-success" role="alert">
            <span v-for="msg in is_success">{{msg}}</span>
        </div>
        <div v-if="is_errors.length" class="alert alert-danger" role="alert">
            <span v-for="msg in is_errors">{{msg}}</span>
        </div>

        <form v-if="conditionSign">
            <div class="form-group has-feedback">
                <input v-model="userFill.user_name" name="user_name" type="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input v-model="userFill.password" name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>



            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>





                <!-- /.col -->
                <div class="col-xs-4">
                    <button @click="userLogin" type="button" class="btn btn-primary btn-block btn-flat">Sign In</button>

                </div>
                <!-- /.col -->
            </div>
        </form>


        <!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        <p><a class="btn btn-success" @click="changMode">Chang Mode</a></p>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="<?php echo HTTP_JS_PATH?>pages/login.js"></script>
<!-- jQuery 3 -->
<script src="<?php echo HTTP_CSS_PATH?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo HTTP_CSS_PATH?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo HTTP_CSS_PATH?>iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
