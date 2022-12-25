<?php

include '../../function/dbconnect.php';
include_once '../../model/product_data.php';
include_once '../../model/categories_data.php';
if (isset($_POST['action']) && $_POST['action'] == "edit") {
    $proid = $_POST['productID'];
    $cate = $_POST['productCategory'];
    $proName = trim($_POST['productName']);
    $proPrice = trim($_POST['productPrice']);
    $cateArr = explode("|", $cate);
    $cateID = $cateArr[0];
    $cateName = $cateArr[1];
    $target_file = "";
    $proDetails;
    $proFeatured = 0;
// Image
    if ($_FILES['productImage']['tmp_name'] != "") {
        $target_dir = "assets/images/product/" . str_replace(" ", "", $cateName) . "/";
        $uploadOk = 1;
        $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo 'NaI';
            exit();
        }

        if (file_exists($target_file)) {
            echo 'exist';
            exit();
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo 'allow';
            exit();
        }

        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], "../../" . $target_file)) {
                $target_file = "";
                echo 'notupload';
                exit();
            }
        }
    }
    if (isset($_POST['details'])) {
        $proDetails = $_POST['details'];
    }

    if (isset($_POST['productFeatured'])) {
        $proFeatured = 1;
    }

    $product = new Product($proid, $proName, $target_file, $cateID, $proPrice, 0, $proDetails, $proFeatured, 0);
    if ($target_file == "") {
        if ($product->updateProductwithoutImage($conn) == true) {
            echo 'UpdateSuccess';
            exit();
        } else {
            echo 'Fail';
            exit();
        }
    } else {
        if ($product->updateProductwImage($conn) == true) {
            echo 'UpdateSuccess';
            exit();
        } else {
            echo 'Fail';
            exit();
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == "create") {
    $cate = $_POST['productCategory'];
    $proName = trim($_POST['productName']);
    $proPrice = trim($_POST['productPrice']);
    $cateArr = explode("|", $cate);
    $cateID = $cateArr[0];
    $cateName = $cateArr[1];
    $target_file = "";
    $proDetails;
    $proFeatured = 0;
// Image
    if ($_FILES['productImage']['tmp_name'] != "") {
        $target_dir = "assets/images/product/" . str_replace(" ", "", $cateName) . "/";
        $uploadOk = 1;
        $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["productImage"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo 'NaI';
            exit();
        }

        if (file_exists($target_file)) {
            echo 'exist';
            exit();
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo 'allow';
            exit();
        }

        if ($uploadOk == 1) {
            if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], "../../" . $target_file)) {
                $target_file = "";
                echo 'notupload';
                exit();
            }
        }
    }
    if (isset($_POST['details'])) {
        $proDetails = $_POST['details'];
    }

    if (isset($_POST['productFeatured'])) {
        $proFeatured = 1;
    }
    // Insert
    $product = new Product("", $proName, $target_file, $cateID, $proPrice, 0, $proDetails, $proFeatured, 0);
    if ($product->insertProduct($conn) == true) {
        echo 'Success';
        exit();
    } else {
        echo 'Fail';
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == "remove") {
    $id = $_GET['id'];
    $product = new Product($id, "", "", "", "", "", "", "", 0);
    if ($product->deleteProduct($conn) == false) {
        echo 'Fail';
        exit();
    } else {
        echo 'Success';
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == "feature") {
    $id = $_GET['id'];
    $feature = $_GET['feature'];
    $product = new Product($id, "", "", "", "", "", "", $feature, "");
    if ($product->updateFeature($conn) == true) {
        echo 'Success';
        exit();
    } else {
        echo 'Fail';
        exit();
    }
}
?>