<?php
include './function/dbconnect.php';
include_once './model/categories_data.php';
$currentCate;
$currentCateID = null;
$keyword = $_GET['s'];
if (isset($_GET['category'])) {
    $cate = $_GET["category"];
    $category1 = new Category("", "", "", "");
    $result1 = $category1->showAllCategories($conn);
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            if (strtolower(str_replace(" ", "", $row1["cate_name"])) == $cate) {
                $currentCate = $row1["cate_name"];
                $currentCateID = $row1["cate_id"];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Biolife - Organic Food</title>
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
        <header id="header" class="header-area style-01 layout-01">
            <?php
            include_once './header.php';
            include_once './menu.php';
            ?>
        </header>

        <!-- Page Contain -->
        <div style="height: 250px">

        </div>
        <!--Hero Section-->
        <div class="hero-section hero-background">
            <h1 class="page-title">Search</h1>
        </div>

        <?php
        include './function/dbconnect.php';
        include_once './model/product_data.php';
        $result1;
        if ($currentCateID != null) {
            $product = new Product("", "", "", $currentCateID, "", "", "", "", "");
            $result1 = $product->searchByKeywordAndCategory($conn, $keyword);
        } else {
            $product = new Product("", "", "", "", "", "", "", "", "");
            $result1 = $product->searchByKeyword($conn, $keyword);
        }
        if ($result1->num_rows > 0) {
            ?>
            <!--Navigation section-->
            <div class="container">
                <h2 style="color: black">Search results for "<?php echo $keyword; ?>"</h2>
            </div>

            <div class="page-contain category-page left-sidebar">
                <div class="container">
                    <div class="row">
                        <!-- Main content -->
                        <div class="product-category grid-style">

                            <div id="top-functions-area" class="top-functions-area" >
                                <div class="flt-item to-left group-on-mobile">
                                    <div class="wrap-selectors">
                                    </div>
                                </div>
                                <div class="flt-item to-right">
                                </div>
                            </div>

                            <div class="row">
                                <ul class="products-list">
                                    <?php
                                    while ($row = $result1->fetch_assoc()) {
                                        include './function/dbconnect.php';
                                        include_once './model/product_data.php';
                                        $product = new Product($row["pro_id"], "", "", "", "", "", "", "", "");
                                        $cateName = $product->getCategoryNameByProductID($conn);
                                        ?>
                                        <li class="product-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                            <div class="contain-product layout-default">
                                                <div class="product-thumb">
                                                    <a href="productdetails.php?id=<?php echo $row["pro_id"]; ?>" class="link-to-product">
                                                        <img src="<?php echo $row["pro_imageURL"]; ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <b class="categories"><?php echo $cateName; ?></b>
                                                    <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row["pro_id"]; ?>" class="pr-name"><?php echo $row["pro_name"]; ?></a></h4>
                                                    <?php
                                                    include './function/dbconnect.php';
                                                    include_once './model/deal_data.php';
                                                    $deal = new Deal("", "", "", "", "");
                                                    $result2 = $deal->showEnableDeals($conn);
                                                    $unitprice = $row["pro_unitprice"];
                                                    $discount = null;
                                                    if ($result2->num_rows > 0) {
                                                        while ($row1 = $result2->fetch_assoc()) {
                                                            if ($row1["pro_id"] == $row["pro_id"]) {
                                                                $discount = number_format($unitprice - $unitprice * floatval($row1["deal_discount"]), 2, '.', '');
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <div class="price">
                                                        <?php
                                                        $price;
                                                        if ($discount != null) {
                                                            $price = doubleval($discount);
                                                            ?>
                                                            <ins><span class="price-amount"><span
                                                                        class="currencySymbol">$</span><?php echo $discount; ?></span></ins>
                                                            <del><span class="price-amount"><span
                                                                        class="currencySymbol">$</span><?php echo $unitprice; ?></span></del>
                                                                <?php
                                                            } else {
                                                                $price = $unitprice;
                                                                ?>
                                                            <ins><span class="price-amount"><span
                                                                        class="currencySymbol">$</span><?php echo $unitprice; ?></span></ins>
                                                                <?php
                                                            }
                                                            ?>
                                                    </div>
                                                    <div class="shipping-info">
                                                        <p class="for-today">Pree Pickup Today</p>
                                                    </div>
                                                    <div class="slide-down-box">
                                                        <p class="message">All products are carefully selected to ensure food safety.</p>
                                                        <div class="buttons">
                                                            <a href="javascript:wishlist(<?php echo $row["pro_id"]; ?>, <?php echo $price; ?>, 'add')" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                            <a href="javascript:cart(<?php echo $row["pro_id"]; ?>, <?php echo $price; ?>, 'add', 1)" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            } else {
                                ?>
                                <div class = "container">
                                    <h2 style = "color: black">No results for "<?php echo $keyword; ?>"</h2>
                                </div>
                                <?php
                            }
                            ?>
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
