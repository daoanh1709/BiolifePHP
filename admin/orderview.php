<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location:signin.php");
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
        <link rel="stylesheet" href="assets/vendor/select2/select2.css" />
        <link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
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

                    <!-- start: page -->
                    <section class="panel">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">Customer Name</th>
                                        <th style="text-align: center">Address ID</th>
                                        <th style="text-align: center">Total</th>
                                        <th style="text-align: center">Payment Method</th>
                                        <th style="text-align: center">Order Date</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Note</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                include '../function/dbconnect.php';
                                include '../model/order_data.php';

                                $order = new Order("", "", "", "", "", "", "");
                                $result = $order->showAllOrders($conn);
                                if ($result->num_rows > 0) {
                                    ?>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $total = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $i = $i + 1;
                                            // Get Customer Name
                                            include '../function/dbconnect.php';
                                            include_once '../model/customer_data.php';
                                            $customer = new Customer($row["cus_id"], "", "", "", "", "", "");
                                            $resultCus = $customer->searchCustomer($conn);
                                            $rowCus = $resultCus->fetch_assoc();
                                            $cusName = $rowCus["cus_name"];

                                            // Get Total of order
                                            include '../function/dbconnect.php';
                                            include_once '../model/orderdetails_data.php';
                                            $orderDetail = new OrderDetails($row["ord_id"], "", "", "");
                                            $result1 = $orderDetail->searchOrderDetailsByID($conn);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $total = $total + $row1["unitprice"] * $row1["quantity"];
                                            }
                                            $staid = $row["sta_id"];
                                            ?>
                                            <tr class="gradeC" style="text-align: center">
                                                <td class="item"><?php echo $i; ?></td>
                                                <td class="item"><?php echo $cusName; ?></td>
                                                <td class="item"><?php echo $row["add_id"]; ?></td>
                                                <td class="item">$ <?php echo $total; ?></td>
                                                <td class="item"><?php echo $row["ord_payment"]; ?></td>
                                                <td class="item"><?php echo $row["ord_date"]; ?></td>
                                                <td class="item" style="font-weight: bold; color: <?php
                                                if ($staid == 0) {
                                                    echo 'orange';
                                                } elseif ($staid == 1) {
                                                    echo 'blue';
                                                } elseif ($staid == 2) {
                                                    echo 'purple';
                                                } elseif ($staid == 3) {
                                                    echo 'green';
                                                } elseif ($staid == 4) {
                                                    echo 'red';
                                                }
                                                ?>"><?php echo $row["sta_description"]; ?></td>
                                                <td class="item"><?php echo $row["ord_note"]; ?></td>
                                                <td class="actions">
                                                    <button onclick="vieworder(<?php echo $row["ord_id"]; ?>)" class="on-default" style="border: none; background-color: #fff; padding: 0px; margin-right: 5px"><i class="fa fa-bars"></i></button>
                                                    <button onclick="updateorder(<?php echo $row["ord_id"]; ?>)" class="on-default remove-row" style="border: none; background-color: #fff; padding: 0px"><i class="fa fa-pencil"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </section>
                    <a class="mb-xs mt-xs mr-xs btn btn-default" data-toggle="modal" data-target="#modalBootstrap" style="display: none" id="openViewOrder">Open Form</a>

                    <!-- Modal Form -->
                    <div id="modalBootstrap" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="myModalLabel" style="font-weight: bold">Details</h3>
                                </div>
                                <div class="modal-body" id="modalOrderDetails">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
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
        <script src="assets/vendor/select2/select2.js"></script>
        <script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
        <script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
        <script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
        <script src="assets/vendor/pnotify/pnotify.custom.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>


        <!-- Examples -->
        <script src="assets/javascripts/tables/examples.datatables.default.js"></script>
        <script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
        <script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
        <script src="assets/javascripts/ui-elements/examples.modals.js"></script>
    </body>
</html>