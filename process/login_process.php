<?php

ob_start();
session_start();
$valid = true;
$from;
if (isset($_GET["from"])) {
    $from = $_GET["from"];
}

if (isset($_GET['action']) && $_GET['action'] == "login") {
    include '../function/dbconnect.php';
    include_once '../model/customer_data.php';
    $email = $_GET["email"];
    $password = $_GET["pass"];
    $customer = new Customer("", "", "", "", $email, $password, "");
    $result = $customer->loginCheck($conn);
    $toRec = $result->num_rows;
    if ($toRec == 1) {
        if (isset($_GET["check"]) && $_GET["check"] == "checked") {
            setcookie('member_login', $email, time() + 60 * 60 * 1, '/Biolife');
            setcookie('member_pwd', $password, time() + 60 * 60 * 1, '/Biolife');
        } else if (isset($_GET["check"]) && $_GET["check"] == "") {
            if (isset($_COOKIE["member_login"])) {
                setcookie('member_login', '', 0, '/Biolife');
            }
            if (isset($_COOKIE["member_pwd"])) {
                setcookie('member_pwd', '', 0, '/Biolife');
            }
        }
        $row = $result->fetch_assoc();
        $cus_name = $row["cus_name"];
        $cus_id = $row["cus_id"];
        $_SESSION["user_name"] = $cus_name;
        $_SESSION["cus_id"] = $cus_id;
        $_SESSION["last_login"] = time();
        // Get cart item from database
        include '../function/dbconnect.php';
        include_once '../model/cart_data.php';
        $cart = new Cart($cus_id, "", "", "cart");
        $result1 = $cart->getCartByCusID($conn);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                include '../function/dbconnect.php';
                $stmt = $conn->prepare("SELECT pro_id, pro_name, pro_unitprice, pro_imageURL FROM product WHERE pro_id = ?");
                $stmt->bind_param("i", $row1["pro_id"]);
                $stmt->execute();
                $result2 = $stmt->get_result()->fetch_assoc();
                if (isset($result2["pro_id"]) && $result2["pro_id"]) {
                    include '../function/dbconnect.php';
                    include_once '../model/deal_data.php';
                    $deal = new Deal("", "", "", "", "");
                    $result3 = $deal->showEnableDeals($conn);
                    $unitprice = $result2["pro_unitprice"];
                    $discount = null;
                    if ($result3->num_rows > 0) {
                        while ($row2 = $result3->fetch_assoc()) {
                            if ($row2["pro_id"] == $result2["pro_id"]) {
                                $discount = number_format($unitprice - $unitprice * floatval($row2["deal_discount"]), 2, '.', '');
                            }
                        }
                    }
                    $price;
                    if ($discount != null) {
                        $price = doubleval($discount);
                    } else {
                        $price = $unitprice;
                    }
                    $_SESSION["cart"][$result2["pro_id"]] = array("name" => $result2["pro_name"], "quantity" => $row1["cart_quantity"], "price" => $price, "imageURL" => $result2["pro_imageURL"]);
                } else {
                    $message = "This product id is invalid";
                }
            }
        }
        // Get wishlist item from database
        include '../function/dbconnect.php';
        include_once '../model/cart_data.php';
        $cart1 = new Cart($cus_id, "", "", "wishlist");
        $result3 = $cart1->getWishlistByCusID($conn);
        if ($result3->num_rows > 0) {
            while ($row2 = $result3->fetch_assoc()) {
                include '../function/dbconnect.php';
                $stmt = $conn->prepare("SELECT pro_id, pro_name, pro_unitprice, pro_imageURL FROM product WHERE pro_id = ?");
                $stmt->bind_param("i", $row2["pro_id"]);
                $stmt->execute();
                $result4 = $stmt->get_result()->fetch_assoc();
                if (isset($result4["pro_id"]) && $result4["pro_id"]) {
                    include '../function/dbconnect.php';
                    include_once '../model/deal_data.php';
                    $deal1 = new Deal("", "", "", "", "");
                    $result5 = $deal1->showEnableDeals($conn);
                    $unitprice1 = $result4["pro_unitprice"];
                    $discount1 = null;
                    if ($result5->num_rows > 0) {
                        while ($row3 = $result5->fetch_assoc()) {
                            if ($row3["pro_id"] == $result4["pro_id"]) {
                                $discount1 = number_format($unitprice1 - $unitprice1 * floatval($row3["deal_discount"]), 2, '.', '');
                            }
                        }
                    }
                    $price1;
                    if ($discount1 != null) {
                        $price1 = doubleval($discount1);
                    } else {
                        $price1 = $unitprice1;
                    }
                    $_SESSION["wishlist"][$result4["pro_id"]] = array("name" => $result4["pro_name"], "price" => $price1, "imageURL" => $result4["pro_imageURL"]);
                } else {
                    $message = "This product id is invalid";
                }
            }
        }
        echo 'Success';
        exit();
    } else {
        if (isset($_GET["check"]) && $_GET["check"] == "checked") {
            setcookie('member_login', '');
            setcookie('member_pwd', '');
        }
        echo 'Fail';
        exit();
    }
}
?>