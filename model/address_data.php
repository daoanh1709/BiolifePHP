<?php

class Address {

    private $addressID;
    private $customerID;
    private $addressName;
    private $addressPhone;
    private $addressCity;
    private $addressDetail;
    private $addressStatus;

    public function __construct($addressID, $customerID, $addressName, $addressPhone, $addressCity, $addressDetail, $addressStatus) {
        $this->addressID = $addressID;
        $this->customerID = $customerID;
        $this->addressName = $addressName;
        $this->addressPhone = $addressPhone;
        $this->addressCity = $addressCity;
        $this->addressDetail = $addressDetail;
        $this->addressStatus = $addressStatus;
    }

    public function getAddressID() {
        return $this->addressID;
    }

    public function getCustomerID() {
        return $this->customerID;
    }

    public function getAddressName() {
        return $this->addressName;
    }

    public function getAddressPhone() {
        return $this->addressPhone;
    }

    public function getAddressCity() {
        return $this->addressCity;
    }

    public function getAddressDetail() {
        return $this->addressDetail;
    }

    public function setAddressID($addressID): void {
        $this->addressID = $addressID;
    }

    public function setCustomerID($customerID): void {
        $this->customerID = $customerID;
    }

    public function setAddressName($addressName): void {
        $this->addressName = $addressName;
    }

    public function setAddressPhone($addressPhone): void {
        $this->addressPhone = $addressPhone;
    }

    public function setAddressCity($addressCity): void {
        $this->addressCity = $addressCity;
    }

    public function setAddressDetail($addressDetail): void {
        $this->addressDetail = $addressDetail;
    }
    
    public function getAddressStatus() {
        return $this->addressStatus;
    }

    public function setAddressStatus($addressStatus): void {
        $this->addressStatus = $addressStatus;
    }

    
    public function showAdressByCustomer($conn) {
        $sql = "SELECT add_id, cus_id, add_name, add_phone, add_city, add_detail, add_status FROM deliveryaddress WHERE cus_id = '" . $this->customerID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function insertAddress($conn) {
        $sql = "INSERT INTO deliveryaddress(add_id, cus_id, add_name, add_phone, add_city, add_detail) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissss", $this->addressID, $this->customerID, $this->addressName, $this->addressPhone, $this->addressCity, $this->addressDetail);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function getAddressElement($conn) {
        $sql = "SELECT COUNT(*) AS element FROM deliveryaddress";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row["element"];
    }
    
    public function updateAddress($conn) {
        $sql = "UPDATE deliveryaddress SET add_name = ?, add_phone = ?, add_city = ?, add_detail = ?  WHERE add_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $this->addressName, $this->addressPhone, $this->addressCity, $this->addressDetail, $this->addressID);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function deleteAddress($conn) {
        $sql = "UPDATE deliveryaddress SET add_status = " . 0 . " WHERE add_id = '" . $this->addressID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function searchAdressByID($conn) {
        $sql = "SELECT add_id, cus_id, add_name, add_phone, add_city, add_detail, add_status FROM deliveryaddress WHERE cus_id = '" . $this->customerID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}