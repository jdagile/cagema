<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SMS App  </title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo asset('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <link href="<?php echo asset('assets/fonts/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo asset('assets/css/animate.min.css'); ?>" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo asset('assets/css/custom.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('assets/css/maps/jquery-jvectormap-2.0.1.css'); ?>" />
    <link href="<?php echo asset('assets/css/icheck/flat/green.css'); ?>" rel="stylesheet" />
    <link href="<?php echo asset('assets/css/floatexamples.css'); ?>" rel="stylesheet" type="text/css" />

    <script src="<?php echo asset('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo asset('assets/js/nprogress.js') ?>"></script>
<!--    <script>
        NProgress.start();
    </script>-->
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <form method="POST" action="{!! url('/login') !!}" data-parsley-validate >
                         {!! csrf_field() !!}
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="E-mail" required="" />
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Submit</button>
                            <input type="checkbox" name="remember"> Remember Me
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form method="POST" action="{!! url('/register') !!}" data-parsley-validate>
                        {!! csrf_field() !!}
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" name="username" value="{{ old('name') }}" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required=""  name="email" value="{{ old('email') }}" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                            
                        </div>
                        <div>
                            <button type="submit">Register</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>
</body>
</html>