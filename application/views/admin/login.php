<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo PLATFORM_NAME; ?> | Log in</title>



    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="<?php echo base_url() ?>public/adminplugins/fontawesome-free/css/all.min.css">

    <!-- icheck bootstrap -->

    <link rel="stylesheet" href="<?php echo base_url() ?>public/adminplugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/dist/css/adminlte.min.css">

</head>



<body class="hold-transition login-page">

    <div class="login-box">

        <div class="login-logo">

            <a href="#"><b>Pet Adopion Login Page</b></a>

        </div>



        <?php

        if (!empty($this->session->flashdata('msg'))) {

            echo "<div class='alert alert-danger mb-2'>" . $this->session->flashdata('msg') . "</div>";
        }

        ?>

        <!-- /.login-logo -->

        <div class="card">

            <div class="card-body login-card-body">

                <p class="login-box-msg">Sign in to start your session</p>



                <form action="<?php echo base_url() . 'admin/login' ?>" name="loginForm" id="loginForm" method="post">

                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Email</label>
                        <div class="input-icon">
                            <i class="fa fa-user"></i>
                            <input value="admin@gmail.com" type="text" autocomplete="off" placeholder="Email address" name="email" class="form-control form-control-solid placeholder-no-fix" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <div class="input-icon">
                            <i class="fa fa-lock"></i>
                            <input value="123456" type="password" name="password" class="form-control form-control-solid placeholder-no-fix" autocomplete="off" placeholder="Password" />
                        </div>
                    </div>

                    <!-- <div class="input-group mb-3">

                        <input type="text" name="username" id="username" class="form-control" placeholder="Email">

                        <div class="input-group-append">

                            <div class="input-group-text">

                                <span class="fas fa-envelope"></span>

                            </div>

                        </div>

                    </div> -->

                    <?php //echo form_error('username'); 
                    ?>

                    <!-- <div class="input-group mb-3">

                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">

                        <div class="input-group-append">

                            <div class="input-group-text">

                                <span class="fas fa-lock"></span>

                            </div>

                        </div>

                    </div> -->

                    <?php //echo form_error('password'); 
                    ?>

                    <div class="row">

                        <div class="col-8">

                            <div class="icheck-primary">

                                <input type="checkbox" id="remember">

                                <label for="remember">

                                    Remember Me

                                </label>

                            </div>

                        </div>

                        <!-- /.col -->

                        <div class="col-4">

                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>

                        </div>

                        <!-- /.col -->

                    </div>

                </form>

            </div>

            <!-- /.login-card-body -->

        </div>

    </div>

    <!-- /.login-box -->



    <!-- jQuery -->

    <script src="<?php echo base_url() ?>public/adminplugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->

    <script src="<?php echo base_url() ?>public/adminplugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->

    <script src="<?php echo base_url() ?>public/admindist/js/adminlte.min.js"></script>

</body>



</html>