<?php

session_start();
include '../function/dbconnect.php';
include_once '../model/customer_data.php';
if (isset($_POST["info_name"])) {
    $name = $_POST["info_name"];
    $email = $_POST["info_email"];
    $phone = $_POST["info_phone"];
    $gender = $_POST["optradio"];
    $cus_id = $_SESSION["cus_id"];
    $image;
    if ($_FILES['imagefile']['tmp_name'] != "") {
        if (getimagesize($_FILES['imagefile']['tmp_name']) == false) {
            echo "<br>Please Select An Image.";
        } else {
            $image = addslashes(file_get_contents($_FILES['imagefile']['tmp_name']));
            $sql = "UPDATE customer SET cus_imageURL = '$image' WHERE cus_id = '$cus_id'";
            $conn->query($sql);
        }
    }
    include '../function/dbconnect.php';
    $cus_id = $_SESSION["cus_id"];
    $customer = new Customer($cus_id, "", "", "", "", "", "");
    $result = $customer->searchCustomer($conn);
    $row = $result->fetch_assoc();
    $cus_email = $row["cus_email"];
    if ($cus_email != $email) {
        $customer1 = new Customer($cus_id, $name, $gender, $phone, $email, "", "");
        include '../function/dbconnect.php';
        $result1 = $customer1->checkCustomerEmail($conn);
        if ($result1->num_rows == 0) {
            include '../function/dbconnect.php';
            if ($customer1->updateCustomer($conn) == true) {
                $_SESSION["user_name"] = $name;
                $url = $_SERVER['HTTP_REFERER'];
                echo 'Information has been update successfully';
                exit();
            } else {
                echo 'Wow, there is a mistake';
                exit();
            }
        } else {
            echo 'This email address is already registered to another account';
            exit();
        }
    } else {
        include '../function/dbconnect.php';
        $customer1 = new Customer($cus_id, $name, $gender, $phone, $email, "", "");
        if ($customer1->updateCustomer($conn) == true) {
            $_SESSION["user_name"] = $name;
            $url = $_SERVER['HTTP_REFERER'];
            echo 'Information has been update successfully';
            exit();
        } else {
            echo 'Wow, there is a mistake';
            exit();
        }
    }
}
?>