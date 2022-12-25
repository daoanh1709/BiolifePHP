<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location:signin.php");
} else if (!isset($_GET['id'])) {
    header("location:orderview.php");
}
?>
<?php
include_once '../model/order_data.php';
include_once '../model/orderstatus_data.php';
$id;
$ordID;
if (isset($_GET["id"])) {
    include '../function/dbconnect.php';
    $ordID = $_GET["id"];
    $order = new Order($_GET["id"], "", "", "", "", "", "");
    $result = $order->searchOrderByID($conn);
    $row = $result->fetch_assoc();
    $id = $row["sta_id"];
}
?>
<!doctype html>
<html class="fixed">
    <head>

        <!-- Basic -->
        <meta charset="UTF-8">

        <title>Biolife Store Admin</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="author" content="okler.net">
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
        <link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="assets/vendor/modernizr/modernizr.js"></script>

    </head>
    <body>
        <div id="biof-loading">
            <div class="biof-loading-center">
                <div class="biof-loading-center-absolute">
                    <div class="dot dot-one"></div>
                    <div class="dot dot-two"></div>
                    <div class="dot dot-three"></div>
                </div>
            </div>
        </div>
        <section class="body">

            <!-- start: header -->
            <?php
            include_once './header.php';
            ?>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <?php
                include_once './menu.php';
                ?>
                <!-- end: sidebar -->

                <section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Orders</h2>

                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="homeadmin.php">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>Orders</span></li>
                            </ol>

                            <a class="sidebar-right-toggle" style="cursor: unset"></a>
                        </div>
                    </header>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal form-bordered" action="" method="post" id="formOrder" enctype="multipart/form-data">
                                <section class="panel">
                                    <div class="panel-body" id="edit-body">
                                        <div class="form-group">
                                            <input type="hidden" id="orderID" name="orderID" value="<?php echo $ordID; ?>">
                                            <label class="col-md-2 control-label" for="productCategory">Status</label>
                                            <div class="col-md-8">
                                                <select class="form-control mb-md" id="orderStatus" name="orderStatus">
                                                    <?php
                                                    $status = new Status("", "");
                                                    include '../function/dbconnect.php';
                                                    $resultSta = $status->showAllStatus($conn);
                                                    if ($resultSta->num_rows > 0) {
                                                        while ($rowSta = $resultSta->fetch_assoc()) {
                                                            ?>
                                                            <option <?php if ($rowSta["sta_id"] == $id) { ?> selected="selected" <?php } ?> value="<?php echo $rowSta["sta_id"]; ?>"><?php echo $rowSta["sta_description"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer" id="edit-footer">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <input type="submit" value="Submit" class="btn btn-primary" id="submitProduct" name="submitProduct">
                                                <button class="mb-xs mt-xs mr-xs modal-basic btn btn-danger" style="display: none" id="showModal" href="#modalDanger">Danger</button>
                                            </div>
                                        </div>
                                    </footer>

                                    <div id="modalDanger" class="modal-block modal-block-danger mfp-hide">
                                        <section class="panel">
                                            <header class="panel-heading">
                                                <h2 class="panel-title">Error!</h2>
                                            </header>
                                            <div class="panel-body">
                                                <div class="modal-wrapper">
                                                    <div class="modal-icon">
                                                        <i class="fa fa-times-circle"></i>
                                                    </div>
                                                    <div class="modal-text">
                                                        <h4>Notification</h4>
                                                        <p>This is a danger message.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <footer class="panel-footer">
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button class="btn btn-danger modal-dismiss" id="submit">OK</button>
                                                    </div>
                                                </div>
                                            </footer>
                                        </section>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                    <!-- end: page -->
                </section>
            </div>
        </section>

        <!-- Vendor -->
        <script src="assets/vendor/jquery/jquery.js"></script>
        <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        <!-- Specific Page Vendor -->
        <script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
        <script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="assets/vendor/pnotify/pnotify.custom.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>
        <script src="assets/javascripts/ui-elements/examples.modals.js"></script>
    </body>
</html>