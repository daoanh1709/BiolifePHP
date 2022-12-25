<?php

class Order {

    private $orderID;
    private $customerID;
    private $addressID;
    private $orderDate;
    private $orderPayment;
    private $statusID;
    private $orderNote;

    public function __construct($orderID, $customerID, $addressID, $orderDate, $orderPayment, $statusID, $orderNote) {
        $this->orderID = $orderID;
        $this->customerID = $customerID;
        $this->addressID = $addressID;
        $this->orderDate = $orderDate;
        $this->orderPayment = $orderPayment;
        $this->statusID = $statusID;
        $this->orderNote = $orderNote;
    }

    public function getOrderID() {
        return $this->orderID;
    }

    public function getCustomerID() {
        return $this->customerID;
    }

    public function getAddressID() {
        return $this->addressID;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }

    public function getOrderPayment() {
        return $this->orderPayment;
    }

    public function getStatusID() {
        return $this->statusID;
    }

    public function getOrderNote() {
        return $this->orderNote;
    }

    public function setOrderID($orderID): void {
        $this->orderID = $orderID;
    }

    public function setCustomerID($customerID): void {
        $this->customerID = $customerID;
    }

    public function setAddressID($addressID): void {
        $this->addressID = $addressID;
    }

    public function setOrderDate($orderDate): void {
        $this->orderDate = $orderDate;
    }

    public function setOrderPayment($orderPayment): void {
        $this->orderPayment = $orderPayment;
    }

    public function setStatusID($statusID): void {
        $this->statusID = $statusID;
    }

    public function setOrderNote($orderNote): void {
        $this->orderNote = $orderNote;
    }

    public function insertOrder($conn) {
        $sql = "INSERT INTO orders(cus_id, add_id, ord_date, ord_payment, sta_id, ord_note) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissis", $this->customerID, $this->addressID, $this->orderDate, $this->orderPayment, $this->statusID, $this->orderNote);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }

    public function getNewOrderIdOfCustomer($conn) {
        $sql = "SELECT ord_id FROM orders WHERE cus_id = '" . $this->customerID . "' ORDER BY ord_id DESC LIMIT 1 ";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function getOrderOfCustomer($conn) {
        $sql = "SELECT ord_id, cus_id, add_id, ord_date, ord_payment, orders.sta_id, ord_note, sta_description FROM orders JOIN orderstatus ON orders.sta_id = orderstatus.sta_id WHERE cus_id = '" . $this->customerID . "' ORDER BY ord_id DESC";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function getOrderOfCustomerWithStatus($conn) {
        $sql = "SELECT ord_id, cus_id, add_id, ord_date, ord_payment, orders.sta_id, ord_note, sta_description FROM orders JOIN orderstatus ON orders.sta_id = orderstatus.sta_id WHERE cus_id = '" . $this->customerID . "' AND orders.sta_id = '" . $this->statusID . "' ORDER BY ord_id DESC";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function searchOrderByID($conn) {
        $sql = "SELECT ord_id, cus_id, add_id, ord_date, ord_payment, sta_id, ord_note FROM orders WHERE ord_id = '" . $this->orderID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function cancelOrder($conn) {
        $sql = "UPDATE orders SET sta_id = " . 4 . " WHERE ord_id = '" . $this->orderID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function receiveOrder($conn) {
        $sql = "UPDATE orders SET sta_id = " . 3 . " WHERE ord_id = '" . $this->orderID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function searchAddressOfOrder($conn) {
        $sql = "SELECT ord_id, orders.add_id, add_name, add_phone, add_detail FROM orders JOIN deliveryaddress ON orders.add_id = deliveryaddress.add_id WHERE ord_id = '" . $this->orderID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function showAllOrders($conn) {
        $sql = "SELECT * FROM orders JOIN orderstatus ON orders.sta_id = orderstatus.sta_id ORDER BY ord_id DESC";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function getStatusDescription($conn) {
        $sql = "SELECT orders.sta_id, sta_description FROM orders JOIN orderstatus ON orders.sta_id = orderstatus.sta_id";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    function updateOrderStatus($conn) {
        $sql = "UPDATE orders SET sta_id = '" . $this->statusID . "' WHERE ord_id = '" . $this->orderID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    function getTodayOrders($conn) {
        $sql = "SELECT * FROM orders WHERE DATE(ord_date) = CURRENT_DATE()";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    function getMonthOrders($conn, $month) {
        $sql = "SELECT * FROM orders WHERE MONTH(DATE(ord_date)) = $month";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

}
