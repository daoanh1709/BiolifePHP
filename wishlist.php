<?php
$from;

$uri = $_SERVER['REQUEST_URI'];

$query = $_SERVER['QUERY_STRING'];

$domain = $_SERVER['HTTP_HOST'];

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (strpos($url, "index") !== false) {
    if ($query == "") {
        $from = "from=index&page=home";
    } else {
        $from = "from=index&" . $query;
    }
} elseif (strpos($url, "product.php") !== false) {
    if ($query != "") {
        $from = "from=product&" . $query;
    } else {
        $from = "from=product";
    }
} elseif (strpos($url, "details") !== false) {
    $from = "from=details&" . $query;
}
if (!isset($_SESSION["user_name"])) {
    header("location:login.php?" . $from);
}

include_once './model/product_data.php';
$cateArr = array();
?>
<div style="height: 250px">

</div>
<!--Hero Section-->
<div class="hero-section hero-background">
    <h1 class="page-title">Wishlist</h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
            <li class="nav-item"><span class="current-page">Wishlist</span></li>
        </ul>
    </nav>
</div>

<div class="page-contain shopping-cart">
    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">

            <!--Wishlist Table-->
            <div class="shopping-cart-container">
                <div class="row">
                    <?php
                    $totalQuantity = 0;
                    $totalPrice = 0;
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h3 class="box-title">Your wishlist items</h3>
                        <form class="shopping-cart-form" action="#" method="post">
                            <?php
                            if (isset($_SESSION["wishlist"])) {
                                ?>
                                <table class="shop_table cart-form" id="tblWishlist">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product Name</th>
                                            <th class="product-price">Price</th>
                                            <!--<th class="product-quantity">Stock Status</th>-->
                                            <th class="product-subtotal">Add To Cart</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($_SESSION["wishlist"] as $item => $value) {
                                            include './function/dbconnect.php';
                                            $product = new Product($item, "", "", "", "", "", "", "", "");
                                            $result = $product->searchProductByID($conn);
                                            $row = $result->fetch_assoc();
                                            $arrlength = count($cateArr);
                                            if ($arrlength == 0) {
                                                $cateArr[0] = $row["cate_id"];
                                            } else {
                                                $valid = true;
                                                for ($i = 0; $i < $arrlength; $i++) {
                                                    if ($cateArr[$i] == $row["cate_id"]) {
                                                        $valid = false;
                                                        break;
                                                    }
                                                }
                                                if ($valid) {
                                                    $cateArr[$arrlength] = $row["cate_id"];
                                                }
                                            }
                                            ?>
                                            <tr class="cart_item">
                                                <td class="product-thumbnail" data-title="Product Name">
                                                    <a class="prd-thumb" href="productdetails.php?id=<?php echo $item; ?>">
                                                        <figure><img width="113" height="113" src="<?php echo $value["imageURL"]; ?>" alt="shipping cart"></figure>
                                                    </a>
                                                    <a class="prd-name" href="productdetails.php?id=<?php echo $item; ?>"><?php echo $value["name"]; ?></a>
                                                    <div class="action">
                                                        <a href="javascript:remove_wishlist(<?php echo $item; ?>, 'remove')" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    </div>
                                                </td>
                                                <td class="product-price" data-title="Price">
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount price-total"><span class="currencySymbol">$</span><?php echo number_format($value["price"], 2, '.', ''); ?></span></ins>
                                                    </div>
                                                </td>
        <!--                                                <td class="product-subtotal" data-title="StockStatus">
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount">In Stock</span></ins>
                                                    </div>
                                                </td>-->
                                                <td class="product-subtotal" data-title="AddButton">
                                                    <div class="wrap-btn-control">
                                                        <a href="javascript:cart(<?php echo $item; ?>, <?php echo $value["price"]; ?>, 'add', 1)" class="btn btn-bold remove" type="submit" onclick="remove_wishlist(<?php echo $item; ?>, 'remove')">Add To Cart</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                ?>
                                <p class="minicart-empty" style="text-align: center">No products here</p>
                                <?php
                            }
                            ?>
                            <table class="shop_table cart-form">
                                <tr class="cart_item wrap-buttons">
                                    <td class="wrap-btn-control" colspan="4">
                                        <a href="product.php" class="btn back-to-shop">Back to Shop</a>
                                        <button class="btn btn-clear" onclick="clear_wishlist('empty')" type="reset">clear all</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <!--Related Product-->
            <?php
            include './function/dbconnect.php';
            if (count($cateArr) == 0) {
                $product1 = new Product("", "", "", "", "", "", "", "", "");
                $result1 = $product1->showAllProductRelated($conn);
                if ($result1->num_rows > 0) {
                    ?>
                    <div class="product-related-box single-layout">
                        <div class="biolife-title-box lg-margin-bottom-26px-im">
                            <span class="biolife-icon icon-organic"></span>
                            <span class="subtitle">All the best item for You</span>
                            <h3 class="main-title">Related Products</h3>
                        </div>
                        <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                            <?php
                            while ($row1 = $result1->fetch_assoc()) {
                                include './function/dbconnect.php';
                                $product2 = new Product($row1["pro_id"], "", "", "", "", "", "", "", "");
                                $cateName = $product2->getCategoryNameByProductID($conn);
                                if ($row1["pro_discontinued"] == 0) {
                                    ?>
                                    <li class="product-item">
                                        <div class="contain-product layout-default">
                                            <div class="product-thumb">
                                                <a href="productdetails.php?id=<?php echo $row1["pro_id"]; ?>" class="link-to-product">
                                                    <img src="<?php echo $row1["pro_imageURL"]; ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories"><?php echo $cateName; ?></b>
                                                <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row1["pro_id"]; ?>" class="pr-name"><?php echo $row1["pro_name"]; ?></a></h4>
                                                <?php
                                                include './function/dbconnect.php';
                                                include_once './model/deal_data.php';
                                                $deal1 = new Deal("", "", "", "", "");
                                                $result4 = $deal1->showEnableDeals($conn);
                                                $unitprice = $row1["pro_unitprice"];
                                                $discount = null;
                                                if ($result4->num_rows > 0) {
                                                    while ($row3 = $result4->fetch_assoc()) {
                                                        if ($row3["pro_id"] == $row1["pro_id"]) {
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
                                                        <a href="javascript:wishlist(<?php echo $row1["pro_id"]; ?>, <?php echo $price; ?>, 'add')" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                        <a href="javascript:cart(<?php echo $row1["pro_id"]; ?>, <?php echo $price; ?>, 'add', 1)" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
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
                    </div>
                    <?php
                }
            } else {
                $arrlength = count($cateArr);
                ?>
                <div class="product-related-box single-layout">
                    <div class="biolife-title-box lg-margin-bottom-26px-im">
                        <span class="biolife-icon icon-organic"></span>
                        <span class="subtitle">All the best item for You</span>
                        <h3 class="main-title">Related Products</h3>
                    </div>
                    <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>
                        <?php
                        for ($i = 0; $i < $arrlength; $i++) {
                            include './function/dbconnect.php';
                            $product1 = new Product("", "", "", $cateArr[$i], "", "", "", "", "");
                            $result1 = $product1->showRelatedProduct($conn);
                            if ($result1->num_rows > 0) {
                                while ($row1 = $result1->fetch_assoc()) {
                                    include './function/dbconnect.php';
                                    $product2 = new Product($row1["pro_id"], "", "", "", "", "", "", "", "");
                                    $cateName = $product2->getCategoryNameByProductID($conn);
                                    if ($row1["pro_discontinued"] == 0) {
                                        ?>
                                        <li class="product-item">
                                            <div class="contain-product layout-default">
                                                <div class="product-thumb">
                                                    <a href="productdetails.php?id=<?php echo $row1["pro_id"]; ?>" class="link-to-product">
                                                        <img src="<?php echo $row1["pro_imageURL"]; ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <b class="categories"><?php echo $cateName; ?></b>
                                                    <h4 class="product-title"><a href="productdetails.php?id=<?php echo $row1["pro_id"]; ?>" class="pr-name"><?php echo $row1["pro_name"]; ?></a></h4>
                                                    <?php
                                                    include './function/dbconnect.php';
                                                    include_once './model/deal_data.php';
                                                    $deal1 = new Deal("", "", "", "", "");
                                                    $result4 = $deal1->showEnableDeals($conn);
                                                    $unitprice = $row1["pro_unitprice"];
                                                    $discount = null;
                                                    if ($result4->num_rows > 0) {
                                                        while ($row3 = $result4->fetch_assoc()) {
                                                            if ($row3["pro_id"] == $row1["pro_id"]) {
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
                                                            <a href="javascript:wishlist(<?php echo $row1["pro_id"]; ?>, <?php echo $price; ?>, 'add')" class="btn wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                            <a href="javascript:cart(<?php echo $row1["pro_id"]; ?>, <?php echo $price; ?>, 'add', 1)" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>