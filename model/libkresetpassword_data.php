<?php

class LinkReset {

    private $customerEmail;
    private $token;
    private $expireDate;

    public function __construct($customerEmail, $token, $expireDate) {
        $this->customerEmail = $customerEmail;
        $this->token = $token;
        $this->expireDate = $expireDate;
    }

    public function getCustomerEmail() {
        return $this->customerEmail;
    }

    public function getToken() {
        return $this->token;
    }

    public function getExpireDate() {
        return $this->expireDate;
    }

    public function setCustomerEmail($customerEmail): void {
        $this->customerEmail = $customerEmail;
    }

    public function setToken($token): void {
        $this->token = $token;
    }

    public function setExpireDate($expireDate): void {
        $this->expireDate = $expireDate;
    }

    public function searchEmail($conn) {
        $sql = "SELECT * FROM linkresetpassword WHERE cus_email='" . $this->customerEmail . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function insertEmail($conn) {
        $sql = "INSERT INTO linkresetpassword(cus_email) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $this->customerEmail);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function updateLinkReret($conn) {
        $sql = "UPDATE linkresetpassword SET reset_link_token = '" . $this->token . "' ,exp_date = '" . $this->expireDate . "' WHERE cus_email = '" . $this->customerEmail . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function checkEmailandToken($conn) {
        $sql = "SELECT * FROM linkresetpassword WHERE reset_link_token = '" . $this->token . "' and cus_email = '" . $this->customerEmail . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function clearLink($conn) {
        $sql = "UPDATE linkresetpassword SET reset_link_token = '" . NULL . "' ,exp_date = '" . NULL . "' WHERE cus_email = '" . $this->customerEmail . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

}
