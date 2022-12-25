<div class="Product-box sm-margin-top-96px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-6">
                <div class="advance-product-box">
                    <div class="biolife-title-box bold-style biolife-title-box__bold-style">
                        <h3 class="title">Deals of the day</h3>
                    </div>
                    <?php
                    include './function/dbconnect.php';
                    include_once './model/deal_data.php';
                    $deal = new Deal("", "", "", "", "");
                    $result = $deal->showEnableDeals($conn);
                    if ($result->num_rows > 0) {
                        ?>
                        <ul class="products biolife-carousel nav-top-right nav-none-on-mobile"
                            data-slick='{"arrows":true, "dots":false, "infinite":false, "speed":400, "slidesMargin":30, "slidesToShow":1}'>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    include './function/dbconnect.php';
                                    include_once './model/product_data.php';
                                    $product = new Product(intval($row["pro_id"]), "", "", "", "", "", "", "", "");
                                    $result1 = $product->searchProductByID($conn);
                                    if ($result1->num_rows == 1) {
                                        $row1 = $result1->fetch_assoc();

                                        if ($row1["pro_discontinued"] == 0) {
                                            ?>
                                        <li class="product-item">
                                            <div class="contain-product deal-layout contain-product__deal-layout">
                                                <div class="product-thumb">
                                                    <a href="productdetails.php?id=<?php echo $row1["pro_id"]; ?>" class="link-to-product">
                                                        <img src="<?php echo $row1["pro_imageURL"] ?>" alt="dd"
                                                             width="330" height="330" class="product-thumnail">
                                                    </a>
                                                    <div class="labels">
                                                        <span class="sale-label">-<?php echo floatval($row["deal_discount"]) * 100; ?>%</span>
                                                    </div>
                                                </div>
                                                <div class="info">
                                                    <div class="biolife-countdown" data-datetime="<?php echo $row["deal_end"]; ?> 00:00 +07:00">
                                                    </div>
                                                    <b class="categories"><?php echo $row1["cate_name"]; ?></b>
                                                    <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row1["pro_id"]; ?>" class="pr-name"><?php echo $row1["pro_name"]; ?></a></h4>
                                                    <?php
                                                    include './function/dbconnect.php';
                                                    include_once './model/deal_data.php';
                                                    $deal = new Deal("", "", "", "", "");
                                                    $result2 = $deal->showEnableDeals($conn);
                                                    $unitprice = $row1["pro_unitprice"];
                                                    $discount = null;
                                                    if ($result2->num_rows > 0) {
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            if ($row2["pro_id"] == $row1["pro_id"]) {
                                                                $discount = number_format($unitprice - $unitprice * floatval($row2["deal_discount"]), 2, '.', '');
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
                                                    <div class="slide-down-box">
                                                        <p class="message">All products are carefully selected to ensure
                                                            food safety.</p>
                                                        <div class="buttons">
                                                            <a href="javascript:wishlist(<?php echo $row1["pro_id"]; ?>, <?php echo $price; ?>, 'add')" class="btn wishlist-btn"><i class="fa fa-heart"
                                                                                                                                                                                    aria-hidden="true"></i></a>
                                                            <a href="javascript:cart(<?php echo $row1["pro_id"]; ?>, <?php echo $price; ?>, 'add', 1)"" class="btn add-to-cart-btn">add
                                                                to cart</a>
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
                        <?php
                    }
                    ?>
                </div>
            </div>

            <?php
            include './function/dbconnect.php';
            include_once './model/orderdetails_data.php';
            $orderDetail = new OrderDetails("", "", "", "");
            $result3 = $orderDetail->getTop10BestSeller($conn);
            ?>
            <div class="col-lg-8 col-md-7 col-sm-6">
                <div class="advance-product-box">
                    <div class="biolife-title-box bold-style biolife-title-box__bold-style">
                        <h3 class="title">Bestseller Products</h3>
                    </div>
                    <?php
                    if ($result3->num_rows > 0) {
                        ?>
                        <ul class="products biolife-carousel nav-center-03 nav-none-on-mobile row-space-29px"
                            data-slick='{"rows":2,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":2,"responsive":[{"breakpoint":1200,"settings":{ "rows":2, "slidesToShow": 2}},{"breakpoint":992, "settings":{ "rows":2, "slidesToShow": 1}},{"breakpoint":768, "settings":{ "rows":2, "slidesToShow": 2}},{"breakpoint":500, "settings":{ "rows":2, "slidesToShow": 1}}]}'>
                                <?php
                                while ($row3 = $result3->fetch_assoc()) {
                                    include './function/dbconnect.php';
                                    include_once './model/product_data.php';
                                    $product1 = new Product($row3["pro_id"], "", "", "", "", "", "", "", "");
                                    $result4 = $product1->searchProductByID($conn);
                                    $row4 = $result4->fetch_assoc();

                                    if ($row4["pro_discontinued"] == 0) {
                                        ?>
                                    <li class="product-item">
                                        <div
                                            class="contain-product right-info-layout contain-product__right-info-layout">
                                            <div class="product-thumb">
                                                <a href="productdetails.php?id=<?php echo $row4["pro_id"]; ?>" class="link-to-product">
                                                    <img src="<?php echo $row4["pro_imageURL"]; ?>" alt="dd" width="270"
                                                         height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories"><?php echo $row4["cate_name"]; ?></b>
                                                <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row4["pro_id"]; ?>" class="pr-name"><?php echo $row4["pro_name"]; ?></a></h4>
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
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                    <div
                        class="biolife-banner style-01 biolife-banner__style-01 sm-margin-top-30px xs-margin-top-80px">
                        <div class="banner-contain">
                            <a href="#" class="bn-link"></a>
                            <div class="text-content">
                                <span class="first-line">Daily Fresh</span>
                                <b class="second-line">Natural</b>
                                <i class="third-line">Fresh Food</i>
                                <span class="fourth-line">Premium Quality</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>