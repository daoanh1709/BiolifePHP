<?php
session_start();
include '../function/dbconnect.php';
include_once '../model/orderdetails_data.php';
$orderid = $_GET["orderid"];
$orderDetail = new OrderDetails($orderid, "", "", "");
$result = $orderDetail->searchOrderDetailsByID($conn);
?>
<div class = "modal-dialog">
    <div class = "modal-content">

        <!--Modal Header-->
        <div class = "modal-header">
            <h4 class = "modal-title" style="font-weight: bold">Order Details</h4>
        </div>

        <!--Modal body-->
        <div class = "modal-body" style="padding-top: 0px">
            <?php
            $totalQuantity = 0;
            $totalPrice = 0;
            include '../function/dbconnect.php';
            include_once '../model/order_data.php';
            $order = new Order($orderid, "", "", "", "", "", "");
            $result1 = $order->searchAddressOfOrder($conn);
            $row1 = $result1->fetch_assoc();
            ?>
            <div class="">
                <div class="order-summary sm-margin-bottom-80px" style="background-color: #fff; padding-top: 0px">
                    <div class="cart-list-box short-type">
                        <ul class="subtotal">
                            <li style="border-top: none; border-bottom: 1px solid #e6e6e6;margin-bottom: 20px">
                                <div class="">
                                    <b class="stt-name" style="display: inline-block; font-size: 14px; line-height: 30px; color: #222222; font-weight: 700; text-transform: uppercase">Delivery Address</b>
                                    <p class="txt-desc"><span id="nameAddress"><?php echo $row1["add_name"]; ?></span></p>
                                    <p class="txt-desc"><span id="phoneAddress"><?php echo $row1["add_phone"]; ?></span></p>
                                    <p class="txt-desc"><span id="addressAdd"><?php echo $row1["add_detail"]; ?></span></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="cart-list" style="margin-bottom: 0px">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                include '../function/dbconnect.php';
                                include_once '../model/product_data.php';
                                $product = new Product($row["pro_id"], "", "", "", "", "", "", "", "");
                                $result1 = $product->searchProductByID($conn);
                                $row1 = $result1->fetch_assoc();
                                $item_price = $row["quantity"] * $row["unitprice"];
                                ?>
                                <li class="cart-elem">
                                    <div class="cart-item">
                                        <div class="product-thumb">
                                            <a class="prd-thumb" href="productdetails.php?id=<?php echo $item; ?>">
                                                <figure><img src="<?php echo $row1["pro_imageURL"]; ?>" width="80" height="80" alt="shop-cart" ></figure>
                                            </a>
                                        </div>
                                        <div class="info" style="padding-top: 0px">
                                            <span class="txt-quantity"><?php echo $row["quantity"]; ?>x</span>
                                            <a href="productdetails.php?id=<?php echo $row["pro_id"]; ?>" class="pr-name"><?php echo $row1["pro_name"]; ?></a>
                                        </div>
                                        <div class="price price-contain">
                                            <ins><span class="price-amount"><span class="currencySymbol">$</span><?php echo $item_price; ?></span></ins>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                $totalQuantity++;
                                $totalPrice += ($row["quantity"] * $row["unitprice"]);
                            }
                            ?>
                        </ul>
                        <ul class="subtotal">
                            <li>
                                <div class="subtotal-line subtotal-element">
                                    <b class="stt-name">Subtotal</b>
                                    <span class="stt-price">$<?php echo $totalPrice; ?></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>