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
                        <h2>Product</h2>

                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="homeadmin.php">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>Product</span></li>
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
                                        <a href="productinsert.php?action=create" class="btn btn-primary">Add <i
                                                class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped mb-none" id="datatable-editable" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">Name</th>
                                        <th style="text-align: center">Price</th>
                                        <th style="text-align: center">Category</th>
                                        <th style="text-align: center">Description</th>
                                        <th style="text-align: center">Image</th>
                                        <th style="text-align: center">Featured</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                include '../function/dbconnect.php';
                                include '../model/product_data.php';
                                $product;
                                if (isset($_GET['category'])) {
                                    $cateID = $_GET['category'];
                                    $product = new Product("", "", "", $cateID, "", "", "", "", "");
                                    $result = $product->showRelatedProduct($conn);
                                } else {
                                    $product = new Product("", "", "", "", "", "", "", "", "");
                                    $result = $product->showAllProductRelated($conn);
                                }

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
                                                <tr class="gradeA" id="<?php echo $row["pro_id"]; ?>">
                                                    <td class="item"><?php echo $i; ?></td>
                                                    <td class="item"><?php echo $row["pro_name"]; ?></td>
                                                    <td class="item">$<?php echo $row["pro_unitprice"]; ?></td>
                                                    <td class="item"><?php echo $cateName; ?></td>
                                                    <td class="item" style="width: 174px">
                                                        <?php
                                                        $in = $row["pro_details"];
                                                        $out = strlen($in) > 100 ? substr($in, 0, 100) . "..." : $in;
                                                        echo $out;
                                                        ?>
                                                    </td>
                                                    <td class="item">
                                                        <img src="<?php echo $imgURL; ?>" width="50px" height="50px" alt="alt"/>
                                                    </td> 
                                                    <td class="item">
                                                        <div class="switch switch-sm switch-primary" id="featuredProduct" onclick="feature_product(<?php echo $row["pro_id"]; ?>, this)">
                                                            <input type="checkbox" name="switch" id="checkFeature" data-plugin-ios-switch <?php if ($row["pro_featured"] == 1) { ?> checked <?php } ?> />
                                                        </div>
                                                    </td>
                                                    <td class="actions">
                                                        <a href="productedit.php?action=edit&id=<?php echo $row["pro_id"]; ?>" class="on-default"><i class="fa fa-pencil"></i></a>
                                                        <a href=""  class="on-default remove-row" id="removeProduct"><i class="fa fa-trash-o"></i></a>
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
                            <button id="dialogConfirm" class="btn btn-primary dialogConfirmProduct">Confirm</button>
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
        <script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
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