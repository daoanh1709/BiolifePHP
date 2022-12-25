<?php
$uri = $_SERVER['REQUEST_URI'];

$query = $_SERVER['QUERY_STRING'];

$domain = $_SERVER['HTTP_HOST'];

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

?>
<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li <?php if (strpos($url, "homeadmin") !== false) { ?> class="nav-active" <?php } ?>>
                        <a href="homeadmin.php?page=dashboard">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li <?php if (strpos($url, "categoryview") !== false) { ?> class="nav-active" <?php } ?>>
                        <a href="categoryview.php">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li <?php if (strpos($url, "product") !== false) { ?> class="nav-active" <?php } ?>>
                        <a href="productview.php" target="_self">
                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                            <span>Product</span>
                        </a>
                    </li>
                    <li <?php if (strpos($url, "deal") !== false) { ?> class="nav-active" <?php } ?>>
                        <a href="dealview.php" target="_self">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <span>Deal</span>
                        </a>
                    </li>
                    <li <?php if (strpos($url, "order") !== false) { ?> class="nav-active" <?php } ?>>
                        <a href="orderview.php">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            <span>Order</span>
                        </a>
                    </li>
                    <li <?php if (strpos($url, "customer") !== false) { ?> class="nav-active" <?php } ?>>
                        <a href="customerview.php">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Customer</span>
                        </a>
                    </li>
                </ul>
            </nav>  
        </div>
    </div>
</aside>