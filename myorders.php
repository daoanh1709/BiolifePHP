<?php
include './function/dbconnect.php';
include_once './model/order_data.php';
$cus_id = $_SESSION["cus_id"];
$order = new Order("", $cus_id, "", "", "", "", "");
$result = $order->getOrderOfCustomer($conn);
?>
<div style="height: 250px">

</div>
<!--Hero Section-->
<div class="hero-section hero-background">
    <h1 class="page-title">My Orders</h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
            <li class="nav-item"><span class="current-page">My orders</span></li>
        </ul>
    </nav>
</div>

<div class="page-contain shopping-cart">
    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">

            <!--Orders Table-->
            <div class="shopping-cart-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  id="myorders">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Add Modal -->
<div class="modal fade" id="viewOrder">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>