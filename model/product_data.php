<?php

class Product {

    private $productID;
    private $productName;
    private $productImageURL;
    private $categoryID;
    private $productUnitPrice;
    private $productUnitInStock;
    private $productDetails;
    private $productFeatured;
    private $productDiscontinued;

    public function __construct($productID, $productName, $productImageURL, $categoryID, $productUnitPrice, $productUnitInStock, $productDetails, $productFeatured, $productDiscontinued) {
        $this->productID = $productID;
        $this->productName = $productName;
        $this->productImageURL = $productImageURL;
        $this->categoryID = $categoryID;
        $this->productUnitPrice = $productUnitPrice;
        $this->productUnitInStock = $productUnitInStock;
        $this->productDetails = $productDetails;
        $this->productFeatured = $productFeatured;
        $this->productDiscontinued = $productDiscontinued;
    }

    public function getProductID() {
        return $this->productID;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function getProductImageURL() {
        return $this->productImageURL;
    }

    public function getCategoryID() {
        return $this->categoryID;
    }

    public function getProductUnitPrice() {
        return $this->productUnitPrice;
    }

    public function getProductUnitInStock() {
        return $this->productUnitInStock;
    }

    public function getProductDetails() {
        return $this->productDetails;
    }

    public function getProductFeatured() {
        return $this->productFeatured;
    }

    public function getProductDiscontinued() {
        return $this->productDiscontinued;
    }

    public function setProductID($productID): void {
        $this->productID = $productID;
    }

    public function setProductName($productName): void {
        $this->productName = $productName;
    }

    public function setProductImageURL($productImageURL): void {
        $this->productImageURL = $productImageURL;
    }

    public function setCategoryID($categoryID): void {
        $this->categoryID = $categoryID;
    }

    public function setProductUnitPrice($productUnitPrice): void {
        $this->productUnitPrice = $productUnitPrice;
    }

    public function setProductUnitInStock($productUnitInStock): void {
        $this->productUnitInStock = $productUnitInStock;
    }

    public function setProductDetails($productDetails): void {
        $this->productDetails = $productDetails;
    }

    public function setProductFeatured($productFeatured): void {
        $this->productFeatured = $productFeatured;
    }

    public function setProductDiscontinued($productDiscontinued): void {
        $this->productDiscontinued = $productDiscontinued;
    }

    public function showAllProduct($conn, $offset, $no_of_records_per_page) {
        $sql = "SELECT pro_id, pro_name, pro_imageURL, cate_id, pro_unitprice, pro_unitinstock, pro_details, pro_featured, pro_discontinued FROM product LIMIT $offset, $no_of_records_per_page";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function countProductByCategory($conn) {
        $sql = "SELECT COUNT(*) AS element FROM product WHERE cate_id = '" . $this->categoryID . "'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row["element"];
    }

    public function showProductByCategory($conn, $offset, $no_of_records_per_page) {
        $sql = "SELECT pro_id, pro_name, pro_imageURL, cate_id, pro_unitprice, pro_unitinstock, pro_details, pro_featured, pro_discontinued FROM product WHERE cate_id = '" . $this->categoryID . "' LIMIT $offset, $no_of_records_per_page";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function showRelatedProduct($conn) {
        $sql = "SELECT pro_id, pro_name, pro_imageURL, cate_id, pro_unitprice, pro_unitinstock, pro_details, pro_featured, pro_discontinued FROM product WHERE cate_id = '" . $this->categoryID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function searchProductByID($conn) {
        $sql = "SELECT pro_id, pro_name, pro_imageURL, product.cate_id, pro_unitprice, pro_unitinstock, pro_details, pro_featured, pro_discontinued, cate_name FROM product JOIN categories ON product.cate_id = categories.cate_id WHERE pro_id = '" . $this->productID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

    public function getCategoryNameByProductID($conn) {
        $sql = "SELECT pro_id, product.cate_id, cate_name FROM product JOIN categories ON product.cate_id = categories.cate_id WHERE pro_id = '" . $this->productID . "'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row["cate_name"];
    }

    public function searchByKeywordAndCategory($conn, $keyword) {
        $sql = "SELECT * FROM product WHERE pro_name REGEXP '^" . $keyword . " .*|.* " . $keyword . " .*|.* " . $keyword . "$' AND cate_id = '" . $this->categoryID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function searchByKeyword($conn, $keyword) {
        $sql = "SELECT * FROM product WHERE pro_name REGEXP '^" . $keyword . " .*|.* " . $keyword . " .*|.* " . $keyword . "$'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function showAllProductRelated($conn) {
        $sql = "SELECT pro_id, pro_name, pro_imageURL, cate_id, pro_unitprice, pro_unitinstock, pro_details, pro_featured, pro_discontinued FROM product";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function insertProduct($conn) {
        $sql = "INSERT INTO product(pro_name, pro_imageURL, cate_id, pro_unitprice, pro_details, pro_featured, pro_discontinued) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssidsii", $this->productName, $this->productImageURL, $this->categoryID, $this->productUnitPrice, $this->productDetails, $this->productFeatured, $this->productDiscontinued);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function updateProductwImage($conn) {
        $sql = "UPDATE product SET pro_name = ?, pro_imageURL = ?, cate_id = ?, pro_unitprice = ?, pro_details = ?, pro_featured = ?, pro_discontinued = ?  WHERE pro_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssidsiii", $this->productName, $this->productImageURL, $this->categoryID, $this->productUnitPrice, $this->productDetails, $this->productFeatured, $this->productDiscontinued, $this->productID);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
    
    public function updateProductwithoutImage($conn) {
        $sql = "UPDATE product SET pro_name = ?, cate_id = ?, pro_unitprice = ?, pro_details = ?, pro_featured = ?, pro_discontinued = ?  WHERE pro_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sidsiii", $this->productName, $this->categoryID, $this->productUnitPrice, $this->productDetails, $this->productFeatured, $this->productDiscontinued, $this->productID);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }

    public function deleteProduct($conn) {
        $sql = "UPDATE product SET pro_discontinued = " . 1 . " WHERE pro_id = '" . $this->productID . "'";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    public function updateFeature($conn) {
        $sql = "UPDATE product SET pro_featured = ?  WHERE pro_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $this->productFeatured, $this->productID);
        $result = $stmt->execute();
        $conn->close();
        return $result;
    }
}
