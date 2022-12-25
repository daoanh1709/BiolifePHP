<?php

class Image {

    private $imgID;
    private $productID;
    private $imgURL;

    public function __construct($imgID, $productID, $imgURL) {
        $this->imgID = $imgID;
        $this->productID = $productID;
        $this->imgURL = $imgURL;
    }

    public function getImgID() {
        return $this->imgID;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function getImgURL() {
        return $this->imgURL;
    }

    public function setImgID($imgID): void {
        $this->imgID = $imgID;
    }

    public function setProductID($productID): void {
        $this->productID = $productID;
    }

    public function setImgURL($imgURL): void {
        $this->imgURL = $imgURL;
    }

    public function showAllImage($conn) {
        $sql = "SELECT img_id, pro_id , img_URL FROM productimage";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function showImageByProductID($conn) {
        $sql = "SELECT img_id, pro_id, img_URL FROM productimage WHERE pro_id = '" . $this->productID . "'";;
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}
