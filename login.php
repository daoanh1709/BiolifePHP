<?php
$query = $_SERVER['QUERY_STRING'];
$from = "";
$page = "";
$id = "";
$category = "";
if (isset($_GET["from"])) {
    $from = $_GET["from"];
}
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
}
if (isset($_GET["category"])) {
    $category = $_GET["category"];
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign In | Biolife - Organic Food</title>
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/slick.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/main-color01.css">
    </head>

    <body class="biolife-body">

        <!-- Preloader -->
        <div id="biof-loading">
            <div class="biof-loading-center">
                <div class="biof-loading-center-absolute">
                    <div class="dot dot-one"></div>
                    <div class="dot dot-two"></div>
                    <div class="dot dot-three"></div>
                </div>
            </div>
        </div>

        <!-- HEADER -->
        <header id="header" class="header-area style-01 layout-01" style="position: relative; z-index: 0">
            <div class="header-middle biolife-sticky-object">
                <div class="container md-possition-relative">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-md-12 col-xs-12" style="display: flex; align-items: center;">
                            <a href="index.php?page=home" class="biolife-logo"><img src="assets/images/organic-3-green.png"
                                                                                    alt="biolife logo" style="display: inline-block; padding-right: 20px" width="135" height="36"></a>
                            <div style="font-family: 'Cairo', sans-serif; font-size: 30px; font-weight: bold">Sign In</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Contain -->

        <div class="page-contain login-page" style="background-color: #f0f2f5;">

            <!-- Main content -->
            <div id="main-content" class="main-content">
                <div class="container">

                    <div class="row" style="background-color: #FFFFFF; margin-bottom: 60px; border-radius: 7px; margin-top: 60px; box-shadow: 0 2px 4px rgb(0 0 0 / 10%), 0 8px 16px rgb(0 0 0 / 10%)">

                        <!--Form Sign In-->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                            <div class="signin-container">
                                <form action="" name="frm-login" method="post" class="login-form">
                                    <p class="form-row">
                                        <label for="fid-name">Email Address <span class="requite">*</span></label>
                                        <input type="email" id="email_address" name="email_address" value="<?php
                                        if (isset($_COOKIE["member_login"])) {
                                            echo $_COOKIE["member_login"];
                                        }
                                        ?>" class="txt-input" required>
                                    </p>
                                    <p class="form-row">
                                        <label for="fid-pass">Password <span class="requite">*</span></label>
                                        <input type="password" id="password" name="password" value="<?php
                                        if (isset($_COOKIE["member_pwd"])) {
                                            echo $_COOKIE["member_pwd"];
                                        }
                                        ?>" class="txt-input" required>
                                    </p>
                                    <div class="squaredcheck">
                                        <input type="checkbox" name="check" <?php if (isset($_COOKIE["member_login"])) { ?> checked <?php } ?> id="squaredcheck" class="checkbox1" value="checked">
                                        <label for="squaredcheck"><span>Remember Me</span></label><br>
                                    </div>
                                    <p class="form-row wrap-btn">
                                        <button class="btn btn-submit btn-bold" type="button" onclick="loginCheck('<?php echo $from; ?>', '<?php echo $page; ?>', '<?php echo $id; ?>', '<?php echo $category; ?>')" name="submit">sign in</button>
                                        <a href="forgotpass.php?<?php echo $query; ?>" class="link-to-help">Forgot your password</a>
                                    </p>
                                </form>
                            </div>
                        </div>

                        <!--Go to Register form-->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="register-in-container">
                                <div class="intro">
                                    <h4 class="box-title">New Customer?</h4>
                                    <p class="sub-title">Create an account with us and you’ll be able to:</p>
                                    <ul class="lis">
                                        <li>Check out faster</li>
                                        <li>Save multiple shipping anddesses</li>
                                        <li>Access your order history</li>
                                        <li>Track new orders</li>
                                        <li>Save items to your Wishlist</li>
                                    </ul>
                                    <a href="register.php?<?php echo $query; ?>" class="btn btn-bold">Create an account</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <?php
        include_once './footer.php';
        ?>

        <!--Mobile Global Menu-->
        <div class="mobile-block-global">
            <div class="biolife-mobile-panels">
                <span class="biolife-current-panel-title">Global</span>
                <a class="biolife-close-btn" data-object="global-panel-opened" href="#">&times;</a>
            </div>
            <div class="block-global-contain">
                <div class="glb-item my-account">
                    <b class="title">My Account</b>
                    <ul class="list">
                        <li class="list-item"><a href="#">Login/register</a></li>
                        <li class="list-item"><a href="#">Wishlist <span class="index">(8)</span></a></li>
                        <li class="list-item"><a href="#">Checkout</a></li>
                    </ul>
                </div>
                <div class="glb-item currency">
                    <b class="title">Currency</b>
                    <ul class="list">
                        <li class="list-item"><a href="#">€ EUR (Euro)</a></li>
                        <li class="list-item"><a href="#">$ USD (Dollar)</a></li>
                        <li class="list-item"><a href="#">£ GBP (Pound)</a></li>
                        <li class="list-item"><a href="#">¥ JPY (Yen)</a></li>
                    </ul>
                </div>
                <div class="glb-item languages">
                    <b class="title">Language</b>
                    <ul class="list inline">
                        <li class="list-item"><a href="#"><img src="assets/images/languages/us.jpg" alt="flag" width="24"
                                                               height="18"></a></li>
                        <li class="list-item"><a href="#"><img src="assets/images/languages/fr.jpg" alt="flag" width="24"
                                                               height="18"></a></li>
                        <li class="list-item"><a href="#"><img src="assets/images/languages/ger.jpg" alt="flag" width="24"
                                                               height="18"></a></li>
                        <li class="list-item"><a href="#"><img src="assets/images/languages/jap.jpg" alt="flag" width="24"
                                                               height="18"></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Quickview Popup-->
        <div id="biolife-quickview-block" class="biolife-quickview-block">
            <div class="quickview-container">
                <a href="#" class="btn-close-quickview" data-object="open-quickview-block"><span
                        class="biolife-icon icon-close-menu"></span></a>
                <div class="biolife-quickview-inner">
                    <div class="media">
                        <ul class="biolife-carousel quickview-for"
                            data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".quickview-nav"}'>
                            <li><img src="assets/images/details-product/detail_01.jpg" alt="" width="500" height="500"></li>
                            <li><img src="assets/images/details-product/detail_02.jpg" alt="" width="500" height="500"></li>
                            <li><img src="assets/images/details-product/detail_03.jpg" alt="" width="500" height="500"></li>
                            <li><img src="assets/images/details-product/detail_04.jpg" alt="" width="500" height="500"></li>
                            <li><img src="assets/images/details-product/detail_05.jpg" alt="" width="500" height="500"></li>
                            <li><img src="assets/images/details-product/detail_06.jpg" alt="" width="500" height="500"></li>
                            <li><img src="assets/images/details-product/detail_07.jpg" alt="" width="500" height="500"></li>
                        </ul>
                        <ul class="biolife-carousel quickview-nav"
                            data-slick='{"arrows":true,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":3,"slidesToScroll":1,"asNavFor":".quickview-for"}'>
                            <li><img src="assets/images/details-product/thumb_01.jpg" alt="" width="88" height="88"></li>
                            <li><img src="assets/images/details-product/thumb_02.jpg" alt="" width="88" height="88"></li>
                            <li><img src="assets/images/details-product/thumb_03.jpg" alt="" width="88" height="88"></li>
                            <li><img src="assets/images/details-product/thumb_04.jpg" alt="" width="88" height="88"></li>
                            <li><img src="assets/images/details-product/thumb_05.jpg" alt="" width="88" height="88"></li>
                            <li><img src="assets/images/details-product/thumb_06.jpg" alt="" width="88" height="88"></li>
                            <li><img src="assets/images/details-product/thumb_07.jpg" alt="" width="88" height="88"></li>
                        </ul>
                    </div>
                    <div class="product-attribute">
                        <h4 class="title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                        <div class="rating">
                            <p class="star-rating"><span class="width-80percent"></span></p>
                        </div>

                        <div class="price price-contain">
                            <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                            <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                        </div>
                        <p class="excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel maximus
                            lacus. Duis ut mauris eget justo dictum tempus sed vel tellus.</p>
                        <div class="from-cart">
                            <div class="qty-input">
                                <input type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1"
                                       data-step="1">
                                <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                            </div>
                            <div class="buttons">
                                <a href="#" class="btn add-to-cart-btn btn-bold">add to cart</a>
                            </div>
                        </div>

                        <div class="product-meta">
                            <div class="product-atts">
                                <div class="product-atts-item">
                                    <b class="meta-title">Categories:</b>
                                    <ul class="meta-list">
                                        <li><a href="#" class="meta-link">Milk & Cream</a></li>
                                        <li><a href="#" class="meta-link">Fresh Meat</a></li>
                                        <li><a href="#" class="meta-link">Fresh Fruit</a></li>
                                    </ul>
                                </div>
                                <div class="product-atts-item">
                                    <b class="meta-title">Tags:</b>
                                    <ul class="meta-list">
                                        <li><a href="#" class="meta-link">food theme</a></li>
                                        <li><a href="#" class="meta-link">organic food</a></li>
                                        <li><a href="#" class="meta-link">organic theme</a></li>
                                    </ul>
                                </div>
                                <div class="product-atts-item">
                                    <b class="meta-title">Brand:</b>
                                    <ul class="meta-list">
                                        <li><a href="#" class="meta-link">Fresh Fruit</a></li>
                                    </ul>
                                </div>
                            </div>
                            <span class="sku">SKU: N/A</span>
                            <div class="biolife-social inline add-title">
                                <span class="fr-title">Share:</span>
                                <ul class="socials">
                                    <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter"
                                                                                          aria-hidden="true"></i></a></li>
                                    <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook"
                                                                                           aria-hidden="true"></i></a></li>
                                    <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest"
                                                                                            aria-hidden="true"></i></a></li>
                                    <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube"
                                                                                          aria-hidden="true"></i></a></li>
                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram"
                                                                                            aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Top Button -->
        <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.countdown.min.js"></script>
        <script src="assets/js/jquery.nice-select.min.js"></script>
        <script src="assets/js/jquery.nicescroll.min.js"></script>
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/biolife.framework.js"></script>
        <script src="assets/js/functions.js"></script>
    </body>

</html>