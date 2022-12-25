<?php 
$pg = $_SERVER['QUERY_STRING'];
include './function/dbconnect.php';
include_once './model/customer_data.php';
$cus_id;
if (!isset($_SESSION["cus_id"])) {
    header("location:login.php");
} else {
    $cus_id = $_SESSION["cus_id"];
}
$customer = new Customer($cus_id, "", "", "", "", "", "");
$result = $customer->searchCustomer($conn);
$row = $result->fetch_assoc();
$imageURL = $row["cus_imageURL"];
if ($imageURL == "") {
    $imageURL = 'assets/images/user/user_default.jpg';
}
?> 
<div style="height: 250px">

</div>
<!--Hero Section-->
<div class="hero-section hero-background">
    <h1 class="page-title">My Account</h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
            <li class="nav-item"><span class="current-page">My account</span></li>
        </ul>
    </nav>
</div>
<div class="container-fluid my-account">
    <div class="row">
        <div class="col-lg-3 col-md-3" id="left-side">
            <div style="display: flex; align-items: center; border-bottom: 2px solid #e8e8e8; padding-bottom: 10px">
                <div style="overflow: hidden; width: 50px; height: 50px; border-radius: 50%;" id="acountImage">
                    <!--<img src="" style="" alt="alt"/>-->
                    <?php
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['cus_imageURL']) . '" alt="alt"/>';
                    ?>
                </div>
                <div style="font-weight: bold">
                    &nbsp;&nbsp;&nbsp; 
                    <?php echo $user_name; ?>
                </div>
            </div>
            <ul class="nav flex-column" style="padding-top: 20px">
                <li class="nav-item"><a href="?page=myaccount&part=accountinfo" class="nav-link <?php if($pg == 'page=myaccount&part=accountinfo' || $pg == "page=myaccount"){echo 'active';} ?>"><i class="fa fa-user" aria-hidden="true" style="font-size: x-large"></i>&nbsp;&nbsp;&nbsp; Pesonal Information</a></li>
                <li class="nav-item"><a href="?page=myaccount&part=changepassword" class="nav-link <?php if($pg == 'page=myaccount&part=changepassword'){echo 'active';} ?>"><i class="fa fa-lock" aria-hidden="true" style="font-size: x-large"></i>&nbsp;&nbsp;&nbsp; Change Password</a></li>
                <li class="nav-item"><a href="?page=myaccount&part=deliveryaddress" class="nav-link <?php if($pg == 'page=myaccount&part=deliveryaddress'){echo 'active';} ?>"><i class="fa fa-address-book" aria-hidden="true" style="font-size: large"></i>&nbsp;&nbsp;&nbsp; Delivery Address</a></li>
            </ul>
        </div>
        <div class="col-lg-9 col-md-9" id="right-side">
            <?php
            if (isset($_GET["part"])) {
                $part = $_GET["part"];
                if ($part == "accountinfo") {
                    include_once './accountinfo.php';
                } else if ($part == "changepassword") {
                    include_once './changepassword.php';
                } else if ($part == "deliveryaddress") {
                    include_once './myaddress.php';
                }
            } else {
                include_once './accountinfo.php';
            }
            ?>
        </div>
    </div>
</div>