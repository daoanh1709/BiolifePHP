<?php

class Deal {

    private $dealID;
    private $productID;
    private $dealStart;
    private $dealEnd;
    private $dealDiscount;

    public function __construct($dealID, $productID, $dealStart, $dealEnd, $dealDiscount) {
        $this->dealID = $dealID;
        $this->productID = $productID;
        $this->dealStart = $dealStart;
        $this->dealEnd = $dealEnd;
        $this->dealDiscount = $dealDiscount;
    }

    public function getDealID() {
        return $this->dealID;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function getDealStart() {
        return $this->dealStart;
    }

    public function getDealEnd() {
        return $this->dealEnd;
    }

    public function getDealDiscount() {
        return $this->dealDiscount;
    }

    public function setDealID($dealID): void {
        $this->dealID = $dealID;
    }

    public function setProductID($productID): void {
        $this->productID = $productID;
    }

    public function setDealStart($dealStart): void {
        $this->dealStart = $dealStart;
    }

    public function setDealEnd($dealEnd): void {
        $this->dealEnd = $dealEnd;
    }

    public function setDealDiscount($dealDiscount): void {
        $this->dealDiscount = $dealDiscount;
    }

    public function showAllDeals($conn) {
        $sql = "SELECT deal_id, pro_id , deal_start, deal_end, deal_discount FROM deal";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function showEnableDeals($conn) {
        $sql = "SELECT deal_id, pro_id , deal_start, deal_end, deal_discount FROM deal WHERE deal_start <= CURRENT_DATE() AND deal_end > CURRENT_DATE()";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function insertDeal($conn) {
        $sql = "INSERT INTO deal(pro_id, deal_start, deal_end, deal_discount) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issd", $this->productID, $this->dealStart, $this->dealEnd, $this->dealDiscount);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function updateDeal($conn) {
        $sql = "UPDATE deal SET deal_start = ?, deal_end = ?, deal_discount = ? WHERE pro_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $this->dealStart, $this->dealEnd, $this->dealDiscount, $this->productID);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function deleteDeal($conn) {
        $sql = "DELETE FROM deal WHERE pro_id = '" . $this->productID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}
