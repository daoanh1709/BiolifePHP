<?php
session_start();
include '../function/dbconnect.php';
include_once '../model/order_data.php';
$cus_id = $_SESSION["cus_id"];
$order = new Order("", $cus_id, "", "", "", "", "");
$result;

if (isset($_GET["action"]) && $_GET["action"] == "load") {
    $result = $order->getOrderOfCustomer($conn);
}

if (isset($_GET["action"]) && $_GET["action"] == "filter") {
    if ($_GET["select"] == "allorder") {
        $result = $order->getOrderOfCustomer($conn);
    } else if ($_GET["select"] == "unconfirmed") {
        $order->setStatusID(0);
        $result = $order->getOrderOfCustomerWithStatus($conn);
    } else if ($_GET["select"] == "confirmed") {
        $order->setStatusID(1);
        $result = $order->getOrderOfCustomerWithStatus($conn);
    } else if ($_GET["select"] == "delivering") {
        $order->setStatusID(2);
        $result = $order->getOrderOfCustomerWithStatus($conn);
    } else if ($_GET["select"] == "received") {
        $order->setStatusID(3);
        $result = $order->getOrderOfCustomerWithStatus($conn);
    } else if ($_GET["select"] == "cancelled") {
        $order->setStatusID(4);
        $result = $order->getOrderOfCustomerWithStatus($conn);
    }
}

if (isset($_GET['action']) && $_GET['action'] == "remove") {
    $id = $_GET['id'];
    $order1 = new Order($id, "", "", "", "", "", "");
    $result1 = $order1->searchOrderByID($conn);
    if ($result1->num_rows == 1) {
        $row = $result1->fetch_assoc();
        if ($row['sta_id'] == 0) {
            include '../function/dbconnect.php';
            if ($order1->cancelOrder($conn) == true) {
                include '../function/dbconnect.php';
                if ($_GET["select"] == "allorder" || $_GET['select'] == "") {
                    $result = $order->getOrderOfCustomer($conn);
                } else if ($_GET["select"] == "unconfirmed") {
                    $order->setStatusID(0);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                } else if ($_GET["select"] == "confirmed") {
                    $order->setStatusID(1);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                } else if ($_GET["select"] == "delivering") {
                    $order->setStatusID(2);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                } else if ($_GET["select"] == "received") {
                    $order->setStatusID(3);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                } else if ($_GET["select"] == "cancelled") {
                    $order->setStatusID(4);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                }
//                exit();
            } else {
                echo 'Your order has not been canceled. Please check';
                exit();
            }
        } else {
            echo 'You cannot cancel this order';
            exit();
        }
    } else {
        echo 'This order does not exist';
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == "receive") {
    $id = $_GET['id'];
    $order1 = new Order($id, "", "", "", "", "", "");
    $result1 = $order1->searchOrderByID($conn);
    if ($result1->num_rows == 1) {
        $row = $result1->fetch_assoc();
        if ($row['sta_id'] == 2) {
            include '../function/dbconnect.php';
            if ($order1->receiveOrder($conn) == true) {
                include '../function/dbconnect.php';
                if ($_GET["select"] == "allorder" || $_GET['select'] == "") {
                    $result = $order->getOrderOfCustomer($conn);
                } else if ($_GET["select"] == "unconfirmed") {
                    $order->setStatusID(0);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                } else if ($_GET["select"] == "confirmed") {
                    $order->setStatusID(1);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                } else if ($_GET["select"] == "delivering") {
                    $order->setStatusID(2);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                } else if ($_GET["select"] == "received") {
                    $order->setStatusID(3);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                } else if ($_GET["select"] == "cancelled") {
                    $order->setStatusID(4);
                    $result = $order->getOrderOfCustomerWithStatus($conn);
                }
            } else {
                echo 'Your order has not been updated. Please check';
                exit();
            }
        } else {
            echo 'You cannot update this order';
            exit();
        }
    } else {
        echo 'This order does not exist';
        exit();
    }
}
?>

<?php
if ($result->num_rows > 0) {
    ?>
    <div id="top-functions-area" class="top-functions-area" style="border-bottom: none; padding-bottom: 0px">
        <div class="flt-item to-left group-on-mobile">

        </div>
        <div class="flt-item to-right" id="changeOrder">
            <span class="flt-title">Filter</span>
            <div class="wrap-selectors">
                <div class="selector-item orderby-selector">
                    <select name="filterorder" id="filterorder" class="filterorder" aria-label="Shop order">
                        <option value="allorder" <?php if ($_GET["action"] == "load" || ($_GET["action"] == "filter" && $_GET["select"] == "allorder") || ($_GET["action"] == "remove" && $_GET["select"] == "allorder") || ($_GET["action"] == "receive" && $_GET["select"] == "allorder")) { ?> selected <?php } ?>>All</option>
                        <option value="unconfirmed" <?php if (($_GET["action"] == "filter" && $_GET["select"] == "unconfirmed") || ($_GET["action"] == "remove" && $_GET["select"] == "unconfirmed") || ($_GET["action"] == "receive" && $_GET["select"] == "unconfirmed")) { ?> selected <?php } ?>>Unconfirmed</option>
                        <option value="confirmed" <?php if (($_GET["action"] == "filter" && $_GET["select"] == "confirmed") || ($_GET["action"] == "remove" && $_GET["select"] == "confirmed") || ($_GET["action"] == "receive" && $_GET["select"] == "confirmed")) { ?> selected <?php } ?>>Confirmed</option>
                        <option value="delivering" <?php if (($_GET["action"] == "filter" && $_GET["select"] == "delivering") || ($_GET["action"] == "remove" && $_GET["select"] == "delivering") || ($_GET["action"] == "receive" && $_GET["select"] == "delivering")) { ?> selected <?php } ?>>Delivering</option>
                        <option value="received" <?php if (($_GET["action"] == "filter" && $_GET["select"] == "received") || ($_GET["action"] == "remove" && $_GET["select"] == "received") || ($_GET["action"] == "receive" && $_GET["select"] == "received")) { ?> selected <?php } ?>>Delivered</option>
                        <option value="cancelled" <?php if (($_GET["action"] == "filter" && $_GET["select"] == "cancelled") || ($_GET["action"] == "remove" && $_GET["select"] == "cancelled") || ($_GET["action"] == "receive" && $_GET["select"] == "cancelled")) { ?> selected <?php } ?>>Cancelled</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <table class="shop_table cart-form" id="tblWishlist">
        <thead>
            <tr>
                <th class="product-price" style="width: auto">ID</th>
                <th class="product-price" style="width: auto">Date</th>
                <th class="product-name" style="width: auto">Total</th>
                <th class="product-price" style="width: auto">Payment Method</th>
                <th class="product-subtotal" style="width: 229px">Status</th>
                <th colspan="3" class="product-subtotal" style="width: auto">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                $total = 0;
                ?>
                <tr class="cart_item">
                    <td class="product-price" data-title="Price">
                        <span class="order_id"><?php echo $row["ord_id"]; ?></span>
                    </td>
                    <td class="product-price" data-title="Price">
                        <span class="order_date"><?php echo $row["ord_date"]; ?></span>
                    </td>
                    <td class="product-price" data-title="Price">
                        <?php
                        include '../function/dbconnect.php';
                        include_once '../model/orderdetails_data.php';
                        $orderDetail = new OrderDetails($row["ord_id"], "", "", "");
                        $result1 = $orderDetail->searchOrderDetailsByID($conn);
                        while ($row1 = $result1->fetch_assoc()) {
                            $total = $total + $row1["unitprice"] * $row1["quantity"];
                        }
                        ?>
                        <span class="order_total">$<?php echo $total; ?></span>
                    </td>
                    <td class="product-price" data-title="Price">
                        <span class="order_payment"><?php echo $row["ord_payment"]; ?></span>
                    </td>
                    <td class="product-price" data-title="Price">
                        <span class="order_status"><?php echo $row["sta_description"]; ?></span>
                    </td>
                    <td class="product-price" data-title="Price">
                        <div class="action">
                            <?php
                            if ($row["sta_id"] == 2) {
                                ?>
                                <button id="receive-order" onclick="receive_order(<?php echo $row["ord_id"]; ?>)" title="Item received" class="" style="border: none; background-color: unset"><i class="fa fa-get-pocket" aria-hidden="true"></i></button>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                    <td class="product-price" data-title="Price">
                        <div class="action">
                            <button id="remove-order" onclick="remove_order(<?php echo $row["ord_id"]; ?>)" class="" style="border: none; background-color: unset" <?php if ($row["sta_id"] != 0) { ?> disabled title="You cannot cancel this order." <?php } ?>><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </div>
                    </td>
                    <td class="product-price" data-title="Price">
                        <div class="action">
                            <button id="view-order" data-toggle="modal" data-target="#viewOrder" class="view" style="border: none; background-color: unset"><i class="fa fa-eye" aria-hidden="true"></i></button>
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
    <p class="minicart-empty" style="text-align: center">You don't have any order</p>
    <?php
}
?>