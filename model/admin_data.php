<?php

class Admin {

    private $adminID;
    private $adminName;
    private $adminGender;
    private $adminAddress;
    private $adminPhone;
    private $adminEmail;
    private $adminPassword;
    private $adminActive;
    private $adminImage;

    public function __construct($adminID, $adminName, $adminGender, $adminAddress, $adminPhone, $adminEmail, $adminPassword, $adminActive, $adminImage) {
        $this->adminID = $adminID;
        $this->adminName = $adminName;
        $this->adminGender = $adminGender;
        $this->adminAddress = $adminAddress;
        $this->adminPhone = $adminPhone;
        $this->adminEmail = $adminEmail;
        $this->adminPassword = $adminPassword;
        $this->adminActive = $adminActive;
        $this->adminImage = $adminImage;
    }

    public function getAdminID() {
        return $this->adminID;
    }

    public function getAdminName() {
        return $this->adminName;
    }

    public function getAdminGender() {
        return $this->adminGender;
    }

    public function getAdminAddress() {
        return $this->adminAddress;
    }

    public function getAdminPhone() {
        return $this->adminPhone;
    }

    public function getAdminEmail() {
        return $this->adminEmail;
    }

    public function getAdminPassword() {
        return $this->adminPassword;
    }

    public function getAdminActive() {
        return $this->adminActive;
    }

    public function getAdminImage() {
        return $this->adminImage;
    }

    public function setAdminID($adminID): void {
        $this->adminID = $adminID;
    }

    public function setAdminName($adminName): void {
        $this->adminName = $adminName;
    }

    public function setAdminGender($adminGender): void {
        $this->adminGender = $adminGender;
    }

    public function setAdminAddress($adminAddress): void {
        $this->adminAddress = $adminAddress;
    }

    public function setAdminPhone($adminPhone): void {
        $this->adminPhone = $adminPhone;
    }

    public function setAdminEmail($adminEmail): void {
        $this->adminEmail = $adminEmail;
    }

    public function setAdminPassword($adminPassword): void {
        $this->adminPassword = $adminPassword;
    }

    public function setAdminActive($adminActive): void {
        $this->adminActive = $adminActive;
    }

    public function setAdminImage($adminImage): void {
        $this->adminImage = $adminImage;
    }

    public function checkSignIn($conn) {
        $password = sha1($this->adminPassword);
        $sql = "SELECT ad_id, ad_name, ad_gender, ad_address, ad_phone, ad_email, ad_password, ad_active, ad_image FROM admin WHERE ad_email = '" . $this->adminEmail . "' AND ad_password = '$password' AND ad_active = 1";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function searchAdmin($conn) {
        $sql = "SELECT ad_id, ad_name, ad_gender, ad_address, ad_phone, ad_email, ad_password, ad_active, ad_image FROM admin WHERE ad_id = '" . $this->adminID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    function updateAdmin($conn) {
        $sql = "UPDATE admin SET ad_name = ?, ad_email = ? WHERE ad_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $this->adminName, $this->adminEmail, $this->adminID);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }

    public function checkAdminEmail($conn) {
        $sql = "SELECT ad_id, ad_name, ad_gender, ad_address, ad_phone, ad_email, ad_password, ad_active, ad_image FROM admin WHERE ad_email = '". $this->adminEmail . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function updateAdminPassword($conn) {
        $sql = "UPDATE admin SET ad_password = ? WHERE ad_email = ?";
        $stmt = $conn->prepare($sql);
        $password = sha1($this->adminPassword);
        $stmt->bind_param("ss", $password, $this->adminEmail);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
}
