<?php

include '../../function/dbconnect.php';
include_once '../../model/deal_data.php';

if (isset($_POST['action']) && $_POST['action'] == "create") {
    $dealStart = DateTime::createFromFormat("m/d/Y", $_POST['start'])->format('Y-m-d');
    $dealEnd = DateTime::createFromFormat("m/d/Y", $_POST['end'])->format('Y-m-d');
    $proID = $_POST['dealProID'];
    $discount = $_POST['dealDiscount'];
    $insert = true;
    //Check proID

    if ($dealStart >= $dealEnd) {
        echo "FalseDate";
        exit();
    } else {
        $deal = new Deal("", "", "", "", "");
        $result = $deal->showAllDeals($conn);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['pro_id'] == $proID) {
                    $insert = false;
                    include '../../function/dbconnect.php';
                    $deal1 = new Deal("", $proID, $dealStart, $dealEnd, $discount);
                    $result = $deal1->deleteDeal($conn);
                    include '../../function/dbconnect.php';
                    if ($deal1->insertDeal($conn) == true) {
                        echo 'Success';
                        exit();
                    } else {
                        echo 'Fail';
                        exit();
                    }
                } else {
                    continue;
                }
            }
        }
        if ($insert == true) {
            include '../../function/dbconnect.php';
            $deal1 = new Deal("", $proID, $dealStart, $dealEnd, $discount);
            if ($deal1->insertDeal($conn) == true) {
                echo 'Success';
                exit();
            } else {
                echo 'Fail';
                exit();
            }
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == "save") {
    $id = $_GET['id'];
    $startDeal = $_GET['startDeal'];
    $endDeal = $_GET['endDeal'];
    $discount = $_GET['discount'];

    if ($startDeal > $endDeal) {
        echo "FalseDate";
        exit();
    } else {
        $deal = new Deal("", $id, $startDeal, $endDeal, $discount);
        if ($deal->updateDeal($conn) == true) {
            echo 'Success';
            exit();
        } else {
            echo 'Fail';
            exit();
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == "remove") {
    $id = $_GET['id'];
    $deal = new Deal("", $id, "", "", "");
    if ($deal->deleteDeal($conn) == false) {
        echo 'Fail';
        exit();
    } else {
        echo 'Success';
        exit();
    }
}