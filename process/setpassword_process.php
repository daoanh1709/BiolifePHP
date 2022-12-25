<?php

include '../function/dbconnect.php';
include_once '../model/customer_data.php';
include_once '../model/libkresetpassword_data.php';

if (isset($_POST["spass"])) {
    $customerPassword = $_POST["spass"];
    $customerEmail = $_POST['email'];
    $token = $_POST['reset_link_token'];
    $customer = new Customer("", "", "", "", $customerEmail, $customerPassword, "");
    $linkResetPass = new LinkReset($customerEmail, $token, "");
    $result = $linkResetPass->checkEmailandToken($conn);
    if ($result->num_rows > 0) {
        include '../function/dbconnect.php';
        $resutlUpdateLink = $linkResetPass->clearLink($conn);
        include '../function/dbconnect.php';
        if ($customer->updateCustomerPassword($conn) == true) {
            echo 'Success';
            exit();
        } else {
            echo 'Fail';
            exit();
        }
    }
}
?>