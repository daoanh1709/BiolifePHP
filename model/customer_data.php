<?php

class Customer {

    private $customerID;
    private $customerName;
    private $customerGender;
    private $customerPhone;
    private $customerEmail;
    private $customerPassword;
    private $customerImageURL;


    public function __construct($customerID, $customerName, $customerGender, $customerPhone, $customerEmail, $customerPassword, $customerImageURL) {
        $this->customerID = $customerID;
        $this->customerName = $customerName;
        $this->customerGender = $customerGender;
        $this->customerPhone = $customerPhone;
        $this->customerEmail = $customerEmail;
        $this->customerPassword = $customerPassword;
        $this->customerImageURL = $customerImageURL;
    }

    public function getCustomerID() {
        return $this->customerID;
    }

    public function getCustomerName() {
        return $this->customerName;
    }

    public function getCustomerGender() {
        return $this->customerGender;
    }

    public function getCustomerPhone() {
        return $this->customerPhone;
    }

    public function getCustomerEmail() {
        return $this->customerEmail;
    }

    public function getCustomerPassword() {
        return $this->customerPassword;
    }

    public function setCustomerID($customerID): void {
        $this->customerID = $customerID;
    }

    public function setCustomerName($customerName): void {
        $this->customerName = $customerName;
    }

    public function setCustomerGender($customerGender): void {
        $this->customerGender = $customerGender;
    }

    public function setCustomerPhone($customerPhone): void {
        $this->customerPhone = $customerPhone;
    }

    public function setCustomerEmail($customerEmail): void {
        $this->customerEmail = $customerEmail;
    }

    public function setCustomerPassword($customerPassword): void {
        $this->customerPassword = $customerPassword;
    }
    
    public function getCustomerImageURL() {
        return $this->customerImageURL;
    }

    public function setCustomerImageURL($customerImageURL): void {
        $this->customerImageURL = $customerImageURL;
    }

    public function showAllCustomer($conn) {
        $sql = "SELECT cus_id, cus_name, cus_gender, cus_phone, cus_email, cus_password, cus_imageURL FROM customer";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function insertCustomer($conn) {
        $sql = "INSERT INTO customer(cus_id, cus_name, cus_gender, cus_phone, cus_email, cus_password, cus_imageURL) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $password = sha1($this->customerPassword);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", $this->customerID, $this->customerName, $this->customerGender, $this->customerPhone, $this->customerEmail, $password, $this->customerImageURL);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function getCustomerElement($conn) {
        $sql = "SELECT COUNT(*) AS element FROM customer";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row["element"];
    }
    
    public function checkCustomerEmail($conn) {
        $sql = "SELECT cus_id, cus_name, cus_gender, cus_phone, cus_email, cus_password, cus_imageURL FROM customer WHERE cus_email = '". $this->customerEmail . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function updateCustomerPassword($conn) {
        $sql = "UPDATE customer SET cus_password = ? WHERE cus_email = ?";
        $stmt = $conn->prepare($sql);
        $password = sha1($this->customerPassword);
        $stmt->bind_param("ss", $password, $this->customerEmail);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function updateCustomer($conn) {
        $sql = "UPDATE customer SET cus_name = ?, cus_gender = ?, cus_phone = ?, cus_email = ? WHERE cus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $this->customerName, $this->customerGender, $this->customerPhone, $this->customerEmail, $this->customerID);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function searchCustomer($conn) {
        $sql = "SELECT cus_id, cus_name, cus_gender, cus_phone, cus_email, cus_password, cus_imageURL FROM customer WHERE cus_id = '". $this->customerID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function loginCheck($conn) {
        $password = sha1($this->customerPassword);
        $sql = "SELECT cus_id, cus_name, cus_gender, cus_phone, cus_email, cus_password FROM customer WHERE cus_email = '" . $this->customerEmail . "' AND cus_password = '$password'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}
