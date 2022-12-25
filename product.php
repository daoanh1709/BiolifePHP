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
            <h1 class="page-title">Products</h1>
        </div>

        <!--Navigation section-->
        <div class="container">
            <nav class="biolife-nav">
                <ul>
                    <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                    <li class="nav-item"><a href="product.php" class="permal-link">Products</a></li>
                    <?php
                    include './function/dbconnect.php';
                    include_once './model/categories_data.php';
                    $currentCate;
                    $currentCateID = null;
                    if (isset($_GET["category"])) {
                        $cate = $_GET["category"];
                        $category = new Category("", "", "", "");
                        $result = $category->showAllCategories($conn);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if (strtolower(str_replace(" ", "", $row["cate_name"])) == $cate) {
                                    $currentCate = $row["cate_name"];
                                    $currentCateID = $row["cate_id"];
                                }
                            }
                        }
                        ?>
                        <li class="nav-item"><span class="current-page"><?php echo $currentCate; ?></span></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <?php
        include './function/dbconnect.php';
        include_once './model/product_data.php';
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno - 1) * $no_of_records_per_page;
        $total_rows;
        $total_pages;
        $result1;
        if ($currentCateID != null) {
            $total_pages_sql = "SELECT COUNT(*) FROM product WHERE cate_id = '" . $currentCateID . "'";
            include './function/dbconnect.php';
            $result2 = mysqli_query($conn, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result2)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $product = new Product("", "", "", $currentCateID, "", "", "", "", "");
            $result1 = $product->showProductByCategory($conn, $offset, $no_of_records_per_page);
        } else {
            $total_pages_sql = "SELECT COUNT(*) FROM product";
            include './function/dbconnect.php';
            $result2 = mysqli_query($conn, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result2)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $product = new Product("", "", "", "", "", "", "", "", "");
            $result1 = $product->showAllProduct($conn, $offset, $no_of_records_per_page);
        }
        ?>
        <div class="page-contain category-page left-sidebar">
            <div class="container">
                <div class="row">
                    <!-- Main content -->
                    <div id="productContent" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="product-category grid-style">

                            <div id="top-functions-area" class="top-functions-area">
                                <div class="flt-item to-left group-on-mobile">

                                </div>
                            </div>
                            <div class="row">
                                <?php
                                if ($result1->num_rows > 0) {
                                    ?>
                                    <ul class="products-list">
                                        <?php
                                        while ($row = $result1->fetch_assoc()) {
                                            if ($row["pro_discontinued"] == 0) {
                                                include './function/dbconnect.php';
                                                include_once './model/product_data.php';
                                                $product = new Product($row["pro_id"], "", "", "", "", "", "", "", "");
                                                $cateName = $product->getCategoryNameByProductID($conn);
                                                ?>
                                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6" id="hello">
                                                    <div class="contain-product layout-default">
                                                        <div class="product-thumb">
                                                            <a href="productdetails.php?id=<?php echo $row["pro_id"]; ?>" class="link-to-product">
                                                                <img src="<?php echo $row["pro_imageURL"]; ?>" alt="dd" width="270"
                                                                     height="270" class="product-thumnail">
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
                                                                <p class="shipping-day">3-Day Shipping</p>
                                                            </div>
                                                            <div class="slide-down-box">
                                                                <p class="message">All products are carefully selected to ensure food
                                                                    safety.</p>
                                                                <div class="buttons">
                                                                    <a href="javascript:wishlist(<?php echo $row["pro_id"]; ?>, <?php echo $price; ?>, 'add')" class="btn wishlist-btn"><i class="fa fa-heart"
                                                                                                                                                                                           aria-hidden="true"></i></a>
                                                                    <a href="javascript:cart(<?php echo $row["pro_id"]; ?>, <?php echo $price; ?>, 'add', 1)" class="btn add-to-cart-btn"><i
                                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to
                                                                        cart</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="biolife-panigations-block">
                                <ul class="biolife-panigations-block" style="border: none">
                                    <!--<li><a href="?pageno=1" class="link-page current-page">First</a></li>-->
                                    <?php
                                    if ($currentCateID != null) {
                                        $pagLink = "";
                                        if ($pageno >= 2) {
                                            echo "<li><a href='product.php?category=" . strtolower(str_replace(" ", "", $row["cate_name"])) . "&pageno=" . ($pageno - 1) . "' class='link-page'>  Prev </a></li>";
                                        }

                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == $pageno) {
                                                $pagLink .= "<li><a class='link-page' href='product.php?category=" . strtolower(str_replace(" ", "", $row["cate_name"])) . "&pageno=" . $i . "'><span class=current-page>" . $i . " </span></a></li>";
                                            } else {
                                                $pagLink .= "<li><a class='link-page' href='product.php?category=" . strtolower(str_replace(" ", "", $row["cate_name"])) . "&pageno=" . $i . "'> " . $i . " </a></li>";
                                            }
                                        };
                                        echo $pagLink;
                                        if ($pageno < $total_pages) {
                                            echo "<li><a href='product.php?category=" . strtolower(str_replace(" ", "", $row["cate_name"])) . "&pageno=" . ($pageno + 1) . "' class='link-page'>  Next </a></li>";
                                        }
                                    } else {
                                        $pagLink = "";
                                        if ($pageno >= 2) {
                                            echo "<li><a href='product.php?pageno=" . ($pageno - 1) . "' class='link-page'>  Prev </a></li>";
                                        }

                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            if ($i == $pageno) {
                                                $pagLink .= "<li><a class='link-page' href='product.php?pageno=" . $i . "'><span class=current-page>" . $i . " </span></a></li>";
                                            } else {
                                                $pagLink .= "<li><a class='link-page' href='product.php?pageno=" . $i . "'> " . $i . " </a></li>";
                                            }
                                        };
                                        echo $pagLink;
                                        if ($pageno < $total_pages) {
                                            echo "<li><a href='product.php?pageno=" . ($pageno + 1) . "' class='link-page'>  Next </a></li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <!-- Sidebar -->
                    <aside id="sidebar" class="sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <div class="biolife-mobile-panels">
                            <span class="biolife-current-panel-title">Sidebar</span>
                            <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">&times;</a>
                        </div>
                        <div class="sidebar-contain">
                            <div class="widget biolife-filter">
                                <h4 class="wgt-title">Departments</h4>
                                <div class="wgt-content">
                                    <?php
                                    include './function/dbconnect.php';
                                    include_once './model/categories_data.php';
                                    $category = new Category("", "", "", "");
                                    $result = $category->showAllCategories($conn);
                                    if ($result->num_rows > 0) {
                                        ?>
                                        <ul class="cat-list">
                                            <?php
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <li class="cat-list-item"><a href="product.php?category=<?php echo strtolower(str_replace(" ", "", $row["cate_name"])); ?>" class="cat-link"><?php echo $row["cate_name"]; ?></a></li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php
                            include './function/dbconnect.php';
                            include_once './model/orderdetails_data.php';
                            $orderDetail = new OrderDetails("", "", "", "");
                            $result3 = $orderDetail->getTop5BestSeller($conn);
                            ?>
                            <div class="widget biolife-filter">
                                <h4 class="wgt-title">Bestseller</h4>
                                <div class="wgt-content">
                                    <?php
                                    if ($result3->num_rows > 0) {
                                        ?>
                                        <ul class="products">
                                            <?php
                                            while ($row3 = $result3->fetch_assoc()) {
                                                include './function/dbconnect.php';
                                                include_once './model/product_data.php';
                                                $product1 = new Product($row3["pro_id"], "", "", "", "", "", "", "", "");
                                                $result4 = $product1->searchProductByID($conn);
                                                $row4 = $result4->fetch_assoc();
                                                ?>
                                                <li class="pr-item">
                                                    <div class="contain-product style-widget">
                                                        <div class="product-thumb">
                                                            <a href="productdetails.php?id=<?php echo $row4["pro_id"]; ?>" class="link-to-product" tabindex="0">
                                                                <img src="<?php echo $row4["pro_imageURL"]; ?>" alt="dd" width="270"
                                                                     height="270" class="product-thumnail">
                                                            </a>
                                                        </div>
                                                        <div class="info">
                                                            <b class="categories"><?php echo $row4["cate_name"]; ?></b>
                                                            <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row4["pro_id"]; ?>" class="pr-name"
                                                                                         tabindex="0"><?php echo $row4["pro_name"]; ?></a></h4>
                                                                <?php
                                                                include './function/dbconnect.php';
                                                                include_once './model/deal_data.php';
                                                                $deal = new Deal("", "", "", "", "");
                                                                $result5 = $deal->showEnableDeals($conn);
                                                                $unitprice = $row4["pro_unitprice"];
                                                                $discount = null;
                                                                if ($result5->num_rows > 0) {
                                                                    while ($row5 = $result5->fetch_assoc()) {
                                                                        if ($row5["pro_id"] == $row4["pro_id"]) {
                                                                            $discount = number_format($unitprice - $unitprice * floatval($row5["deal_discount"]), 2, '.', '');
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
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </aside>
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
