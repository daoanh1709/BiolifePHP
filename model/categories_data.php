<?php

class Category {

    private $categoryID;
    private $categoryName;
    private $categoryDes;
    private $categoryImageURL;

    public function __construct($categoryID, $categoryName, $categoryDes, $categoryImageURL) {
        $this->categoryID = $categoryID;
        $this->categoryName = $categoryName;
        $this->categoryDes = $categoryDes;
        $this->categoryImageURL = $categoryImageURL;
    }

    public function getCategoryID() {
        return $this->categoryID;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }

    public function getCategoryDes() {
        return $this->categoryDes;
    }

    public function getCategoryImageURL() {
        return $this->categoryImageURL;
    }

    public function setCategoryID($categoryID): void {
        $this->categoryID = $categoryID;
    }

    public function setCategoryName($categoryName): void {
        $this->categoryName = $categoryName;
    }

    public function setCategoryDes($categoryDes): void {
        $this->categoryDes = $categoryDes;
    }

    public function setCategoryImageURL($categoryImageURL): void {
        $this->categoryImageURL = $categoryImageURL;
    }

    public function showAllCategories($conn) {
        $sql = "SELECT cate_id, cate_name, cate_description, cate_imageURL FROM categories";
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }

}
