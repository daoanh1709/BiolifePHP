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
?>
<div style="height: 250px">

</div>
<!--Hero Section-->
<div class="hero-section hero-background">
    <h1 class="page-title">Shopping Cart</h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
            <li class="nav-item"><span class="current-page">Shopping Cart</span></li>
        </ul>
    </nav>
</div>

<div class="page-contain shopping-cart">

    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">

            <!--Cart Table-->
            <div class="shopping-cart-container">
                <div class="row">
                    <?php
                    $totalQuantity = 0;
                    $totalPrice = 0;
                    ?>
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <h3 class="box-title">Your cart items</h3>
                        <form class="shopping-cart-form" action="#" method="post">
                            <table class="shop_table cart-form" id="tblCart">
                                <?php
                                if (isset($_SESSION["cart"])) {
                                    ?>
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product Name</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($_SESSION["cart"] as $item => $value) {
                                            $item_price = $value["quantity"] * $value["price"];
                                            ?>
                                            <tr class="cart_item">
                                                <td class="product-thumbnail" data-title="Product Name">
                                                    <a class="prd-thumb" href="productdetails.php?id=<?php echo $item; ?>">
                                                        <figure><img width="113" height="113" src="<?php echo $value["imageURL"]; ?>" alt="shipping cart"></figure>
                                                    </a>
                                                    <a class="prd-name" href="productdetails.php?id=<?php echo $item; ?>"><?php echo $value["name"]; ?></a>
                                                    <div class="action">
                                                        <a href="javascript:remove_cart(<?php echo $item; ?>, 'remove')" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    </div>
                                                </td>
                                                <td class="product-price" data-title="Price">
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount"><span class="currencySymbol">$</span><?php echo number_format($value["price"], 2, '.', ''); ?></span></ins>
                                                    </div>
                                                </td>
                                                <td class="product-quantity" data-title="Quantity">
                                                    <div class="quantity-box type1">
                                                        <div class="qty-input">
                                                            <input type="text" class="quantity-input" name="qty12554" value="<?php echo $value["quantity"]; ?>" data-max_value="20" data-min_value="1" data-step="1">
                                                            <a href="#" class="qty-btn btn-up" onclick="update_cart(<?php echo $item; ?>, this, 'up', <?php echo $value["price"]; ?>)"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                            <a href="#" class="qty-btn btn-down" onclick="update_cart(<?php echo $item; ?>, this, 'down', <?php echo $value["price"]; ?>)"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal" data-title="Total">
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount price-total"><span class="currencySymbol">$</span><?php echo number_format($item_price, 2, '.', ''); ?></span></ins>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $totalQuantity++;
                                            $totalPrice += ($value["quantity"] * $value["price"]);
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
                                        <button class="btn btn-clear" onclick="clear_cart('empty')" type="reset">clear all</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="shpcart-subtotal-block">
                            <div class="subtotal-line">
                                <b class="stt-name">Subtotal <span class="sub" id="totalItem">(<?php echo $totalQuantity; ?> items)</span></b>
                                <span class="stt-price" id="totalPrice">$<?php echo number_format($totalPrice, 2, '.', ''); ?></span>
                            </div>
                            <div class="btn-checkout">
                                <a href="index.php?page=checkout" class="btn checkout">Check out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-related-box single-layout">
                <div class="biolife-title-box lg-margin-bottom-26px-im">
                    <span class="biolife-icon icon-organic"></span>
                    <span class="subtitle">All the best item for You</span>
                </div>
            </div>

        </div>
    </div>
</div>