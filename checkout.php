<?php
include_once './model/customer_data.php';
include_once './model/address_data.php';
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
    <h1 class="page-title">Check out</h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
            <li class="nav-item"><span class="current-page">Check out</span></li>
        </ul>
    </nav>
</div>

<div class="page-contain checkout">

    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container sm-margin-top-37px">
            <div class="row">

                <!--checkout progress box-->
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <div class="checkout-progress-wrap">
                        <ul class="steps">
                            <li class="step_1st">
                                <div class="checkout-act active">
                                    <h3 class="title-box"><span class="number">1</span>Customer</h3>
                                    <a href="index.php?page=myaccount&part=accountinfo" class="btn btn-bold remove" type="submit" data-toggle="collapse" data-target="#demo" style="float: right; min-width: 75px">Edit</a>
                                    <?php
                                    include './function/dbconnect.php';
                                    $customer = new Customer($_SESSION["cus_id"], "", "", "", "", "", "");
                                    $result = $customer->searchCustomer($conn);
                                    $row = $result->fetch_assoc();
                                    ?>
                                    <div class="box-content">
                                        <table>
                                            <tr>
                                                <td class="col-lg-3">
                                                    <div style="overflow: hidden; width: 150px; height: 150px; border-radius: 50%;">
                                                        <?php
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['cus_imageURL']) . '" id="" alt="alt"/>';
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="col-lg-9">
                                                    <div class="box-content">
                                                        <p class="txt-desc"><span style="font-size: smaller">Customer's name:</span><br> <?php echo $row["cus_name"]; ?></p>
                                                        <p class="txt-desc"><span style="font-size: smaller">Customer's phone number:</span><br> <?php echo $row["cus_phone"]; ?></p>
                                                        <p class="txt-desc"><span style="font-size: smaller">Customer's email:</span><br> <?php echo $row["cus_email"]; ?></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </li>
                            <li class="step_2nd">
                                <div class="checkout-act active">
                                    <h3 class="title-box"><span class="number">2</span>Delivery Address</h3>
                                    <button class="btn btn-bold btnCollapse" type="submit" data-toggle="collapse" data-target="#demo" style="float: right">Change</button>
                                    <?php
                                    include './function/dbconnect.php';
                                    $address = new Address("", $_SESSION["cus_id"], "", "", "", "", "");
                                    $result1 = $address->showAdressByCustomer($conn);
                                    if ($result1->num_rows > 0) {
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $validItem = 0;
                                            if ($row1["add_status"] == 1) {
                                                ?>
                                                <div class="box-content" id="">
                                                    <p class="txt-desc">Recipient's name: <span id="nameAddress"><?php echo $row1["add_name"]; ?></span></p>
                                                    <p class="txt-desc">Recipient's phone number: <span id="phoneAddress"><?php echo $row1["add_phone"]; ?></span></p>
                                                    <p class="txt-desc">Recipient's address: <span id="addressAdd"><?php echo $row1["add_detail"]; ?></span></p>
                                                </div>
                                                <?php
                                                $validItem++;
                                                break;
                                            }
                                        }
                                        if ($validItem == 0) {
                                            ?>
                                            <div class="box-content">
                                                <p class="txt-desc">You don't have any address. Click <a href="index.php?page=myaccount&part=deliveryaddress" style="color: #05a503">here</a> to add an address</p>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="box-content">
                                            <p class="txt-desc">You don't have any address. Click <a href="index.php?page=myaccount&part=deliveryaddress" style="color: #05a503">here</a> to add an address</p>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div id="demo" class="collapse" style="clear: both">
                                        <a href="index.php?page=myaccount&part=deliveryaddress" class="btn btn-bold remove" type="submit" data-toggle="collapse" data-target="#demo" style="float: right">Manage Addresses</a>
                                        <?php
                                        include './function/dbconnect.php';
                                        $result2 = $address->showAdressByCustomer($conn);
                                        ?>
                                        <table>
                                            <?php
                                            $checkItem = 0;
                                            while ($row1 = $result2->fetch_assoc()) {
                                                if ($row1["add_status"] == 1) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="squaredcheck" style="flex: 1 0 auto;display: flex;flex-direction: column;padding-top: 7px">
                                                                <span>
                                                                    <input type="radio" class="chooseAddress" id="<?php echo $row1["add_id"]; ?>" name="chooseAddress" value="" <?php if ($checkItem == 0) { ?> checked <?php } ?>>
                                                                    <label for="<?php echo $row1["add_id"]; ?>"><span></span></label><br>
                                                                </span>
                                                            </div>

                                                        </td>
                                                        <td><span class="addressName"><?php echo $row1["add_name"]; ?></span></td>
                                                        <td><span class="addressPhone"><?php echo $row1["add_phone"]; ?></span></td>
                                                        <td><span class="addressAdress"><?php echo $row1["add_detail"]; ?></span></td>
                                                    </tr>
                                                    <?php
                                                    $checkItem++;
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </li>
                            <li class="step_3rd">
                                <div class="checkout-act active">
                                    <h3 class="title-box"><span class="number">3</span>Payment</h3>
                                    <div class="box-content">
                                        <div class="squaredcheck">
                                            <input type="radio" name="paymentradio" checked id="cash" class="cash" value="cash">
                                            <label for="cash"><span>Cash</span></label><br>
                                        </div>
                                        <div class="squaredcheck">
                                            <input type="radio" name="paymentradio" id="transfer" class="transfer" value="transfer">
                                            <label for="transfer"><span>Bank transfer</span></label><br>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="step_4th">
                                <div class="checkout-act active">
                                    <h3 class="title-box"><span class="number">4</span>Note</h3>
                                    <div class="box-content">
                                        <textarea id="ordernote" name="ordernote" rows="2" style="width: 100%" placeholder="Note about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!--Order Summary-->
                <?php
                $totalQuantity = 0;
                $totalPrice = 0;
                ?>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                    <div class="order-summary sm-margin-bottom-80px" style="background-color: #f0f2f5;">
                        <div class="title-block">
                            <h3 class="title">Order Summary</h3>
                            <a href="index.php?page=cart" class="link-forward">Edit cart</a>
                        </div>
                        <?php
                        if (isset($_SESSION["cart"])) {
                            ?>
                            <div class="cart-list-box short-type">
                                <ul class="cart-list">
                                    <?php
                                    foreach ($_SESSION["cart"] as $item => $value) {
                                        $item_price = $value["quantity"] * $value["price"];
                                        ?>
                                        <li class="cart-elem">
                                            <div class="cart-item">
                                                <div class="product-thumb">
                                                    <a class="prd-thumb" href="productdetails.php?id=<?php echo $item; ?>">
                                                        <figure><img src="<?php echo $value["imageURL"]; ?>" width="113" height="113" alt="shop-cart" ></figure>
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <span class="txt-quantity"><?php echo $value["quantity"]; ?>x</span>
                                                    <a href="productdetails.php?id=<?php echo $item; ?>" class="pr-name"><?php echo $value["name"]; ?></a>
                                                </div>
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount"><span class="currencySymbol">$</span><?php echo $value["price"]; ?></span></ins>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                        $totalQuantity++;
                                        $totalPrice += ($value["quantity"] * $value["price"]);
                                    }
                                    ?>
                                </ul>
                                <ul class="subtotal">
                                    <li>
                                        <div class="subtotal-line subtotal-element">

                                            <span class="number"><?php echo $totalQuantity; ?> items</span>
                                            <b class="stt-name">Subtotal</b>
                                            <span class="stt-price">$<?php echo $totalPrice; ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="subtotal-line">
                                            <button onclick="place_order()" class="btn btn-bold remove" type="submit" style="float: right; color: #fff">Place Order</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="box-content">
                                <p class="txt-desc">No product in your cart</p>
                            </div>
                            <ul class="subtotal">
                                <li>
                                    <div class="subtotal-line">
                                        <a href="product.php" class="btn btn-bold remove" type="submit" style="float: right; color: #fff">Back To Shop</a>
                                    </div>
                                </li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>