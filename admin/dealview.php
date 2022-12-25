<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location:signin.php");
}
?>
<?php
include '../model/deal_data.php';
include '../model/product_data.php';

$deal = new Deal("", "", "", "", "");
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
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
              rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="assets/vendor/select2/select2.css" />
        <link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

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
                        <h2>Deal</h2>

                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="homeadmin.php">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>Deal</span></li>
                            </ol>

                            <a class="sidebar-right-toggle" style="cursor: unset"></a>
                        </div>
                    </header>

                    <!-- start: page -->
                    <section class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-md">
                                        <a href="dealinsert.php" class="btn btn-primary">Add <i
                                                class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">Product Name</th>
                                        <th style="text-align: center">Discount</th>
                                        <th style="text-align: center">Start date</th>
                                        <th style="text-align: center">End date</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                include '../function/dbconnect.php';
                                $result = $deal->showAllDeals($conn);
                                if ($result->num_rows > 0) {
                                    ?>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $i = $i + 1;
                                            include '../function/dbconnect.php';
                                            $product = new Product($row["pro_id"], "", "", "", "", "", "", "", "");
                                            $resultPro = $product->searchProductByID($conn);
                                            $rowPro = $resultPro->fetch_assoc();
                                            ?>
                                            <tr class="gradeA" id="<?php echo $row["pro_id"]; ?>"  style="text-align: center">
                                                <td class="item" id="number"><?php echo $i; ?></td>
                                                <td class="item" id="productName"><?php echo $rowPro["pro_name"]; ?></td>
                                                <td class="item" id="dealDiscount"><?php echo $row["deal_discount"]; ?></td>
                                                <td class="item" id="dealStart"><?php echo $row["deal_start"]; ?></td>
                                                <td class="item" id="dealEnd"><?php echo $row["deal_end"]; ?></td>
                                                <td class="actions">
                                                    <a href="#" class="hidden on-editing save-row saveDeal"><i class="fa fa-save"></i></a>
                                                    <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                                                    <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="on-default remove-row" id="removeDeal"><i class="fa fa-trash-o"></i></a>
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
                            <button class="mb-xs mt-xs mr-xs modal-basic btn btn-danger" style="display: none" id="showModal" href="#modalDanger">Danger</button>

                            <!-- Modal -->
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
                        </div>
                    </section>
                    <!-- end: page -->
                </section>
            </div>
        </section>

        <div id="dialog" class="modal-block mfp-hide">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Are you sure?</h2>
                </header>
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="modal-text">
                            <p>Are you sure that you want to delete this row?</p>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button id="dialogConfirm" class="btn btn-primary dialogConfirmDeal">Confirm</button>
                            <button id="dialogCancel" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </footer>
            </section>
        </div>

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
        <script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
        <script src="assets/vendor/pnotify/pnotify.custom.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>


        <!-- Examples -->
        <script src="assets/javascripts/tables/examples.datatables.editable.js"></script>
        <script src="assets/javascripts/ui-elements/examples.modals.js"></script>
    </body>

</html>