<?php

class Status {

    private $statusID;
    private $statusDescription;
    
    public function __construct($statusID, $statusDescription) {
        $this->statusID = $statusID;
        $this->statusDescription = $statusDescription;
    }

    public function getStatusID() {
        return $this->statusID;
    }

    public function getStatusDescription() {
        return $this->statusDescription;
    }

    public function setStatusID($statusID): void {
        $this->statusID = $statusID;
    }

    public function setStatusDescription($statusDescription): void {
        $this->statusDescription = $statusDescription;
    }

    public function showAllStatus($conn) {
        $sql = "SELECT * FROM orderstatus";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}
