<?php 
session_start();
if (isset($_SESSION["admin_name"])) {
    header("location:homeadmin.php");
}
?>
<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Sign In | Biolife Store Admin</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="author" content="okler.net">

        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="assets/vendor/modernizr/modernizr.js"></script>

    </head>
    <body>
        <div id="biof-loading">
            <div class="biof-loading-center">
                <div class="biof-loading-center-absolute">
                    <div class="dot dot-one"></div>
                    <div class="dot dot-two"></div>
                    <div class="dot dot-three"></div>
                </div>
            </div>
        </div>
        <!-- start: page -->
        <section class="body-sign">
            <div class="center-sign">
                <a href="/" class="logo pull-left">
                    <img src="assets/images/logo-biolife-1.png" height="54" alt="Porto Admin" />
                </a>

                <div class="panel panel-sign">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
                    </div>
                    <div class="panel-body">
                        <form action="index.html" method="post">
                            <div class="form-group mb-lg">
                                <label>Email Address</label>
                                <div class="input-group input-group-icon">
                                    <input name="adminEmail" type="email" class="form-control input-lg" id="adminEmail" value="<?php
                                        if (isset($_COOKIE["admin_login"])) {
                                            echo $_COOKIE["admin_login"];
                                        }
                                        ?>" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-lg">
                                <div class="clearfix">
                                    <label class="pull-left">Password</label>
                                </div>
                                <div class="input-group input-group-icon">
                                    <input name="adminPassword" type="password" class="form-control input-lg" id="adminPassword" value="<?php
                                        if (isset($_COOKIE["admin_pwd"])) {
                                            echo $_COOKIE["admin_pwd"];
                                        }
                                        ?>" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </span>
                                </div>
                                <a href="pages-recover-password.html" class="pull-right">Forgot Password?</a>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="checkbox-custom checkbox-default">
                                        <input id="checkbox1" name="rememberme" type="checkbox" class="checkbox1" <?php if (isset($_COOKIE["admin_login"])) { ?> checked <?php } ?> />
                                        <label for="RememberMe">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <button type="button" onclick="signInCheck()" class="btn btn-primary hidden-xs">Sign In</button>
                                    <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
                                </div>
                            </div>

                            <p class="text-center" style="margin-top: 20px">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a>

                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
            </div>
        </section>
        <!-- end: page -->

        <!-- Vendor -->
        <script src="assets/vendor/jquery/jquery.js"></script>
        <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>

    </body><img src="http://www.ten28.com/fref.jpg">
</html>