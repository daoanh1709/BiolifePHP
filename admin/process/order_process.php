<?php

include_once '../../model/order_data.php';
if (isset($_POST['action']) && $_POST['action'] == "update") {
    include '../../function/dbconnect.php';
    $orderID = $_POST["orderID"];
    $order = new Order($orderID, "", "", "", "", "", "");
    $result = $order->searchOrderByID($conn);
    $row = $result->fetch_assoc();
    $staIDOld = $row["sta_id"];
    $staIDNew = $_POST["orderStatus"];
    $orderID = $_POST["orderID"];
    if ($staIDOld == 0) {
        if ($staIDNew == 1 || $staIDNew == 4 || $staIDNew == 0) {
            include '../../function/dbconnect.php';
            $order1 = new Order($orderID, "", "", "", "", $staIDNew, "");
            if ($order1->updateOrderStatus($conn) == true) {
                echo 'Success';
                exit();
            } else {
                echo 'Fail';
                exit();
            }
        } else if ($staIDNew == 2) {
            echo 'unconfirmedtodelivering';
            exit();
        } else if ($staIDNew == 3) {
            echo 'unconfirmedtodelivered';
            exit();
        }
    } else if ($staIDOld == 1) {
        if ($staIDNew == 2 || $staIDNew == 4 || $staIDNew == 1) {
            include '../../function/dbconnect.php';
            $order1 = new Order($orderID, "", "", "", "", $staIDNew, "");
            if ($order1->updateOrderStatus($conn) == true) {
                echo 'Success';
                exit();
            } else {
                echo 'Fail';
                exit();
            }
        } else if ($staIDNew == 0) {
            echo 'confirmedtounconfirmed';
            exit();
        } else if ($staIDNew == 3) {
            echo 'confirmedtodelivered';
            exit();
        }
    } else if ($staIDOld == 2) {
        echo 'cannot';
        exit();
//        if ($staIDNew == 3 || $staIDNew == 4 || $staIDNew == 2) {
//            include '../../function/dbconnect.php';
//            $order1 = new Order($orderID, "", "", "", "", $staIDNew, "");
//            if ($order1->updateOrderStatus($conn) == true) {
//                echo 'Success';
//                exit();
//            } else {
//                echo 'Fail';
//                exit();
//            }
//        } else if ($staIDNew == 0) {
//            echo 'deliveringtounconfirmed';
//            exit();
//        } else if ($staIDNew == 1) {
//            echo 'deliveringtoconfirmed';
//            exit();
//        }
    } else if ($staIDOld == 3) {
        echo 'cannot';
        exit();
    } else if ($staIDOld == 4) {
        echo 'cannot';
        exit();
    }
}