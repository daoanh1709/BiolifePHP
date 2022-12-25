<?php

session_start();
require_once '../function/dbconnect.php';
require_once '../model/product_data.php';
?>
<?php

// Load total items
if (isset($_POST['total_cart_items'])) {
    $total_items = 0;
    $total_amount = 0;
    if (!isset($_SESSION["user_name"])) {
        $total_items = 0;
        $total_amount = 0;
    } else {
        if (isset($_SESSION["cart"])) {
            foreach ($_SESSION["cart"] as $x => $value) {
                $total_items++;
                $total_amount += doubleval($value["price"]) * intval($value["quantity"]);
            }
        }
    }

    echo '<span class="icon-qty-combine" id="cart">
                                    <i class="icon-cart-mini biolife-icon"></i>
                                    <span class="qty" id="totalitems">' . $total_items . '</span>
                                </span>
                                <span class="title" id="cartTitle">My Cart - </span>
                                <span class="sub-total" id="cartTotal">$' . number_format($total_amount, 2, '.', '') . '</span>';
    exit();
}

// Add Cart
if (isset($_GET["action"]) && $_GET["action"] == "add") {
    if (!isset($_SESSION["user_name"])) {
        echo 'exit';
        exit();
    } else {
        $id = intval($_GET["id"]);
        $quantity = $_GET["quantity"];
        $price = $_GET["price"];
        if (isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id]['quantity'] += $quantity;
            $_SESSION["cart"][$id]['price'] = $_GET["price"];
        } else {
            $stmt = $conn->prepare("SELECT pro_id, pro_name, pro_unitprice, pro_imageURL FROM product WHERE pro_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if (isset($result["pro_id"]) && $result["pro_id"]) {
                $_SESSION["cart"][$result["pro_id"]] = array("name" => $result["pro_name"], "quantity" => $quantity, "price" => $price, "imageURL" => $result["pro_imageURL"]);
            } else {
                $message = "This product id is invalid";
            }
        }
        $total_items = 0;
        $total_amount = 0;
        if (isset($_SESSION["cart"])) {

            foreach ($_SESSION["cart"] as $x => $value) {
                $total_items++;
                $total_amount += doubleval($value["price"]) * intval($value["quantity"]);
            }
        }
        echo '<span class="icon-qty-combine" id="cart">
                                    <i class="icon-cart-mini biolife-icon"></i>
                                    <span class="qty" id="totalitems">' . $total_items . '</span>
                                </span>
                                <span class="title" id="cartTitle">My Cart - </span>
                                <span class="sub-total" id="cartTotal">$' . number_format($total_amount, 2, '.', '') . '</span>';
        exit();
    }
}

// Show cart
if (isset($_POST['showcart'])) {
    if (!isset($_SESSION["user_name"])) {
        echo '<li>
                <div class="minicart-item">
                    <div class="left-info">
                        <div class="product-title">' . "No product in your cart" . '</div>
                    </div>
                </div>
            </li>';
        exit();
    } else {
        if (count($_SESSION["cart"]) > 0) {
            foreach ($_SESSION["cart"] as $id => $value) {
                echo '<li>
                <div class="minicart-item">
                    <div class="thumb">
                        <a href="#"><img src="' . $value["imageURL"] . '"nwidth="90" height="90" alt="National Fresh"></a>
                    </div>
                    <div class="left-info">
                        <div class="product-title"><a href="#" class="product-name">' . $value["name"] . '</a></div>
                        <div class="price">
                            <ins><span class="price-amount"><span class="currencySymbol">£</span>' . $value["price"] . '</span></ins>
                        </div>
                        <div class="qty">
                            <label for="cart[id123][qty]">Qty:</label>
                            <input type="number" class="input-qty" name="cart[id123][qty]" id="cart[id123][qty]" value="' . $value["quantity"] . '" disabled>
                        </div>
                    </div>
                </div>
            </li>';
            }
        } else {
            echo '<li>
                <div class="minicart-item">
                    <div class="left-info">
                        <div class="product-title">' . "No product in your cart" . '</div>
                    </div>
                </div>
            </li>';
        }
    }
    exit();
}

// Remove cart
if (isset($_GET['action']) && $_GET['action'] == "remove") {
    foreach ($_SESSION["cart"] as $key => $value) {
        if ($_GET["id"] == $key) {
            unset($_SESSION["cart"][$key]);
        }
        if (empty($_SESSION["cart"])) {
            unset($_SESSION["cart"]);
        }
    }
    $total_items = 0;
    $total_amount = 0;
    if (isset($_SESSION["cart"])) {

        foreach ($_SESSION["cart"] as $x => $value) {
            $total_items++;
            $total_amount += doubleval($value["price"]) * intval($value["quantity"]);
        }
    }
    echo '<span class="icon-qty-combine" id="cart">
                                    <i class="icon-cart-mini biolife-icon"></i>
                                    <span class="qty" id="totalitems">' . $total_items . '</span>
                                </span>
                                <span class="title" id="cartTitle">My Cart - </span>
                                <span class="sub-total" id="cartTotal">$' . number_format($total_amount, 2, '.', '') . '</span>';
    exit();
}

//if (isset($_GET['action']) && $_GET['action'] == "quickview") {
//    
//    echo '<h4> Hello </h4>';
//    exit();
//}

if (isset($_GET['action']) && $_GET['action'] == "update") {
    $id = intval($_GET["id"]);
    if (isset($_SESSION["cart"][$id])) {
        $_SESSION["cart"][$id]['quantity'] = $_GET["quantity"];
    }
    $total_items = 0;
    $total_amount = 0;
    if (isset($_SESSION["cart"])) {

        foreach ($_SESSION["cart"] as $x => $value) {
            $total_items++;
            $total_amount += doubleval($value["price"]) * intval($value["quantity"]);
        }
    }
    echo '<span class="icon-qty-combine" id="cart">
                                    <i class="icon-cart-mini biolife-icon"></i>
                                    <span class="qty" id="totalitems">' . $total_items . '</span>
                                </span>
                                <span class="title" id="cartTitle">My Cart - </span>
                                <span class="sub-total" id="cartTotal">$' . number_format($total_amount, 2, '.', '') . '</span>';
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == "empty") {
    $total_items = 0;
    $total_amount = 0;
    unset($_SESSION["cart"]);
    echo '<span class="icon-qty-combine" id="cart">
                                    <i class="icon-cart-mini biolife-icon"></i>
                                    <span class="qty" id="totalitems">' . $total_items . '</span>
                                </span>
                                <span class="title" id="cartTitle">My Cart - </span>
                                <span class="sub-total" id="cartTotal">$' . number_format($total_amount, 2, '.', '') . '</span>';
    exit();
}