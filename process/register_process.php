<?php 
include '../function/dbconnect.php';
include '../model/customer_data.php';

if (isset($_POST["name"])) {
    $customerName = $_POST["name"];
    $customerGender = $_POST["gender"];
    $customerPhone = $_POST["phone"];
    $customerEmail = $_POST["email"];
    $customerPassword = $_POST["pass"];
    $customer = new Customer("", $customerName, $customerGender, $customerPhone, $customerEmail, $customerPassword, "");
    $customerID = $customer->getCustomerElement($conn) + 1;
    $customer->setCustomerID($customerID);
    include '../function/dbconnect.php';
    $result = $customer->checkCustomerEmail($conn);
    if ($result->num_rows == 0) {
        include '../function/dbconnect.php';
        $customer = new Customer("", $customerName, $customerGender, $customerPhone, $customerEmail, $customerPassword, "");
        $result1 = $customer->insertCustomer($conn);
        if ($result1 == true) {
            echo 'Success';
            exit();
        } else {
            echo $customerEmail;
            echo 'Registration failed!';
            exit();
        }
    } else {
        echo 'This email address is already registered to another account';
        exit();
    }
}
?>