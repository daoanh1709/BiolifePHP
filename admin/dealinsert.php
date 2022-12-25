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
        <meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
        <meta name="author" content="JSOFT.net">
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
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal form-bordered" action="" method="post" id="dealForm" enctype="multipart/form-data">
                                <section class="panel">
                                    <div class="panel-body" id="edit-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="dealProduct">Product Name</label>
                                            <div class="col-md-8">
                                                <input type="text" value="" id="dealProduct" class="form-control" required readonly="readonly" title="You cannot edit this field. Please select a product in the table below" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Date range</label>
                                            <div class="col-md-8">
                                                <div class="input-daterange input-group" data-plugin-datepicker>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" name="start" required="" id="dealStart">
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" class="form-control" name="end" required="" id="dealEnd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="dealDiscount">Discount</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="dealDiscount" name="dealDiscount" placeholder="From 0.0 - 1.0" required>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer" id="edit-footer">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <input type="submit" value="Submit" class="btn btn-primary">
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
                        <!--<form action="" method="post" enctype="multipart/form-data" >-->

                        <!--</form>-->
                    </div>
                    <header class="panel-heading">
                        <div class="panel-actions">
                        </div>

                        <h2 class="panel-title">Products table</h2>
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none productDealTable" id="datatable-editable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <?php
                            include '../function/dbconnect.php';
                            include '../model/product_data.php';
                            $product = new Product("", "", "", "", "", "", "", "", "");
                            $result = $product->showAllProductRelated($conn);
                            if ($result->num_rows > 0) {
                                ?>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row["pro_discontinued"] == 0) {
                                            $i = $i + 1;
                                            include '../function/dbconnect.php';
                                            $product->setProductID($row["pro_id"]);
                                            $cateName = $product->getCategoryNameByProductID($conn);
                                            $imgURL = "../" . $row["pro_imageURL"];
                                            ?>
                                            <tr class="gradeA" style="cursor: pointer" id="<?php echo $row["pro_id"]; ?>">
                                                <td class="item"><?php echo $i; ?></td>
                                                <td class="item"><span class="proname"><?php echo $row["pro_name"]; ?></span></td>
                                                <td class="item">$<?php echo $row["pro_unitprice"]; ?></td>
                                                <td class="item"><?php echo $cateName; ?></td>
                                                <td class="item">
                                                    <img src="<?php echo $imgURL; ?>" width="50px" height="50px" alt="alt"/>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <?php
                            } else {
                                ?>
                                <tbody>
                                    <tr class="odd">
                                        <td valign="top" colspan="8" class="dataTables_empty">No data available in table</td>
                                    </tr>
                                </tbody>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
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
        <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
        <script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
        <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
        <script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
        <script src="assets/vendor/flot/jquery.flot.js"></script>
        <script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
        <script src="assets/vendor/flot/jquery.flot.pie.js"></script>
        <script src="assets/vendor/flot/jquery.flot.categories.js"></script>
        <script src="assets/vendor/flot/jquery.flot.resize.js"></script>
        <script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
        <script src="assets/vendor/raphael/raphael.js"></script>
        <script src="assets/vendor/morris/morris.js"></script>
        <script src="assets/vendor/gauge/gauge.js"></script>
        <script src="assets/vendor/snap-svg/snap.svg.js"></script>
        <script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
        <script src="assets/vendor/jqvmap/jquery.vmap.js"></script>
        <script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
        <script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
        <script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
        <script src="assets/vendor/summernote/summernote.js"></script>
        <script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="assets/vendor/pnotify/pnotify.custom.js"></script>
        <script src="assets/vendor/select2/select2.js"></script>
        <script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
        <script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="assets/javascripts/theme.init.js"></script>


        <!-- Examples -->
        <script src="assets/javascripts/dashboard/examples.dashboard.js"></script>
        <script src="assets/javascripts/ui-elements/examples.lightbox.js"></script>
        <script src="assets/javascripts/tables/examples.datatables.editable.js"></script>
        <script src="assets/javascripts/ui-elements/examples.modals.js"></script>
    </body>
</html>

