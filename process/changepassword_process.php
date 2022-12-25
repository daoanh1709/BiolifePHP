<?php
session_start();
include '../function/dbconnect.php';
include_once '../model/customer_data.php';
if (isset($_POST["cur_pass"])) {
    $cur_pass = $_POST["cur_pass"];
    $new_pass = $_POST["new_pass"];
    $cus_id = $_SESSION["cus_id"];
    $customer = new Customer($cus_id, "", "", "", "", "", "");
    $result = $customer->searchCustomer($conn);
    $row = $result->fetch_assoc();
    $cus_pass = $row["cus_password"];
    $cus_email = $row["cus_email"];
    if ($cus_pass == sha1($cur_pass)) {
        include '../function/dbconnect.php';
        $customer = new Customer("", "", "", "", $cus_email, $new_pass, "");
        if ($customer->updateCustomerPassword($conn) == true) {
            echo 'Password has been change successfully';
        } else {
            echo 'Wow, there is a mistake';
        }
    } else {
        echo 'Incorrect current password';
    }
}
?>