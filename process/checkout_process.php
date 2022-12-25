<?php

session_start();
include '../function/dbconnect.php';
include_once '../model/order_data.php';
include_once '../model/orderdetails_data.php';

if (isset($_GET["action"]) && $_GET["action"] == "order") {
    $addID = $_GET["addid"];
    $payment = $_GET["payment"];
    $note = $_GET["note"];
    $date = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
    $order = new Order("", $_SESSION["cus_id"], $addID, $date->format('Y-m-d H:i:s'), $payment, 0, $note);
    if ($order->insertOrder($conn) == true) {
        include '../function/dbconnect.php';
        $result = $order->getNewOrderIdOfCustomer($conn);
        $row = $result->fetch_assoc();
        $orderID = $row["ord_id"];
        foreach ($_SESSION["cart"] as $x => $value) {
            include '../function/dbconnect.php';
            $orderDetail = new OrderDetails($orderID, $x, $value["price"], $value["quantity"]);
            $orderDetail->insertOrderDetails($conn);
        }
        unset($_SESSION["cart"]);
        echo $orderID;
        exit();
    } else {
        echo 'Fail';
        exit();
    }
}