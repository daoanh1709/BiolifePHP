<?php

session_start();
require_once '../function/dbconnect.php';
require_once '../model/product_data.php';
?>
<?php 
// Load wishlist
if (isset($_POST['total_cart_items'])) {
    $total_items = 0;
    if (!isset($_SESSION["user_name"])) {
        $total_items = 0;
    } else {
        if (isset($_SESSION["wishlist"])) {
            foreach ($_SESSION["wishlist"] as $x => $value) {
                $total_items++;
            }
        }
    }

    echo '<span class="icon-qty-combine">
                                <i class="icon-heart-bold biolife-icon"></i>
                                <span class="qty">' . $total_items . '</span>
                            </span>';
    exit();
}

// Add Wishlist
if (isset($_GET["action"]) && $_GET["action"] == "add") {
    if (!isset($_SESSION["user_name"])) {
        echo 'exit';
        exit();
    } else {
        $id = intval($_GET["id"]);
        if (isset($_SESSION["wishlist"][$id])) {
            echo 'exist';
            exit();
        } else {
            $stmt = $conn->prepare("SELECT pro_id, pro_name, pro_unitprice, pro_imageURL FROM product WHERE pro_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if (isset($result["pro_id"]) && $result["pro_id"]) {
                $_SESSION["wishlist"][$result["pro_id"]] = array("name" => $result["pro_name"], "price" => $_GET["price"], "imageURL" => $result["pro_imageURL"]);
            } else {
                $message = "This product id is invalid";
            }
        }
        $total_items = 0;
        if (isset($_SESSION["wishlist"])) {
            foreach ($_SESSION["wishlist"] as $x => $value) {
                $total_items++;
            }
        }
        echo '<span class="icon-qty-combine">
                                <i class="icon-heart-bold biolife-icon"></i>
                                <span class="qty">' . $total_items . '</span>
                            </span>';
        exit();
    }
}

// Remove wishlist
if (isset($_GET['action']) && $_GET['action'] == "remove") {
    foreach ($_SESSION["wishlist"] as $key => $value) {
        if ($_GET["id"] == $key) {
            unset($_SESSION["wishlist"][$key]);
        }
        if (empty($_SESSION["wishlist"])) {
            unset($_SESSION["wishlist"]);
        }
    }
    $total_items = 0;
    if (isset($_SESSION["wishlist"])) {

        foreach ($_SESSION["wishlist"] as $x => $value) {
            $total_items++;
        }
    }
    echo '<span class="icon-qty-combine">
                                <i class="icon-heart-bold biolife-icon"></i>
                                <span class="qty">' . $total_items . '</span>
                            </span>';
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == "empty") {
    $total_items = 0;
    unset($_SESSION["wishlist"]);
    echo '<span class="icon-qty-combine">
                                <i class="icon-heart-bold biolife-icon"></i>
                                <span class="qty">' . $total_items . '</span>
                            </span>';
    exit();
}