<?php

session_start();

// Delete cart database
include './function/dbconnect.php';
include_once './model/cart_data.php';
$cart1 = new Cart($_SESSION["cus_id"], "", "", "cart");
$result1 = $cart1->deleteCartByCusID($conn);

// Save cart
if (isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $item => $value) {
        include './function/dbconnect.php';
        include_once './model/cart_data.php';
        $cart = new Cart($_SESSION["cus_id"], $item, $value["quantity"], "cart");
        $result = $cart->insertCart($conn);
    }
}

// Delete wishlist database
include './function/dbconnect.php';
include_once './model/cart_data.php';
$cart1 = new Cart($_SESSION["cus_id"], "", "", "wishlist");
$result1 = $cart1->deleteCartByCusID($conn);

// Save cart
if (isset($_SESSION["wishlist"])) {
    foreach ($_SESSION["wishlist"] as $item => $value) {
        include './function/dbconnect.php';
        include_once './model/cart_data.php';
        $cart = new Cart($_SESSION["cus_id"], $item, 1, "wishlist");
        $result = $cart->insertCart($conn);
    }
}

// If you want to destroy only users login session
unset($_SESSION['user_name']);
unset($_SESSION["cus_id"]);
unset($_SESSION["cart"]);
unset($_SESSION["wishlist"]);
header("location:index.php?page=home");

