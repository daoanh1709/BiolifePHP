<?php
session_start();

$from;

$uri = $_SERVER['REQUEST_URI'];

$query = $_SERVER['QUERY_STRING'];

$domain = $_SERVER['HTTP_HOST'];

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (strpos($url, "index") !== false) {
    if ($query == "") {
        $from = "from=index&page=home";
    } else {
        $from = "from=index&" . $query;
    }
} elseif (strpos($url, "product.php") !== false) {
    if ($query != "") {
        $from = "from=product&" . $query;
    } else {
        $from = "from=product";
    }
} elseif (strpos($url, "details") !== false) {
    $from = "from=details&" . $query;
} else {
    $from = "from=index&page=home";
}

if (isset($_SESSION['user_name'])) {
    if ($_SESSION['user_name'] != null) {
        $user_name = $_SESSION['user_name'];
    } else {
        $user_name = "User";
    }
} else {
    $user_name = "Login/Register";
}
?>
<div class="header-top hidden-xs hidden-sm">
    <div class="container">
        <div class="top-bar left">
            <ul class="horizontal-menu">
                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Organic@company.com</a></li>
            </ul>
            <ul class="social-list circle-layout">
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="top-bar right">
            <ul class="horizontal-menu">
                <li><a href="#">Free Shipping for all Order of $99</a></li>
                <?php
                if (isset($_SESSION['user_name'])) {
                    ?>
                    <li class="login-menu" id="loginIcon" style="position: relative; display: inline-block">
                        <a href="#" class="login-link" style="display: inline-block"><i
                                class="biolife-icon icon-login"></i><?php echo $user_name; ?></a>
                        <ul>
                            <li><a href="index.php?page=myaccount">My Account</a></li>
                            <li><a href="index.php?page=myorders">My Orders</a></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>
                    <li><a href="login.php?<?php echo $from; ?>" class="login-link"><i
                                class="biolife-icon icon-login"></i><?php echo $user_name; ?></a></li>
                            <?php
                        }
                        ?>
            </ul>
        </div>
    </div>
</div>