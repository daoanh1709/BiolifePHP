<?php 
if (isset($_GET["orderid"])) {
    $orderid = $_GET["orderid"];
}
?>
<div style="height: 250px">

</div>
<div class="page-contain login-page" style="background-color: #f0f2f5">

    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">

            <div class="row" style="margin-top: 115px;background-color: #f0f2f5; margin-bottom: 115px; align-items: center; display: flex;">

                <!--Form Register-->
                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">

                </div>
                <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8" style="background-color: #ffffff; border-radius: 7px;box-shadow: 0 2px 4px rgb(0 0 0 / 10%), 0 8px 16px rgb(0 0 0 / 10%);padding: 0px">
                    <div class="signin-container" style="margin-top: 0px;text-align: center;">
                        <div style=" background-color: #05a503;border-top-right-radius: 7px;border-top-left-radius: 7px;padding: 20px 0px">
                            <i class="fa fa-check main-content__checkmark" id="checkmark" style="font-size: 60px; color: #fff"></i>
                        </div>
                        <div>
                            <h1 class="site-header__title" data-lead-id="site-header-title" style="font-size: 6.25rem; font-family: Montserrat, sans-serif; font-weight: 700; line-height: 1.1; color: #000">THANK YOU!</h1>
                            <p>Your order has been successfully processed. Order number is: #<?php echo $orderid; ?></p>
                            <p>Visit your <a href="index.php?page=myorders" style="color: #05a503">My orders</a> page to view your orders and order details</p>
                            <p>If you have any questions, please contact us at <a href="index.php?page=contact" style="color: #05a503">here</a></p>
                            <a href="product.php" class="btn btn-bold remove" type="submit" style="margin-top: 10px;">Continue shopping</a>
                        </div>
                    </div>
                </div>

                <!--Go to Register form-->
                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">

                </div>

            </div>

        </div>
    </div>
</div>