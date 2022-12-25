<?php
include './function/dbconnect.php';
include_once './model/categories_data.php';
$category = new Category("", "", "", "");
$result = $category->showAllCategories($conn);
if ($result->num_rows > 0) {
    ?>
    <div class="product-tab z-index-20 sm-margin-top-71px xs-margin-top-80px">
        <div class="container">
            <div
                class="biolife-title-box biolife-title-box__icon-at-top-style hidden-icon-on-mobile sm-margin-bottom-24px">
                <span class="icon-at-top biolife-icon icon-organic"></span>
                <span class="subtitle">All the best item for You</span>
                <h3 class="main-title">Featured Products</h3>
            </div>
            <div class="biolife-tab biolife-tab-contain">
                <div class="tab-head tab-head__sample-layout type-02 xs-margin-bottom-15px ">
                    <ul class="tabs">
                        <?php
                        $i = 0;
                        while ($row = $result->fetch_assoc()) {
                            $i = $i + 1;
                            ?>
                            <li class="tab-element <?php if ($i == 1) echo 'active'; ?>">
                                <a href="#tab01_<?php echo $i; ?>" class="tab-link"><?php echo $row["cate_name"] ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="tab-content">
                    <?php
                    $i = 0;
                    include './function/dbconnect.php';
                    $result = $category->showAllCategories($conn);
                    while ($row = $result->fetch_assoc()) {
                        $i = $i + 1;
                        ?>
                        <div id="tab01_<?php echo $i; ?>" class="tab-contain <?php if ($i == 1) echo 'active'; ?>">
                            <?php
                            include './function/dbconnect.php';
                            include_once './model/product_data.php';
                            $product = new Product("", "", "", intval($row["cate_id"]), "", "", "", "", "");
                            $result1 = $product->showRelatedProduct($conn);
                            if ($result1->num_rows > 0) {
                                ?>
                                <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile eq-height-contain"
                                    data-slick='{"rows":1 ,"arrows":true,"dots":false,"infinite":true,"speed":400,"slidesMargin":10,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin": 30}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin": 15}}]}'>
                                        <?php
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($row1["pro_discontinued"] == 0) {
                                                if ($row1["pro_featured"] == 1) {
                                                    ?>     
                                                <li class="product-item">
                                                    <div class="contain-product layout-default">
                                                        <div class="product-thumb">
                                                            <a href="productdetails.php?id=<?php echo $row1["pro_id"]; ?>" class="link-to-product">
                                                                <img src="<?php echo $row1["pro_imageURL"] ?>" alt="<?php echo $row["cate_name"] ?>"
                                                                     width="270" height="270" class="product-thumnail">
                                                            </a>
                        <!--                                                    <a class="lookup btn_call_quickview" href="#"><i
                                                                    class="biolife-icon icon-search"></i></a>-->
                                                        </div>
                                                        <div class="info">
                                                            <b class="categories"><?php echo $row["cate_name"] ?></b>
                                                            <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row1["pro_id"]; ?>" class="pr-name"><?php echo $row1["pro_name"] ?></a></h4>
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
                                                                    <a href="javascript:cart(<?php echo $row1["pro_id"]; ?>, <?php echo $price; ?>, 'add', 1)" class="btn add-to-cart-btn"><i
                                                                            class="fa fa-cart-arrow-down" aria-hidden="true"></i>add
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
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>