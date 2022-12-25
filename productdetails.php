<?php
ob_start();
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
            <h1 class="page-title">Product Details</h1>
        </div>
        <?php
        include './function/dbconnect.php';
        include_once './model/product_data.php';
        include_once './model/image_data.php';
        if (isset($_GET["id"])) {
            $proID = $_GET["id"];
            $product = new Product($proID, "", "", "", "", "", "", "", "");
            $result = $product->searchProductByID($conn);

            include './function/dbconnect.php';
            $cateName = $product->getCategoryNameByProductID($conn);
            $row = $result->fetch_assoc();
            ?>
            <!--Navigation section-->
            <div class="container">
                <nav class="biolife-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                        <li class="nav-item"><a href="product.php" class="permal-link">Products</a></li>
                        <li class="nav-item"><a href="product.php?category=<?php echo strtolower(str_replace(" ", "", $row["cate_name"])); ?>" class="permal-link"><?php echo $cateName; ?></a></li>
                        <li class="nav-item"><span class="current-page"><?php echo $row["pro_name"]; ?></span></li>
                    </ul>
                </nav>
            </div>

            <div class="page-contain single-product">
                <div class="container">

                    <!-- Main content -->
                    <div id="main-content" class="main-content">

                        <!-- summary info -->
                        <div class="sumary-product single-layout">
                            <?php
                            $image = new Image("", $row["pro_id"], "");
                            ?>
                            <div class="media">
                                <ul class="biolife-carousel slider-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".slider-nav"}'>
                                    <li><img src="<?php echo $row["pro_imageURL"]; ?>" alt="" width="500" height="500"></li>
                                    <?php
                                    include './function/dbconnect.php';
                                    $result1 = $image->showImageByProductID($conn);
                                    if ($result1->num_rows > 0) {

                                        while ($row1 = $result1->fetch_assoc()) {
                                            ?>
                                            <li><img src="<?php echo $row1["img_URL"]; ?>" alt="" width="500" height="500"></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <ul class="biolife-carousel slider-nav" data-slick='{"arrows":false,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":4,"slidesToScroll":1,"asNavFor":".slider-for"}'>
                                    <li><img src="<?php echo $row["pro_imageURL"]; ?>" alt="" width="88" height="88"></li>
                                    <?php
                                    include './function/dbconnect.php';
                                    $result1 = $image->showImageByProductID($conn);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {
                                            ?>
                                            <li><img src="<?php echo $row1["img_URL"]; ?>" alt="" width="88" height="88"></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php ?>
                            <div class="product-attribute">
                                <h3 class="title"><?php echo $row["pro_name"]; ?></h3>
                                <div class="rating">
                                    <b class="category" style="margin-left: 0px">By: <?php echo $cateName; ?></b>

                                </div>
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
                                            $discount = $unitprice - $unitprice * floatval($row1["deal_discount"]);
                                        }
                                    }
                                }
                                ?>
                                <div class="price">
                                    <?php
                                    if ($discount != null) {
                                        $price = doubleval($discount);
                                        ?>
                                        <ins><span class="price-amount"><span class="currencySymbol">$</span><?php echo $discount; ?></span></ins>
                                        <del><span class="price-amount"><span class="currencySymbol">$</span><?php echo $unitprice; ?></span></del>
                                        <?php
                                    } else {
                                        $price = $unitprice;
                                        ?>
                                        <ins><span class="price-amount"><span class="currencySymbol">$</span><?php echo $unitprice; ?></span></ins>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="shipping-info">
                                    <p class="shipping-day">3-Day Shipping</p>
                                </div>
                            </div>
                            <div class="action-form">
                                <div class="quantity-box">
                                    <span class="title">Quantity:</span>
                                    <div class="qty-input">
                                        <input type="text" name="qty12554" id="qty12554" value="1" data-max_value="20" data-min_value="1" data-step="1">
                                        <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                        <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="javascript:cart(<?php echo $row["pro_id"]; ?>, <?php echo $price; ?>, 'add', 0)" class="btn add-to-cart-btn">add to
                                        cart</a>
                                    <p class="pull-row">
                                        <a href="javascript:wishlist(<?php echo $row["pro_id"]; ?>, <?php echo $price; ?>, 'add')" class="btn wishlist-btn">wishlist</a>
                                    </p>
                                </div>
                                <div class="social-media">
                                    <ul class="social-list">
                                        <li><a href="#" class="social-link"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#" class="social-link"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#" class="social-link"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                        <li><a href="#" class="social-link"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                        <li><a href="#" class="social-link"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="acepted-payment-methods">
                                    <ul class="payment-methods">
                                        <li><img src="assets/images/card1.jpg" alt="" width="51" height="36"></li>
                                        <li><img src="assets/images/card2.jpg" alt="" width="51" height="36"></li>
                                        <li><img src="assets/images/card3.jpg" alt="" width="51" height="36"></li>
                                        <li><img src="assets/images/card4.jpg" alt="" width="51" height="36"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Tab info -->
                        <div class="product-tabs single-layout biolife-tab-contain">
                            <div class="tab-head">
                                <ul class="tabs">
                                    <li class="tab-element active"><a href="#tab_1st" class="tab-link">Products Descriptions</a></li>
                                    <li class="tab-element" ><a href="#tab_2nd" class="tab-link">Shipping & Delivery</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div id="tab_1st" class="tab-contain desc-tab active">
                                    <p class="desc"><?php echo $row["pro_details"]; ?></p>
                                    <div class="desc-expand">
                                        <span class="title">Organic Fresh Fruit</span>
                                        <ul class="list">
                                            <li>100% real fruit ingredients</li>
                                            <li>100 fresh fruit bags individually wrapped</li>
                                            <li>Blending Eastern & Western traditions, naturally</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab_2nd" class="tab-contain shipping-delivery-tab">
                                    <div class="accodition-tab biolife-accodition">
                                        <ul class="tabs">
                                            <li class="tab-item">
                                                <span class="title btn-expand">How long will it take to receive my order?</span>
                                                <div class="content">
                                                    <p>Orders placed before 3pm eastern time will normally be processed and shipped by the following business day. For orders received after 3pm, they will generally be processed and shipped on the second business day. For example if you place your order after 3pm on Monday the order will ship on Wednesday. Business days do not include Saturday and Sunday and all Holidays. Please allow additional processing time if you order is placed on a weekend or holiday. Once an order is processed, speed of delivery will be determined as follows based on the shipping mode selected:</p>
                                                    <div class="desc-expand">
                                                        <span class="title">Shipping mode</span>
                                                        <ul class="list">
                                                            <li>Standard (in transit 3-5 business days)</li>
                                                            <li>Priority (in transit 2-3 business days)</li>
                                                            <li>Express (in transit 1-2 business days)</li>
                                                            <li>Gift Card Orders are shipped via USPS First Class Mail. First Class mail will be delivered within 8 business days</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">How is the shipping cost calculated?</span>
                                                <div class="content">
                                                    <p>You will pay a shipping rate based on the weight and size of the order. Large or heavy items may include an oversized handling fee. Total shipping fees are shown in your shopping cart. Please refer to the following shipping table:</p>
                                                    <p>Note: Shipping weight calculated in cart may differ from weights listed on product pages due to size and actual weight of the item.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">Why Didn’t My Order Qualify for FREE shipping?</span>
                                                <div class="content">
                                                    <p>We do not deliver to P.O. boxes or military (APO, FPO, PSC) boxes. We deliver to all 50 states plus Puerto Rico. Certain items may be excluded for delivery to Puerto Rico. This will be indicated on the product page.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">Shipping Restrictions?</span>
                                                <div class="content">
                                                    <p>We do not deliver to P.O. boxes or military (APO, FPO, PSC) boxes. We deliver to all 50 states plus Puerto Rico. Certain items may be excluded for delivery to Puerto Rico. This will be indicated on the product page.</p>
                                                </div>
                                            </li>
                                            <li class="tab-item">
                                                <span class="title btn-expand">Undeliverable Packages?</span>
                                                <div class="content">
                                                    <p>Occasionally packages are returned to us as undeliverable by the carrier. When the carrier returns an undeliverable package to us, we will cancel the order and refund the purchase price less the shipping charges. Here are a few reasons packages may be returned to us as undeliverable:</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        include './function/dbconnect.php';
                        $product1 = new Product("", "", "", $row["cate_id"], "", "", "", "", "");
                        $result3 = $product1->showRelatedProduct($conn);
                        ?>
                        <!-- related products -->
                        <div class="product-related-box single-layout">
                            <div class="biolife-title-box lg-margin-bottom-26px-im">
                                <span class="biolife-icon icon-organic"></span>
                                <span class="subtitle">All the best item for You</span>
                                <h3 class="main-title">Related Products</h3>
                            </div>
                            <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                                <?php
                                while ($row2 = $result3->fetch_assoc()) {
                                    if ($row2["pro_id"] != $row["pro_id"]) {

                                        if ($row2["pro_discontinued"] == 0) {
                                            ?>
                                            <li class="product-item">
                                                <div class="contain-product layout-default">
                                                    <div class="product-thumb">
                                                        <a href="productdetails.php?id=<?php echo $row2["pro_id"]; ?>" class="link-to-product">
                                                            <img src="<?php echo $row2["pro_imageURL"]; ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <b class="categories">Fresh Fruit</b>
                                                        <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row2["pro_id"]; ?>" class="pr-name"><?php echo $row2["pro_name"]; ?></a></h4>
                                                        <?php
                                                        include './function/dbconnect.php';
                                                        include_once './model/deal_data.php';
                                                        $deal1 = new Deal("", "", "", "", "");
                                                        $result4 = $deal1->showEnableDeals($conn);
                                                        $unitprice = $row2["pro_unitprice"];
                                                        $discount = null;
                                                        if ($result4->num_rows > 0) {
                                                            while ($row3 = $result4->fetch_assoc()) {
                                                                if ($row3["pro_id"] == $row2["pro_id"]) {
                                                                    $discount = $unitprice - $unitprice * floatval($row3["deal_discount"]);
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <div class="price">
                                                            <?php
                                                            if ($discount != null) {
                                                                $price = doubleval($discount);
                                                                ?>
                                                                <ins><span class="price-amount"><span class="currencySymbol">$</span><?php echo $discount; ?></span></ins>
                                                                <del><span class="price-amount"><span class="currencySymbol">$</span><?php echo $unitprice; ?></span></del>
                                                                <?php
                                                            } else {
                                                                $price = $unitprice;
                                                                ?>
                                                                <ins><span class="price-amount"><span class="currencySymbol">$</span><?php echo $unitprice; ?></span></ins>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="slide-down-box">
                                                            <p class="message">All products are carefully selected to ensure food safety.</p>
                                                            <div class="buttons">
                                                                <a href="javascript:wishlist(<?php echo $row2["pro_id"]; ?>, <?php echo $price; ?>, 'add')" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                                <a href="javascript:cart(<?php echo $row2["pro_id"]; ?>, <?php echo $price; ?>, 'add', 1)" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <?php
        } else {
            header("location:./product.php");
        }
        ?>

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
