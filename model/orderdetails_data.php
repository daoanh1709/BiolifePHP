<?php

class OrderDetails {

    private $orderID;
    private $productID;
    private $unitPrice;
    private $quantity;
    
    public function __construct($orderID, $productID, $unitPrice, $quantity) {
        $this->orderID = $orderID;
        $this->productID = $productID;
        $this->unitPrice = $unitPrice;
        $this->quantity = $quantity;
    }

    public function getOrderID() {
        return $this->orderID;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function getUnitPrice() {
        return $this->unitPrice;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setOrderID($orderID): void {
        $this->orderID = $orderID;
    }

    public function setProductID($productID): void {
        $this->productID = $productID;
    }

    public function setUnitPrice($unitPrice): void {
        $this->unitPrice = $unitPrice;
    }

    public function setQuantity($quantity): void {
        $this->quantity = $quantity;
    }

    public function insertOrderDetails($conn) {
        $sql = "INSERT INTO orderdetails(ord_id, pro_id, unitprice, quantity) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iidi", $this->orderID, $this->productID, $this->unitPrice, $this->quantity);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function searchOrderDetailsByID($conn) {
        $sql = "SELECT ord_id, pro_id, unitprice, quantity FROM orderdetails WHERE ord_id = '" . $this->orderID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    public function getTop5BestSeller($conn) {
        $sql = "SELECT pro_id, SUM(unitprice * quantity) AS total FROM orderdetails GROUP BY pro_id ORDER BY SUM(unitprice * quantity) DESC LIMIT 5";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function getTop10BestSeller($conn) {
        $sql = "SELECT pro_id, SUM(unitprice * quantity) AS total FROM orderdetails GROUP BY pro_id ORDER BY SUM(unitprice * quantity) DESC LIMIT 10";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}
