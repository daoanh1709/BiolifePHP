<?php

class Cart {

    private $customerID;
    private $productID;
    private $cartQuantity;
    private $type;

    public function __construct($customerID, $productID, $cartQuantity, $type) {
        $this->customerID = $customerID;
        $this->productID = $productID;
        $this->cartQuantity = $cartQuantity;
        $this->type = $type;
    }

    public function getCustomerID() {
        return $this->customerID;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function getCartQuantity() {
        return $this->cartQuantity;
    }

    public function setCustomerID($customerID): void {
        $this->customerID = $customerID;
    }

    public function setProductID($productID): void {
        $this->productID = $productID;
    }

    public function setCartQuantity($cartQuantity): void {
        $this->cartQuantity = $cartQuantity;
    }
    
    public function getType() {
        return $this->type;
    }

    public function setType($type): void {
        $this->type = $type;
    }

    public function insertCart($conn) {
        $sql = "INSERT INTO cart(cus_id, pro_id, cart_quantity, type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $this->customerID, $this->productID, $this->cartQuantity, $this->type);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function getCartByCusID($conn) {
        $sql = "SELECT cus_id, pro_id, cart_quantity, type FROM cart WHERE cus_id = '" . $this->customerID . "' AND type = '" . $this->type . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function deleteCartByCusID($conn) {
        $sql = "DELETE FROM cart WHERE cus_id = '" . $this->customerID . "' AND type = '" . $this->type . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function insertWishlist($conn) {
        $sql = "INSERT INTO cart(cus_id, pro_id, cart_quantity, type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $this->customerID, $this->productID, $this->cartQuantity, $this->type);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function getWishlistByCusID($conn) {
        $sql = "SELECT cus_id, pro_id, cart_quantity, type FROM cart WHERE cus_id = '" . $this->customerID . "' AND type = '" . $this->type . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function deleteWishlistByCusID($conn) {
        $sql = "DELETE FROM cart WHERE cus_id = '" . $this->customerID . "' AND type = '" . $this->type . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}
