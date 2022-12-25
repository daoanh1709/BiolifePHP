<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location:signin.php");
} else if (!isset($_GET['action'])) {
    header("location:productview.php");
}
?>
<?php
$row;
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
        <!--<link rel="stylesheet" href="assets/vendor/select2/select2.css" />-->
        <!--<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />-->
        <link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

        <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
        <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.9/adapters/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/piexif.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/plugins/sortable.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/fileinput.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/js/locales/LANG.js"></script>

        <!-- Head Libs -->
        <script src="assets/vendor/modernizr/modernizr.js"></script>
        <style>
            .input-group{
                position: relative;
                display: flex;
                flex-wrap: wrap;
                align-items: stretch;
                width: 100%;
            }
            .input-group>.form-control {
                position: relative;
                flex: 1 1 auto;
                width: 1%;
                min-width: 0;
            }
            .btn-close,
            .fileinput-upload {
                display: none
            }
            .file-thumbnail-footer {
                display: none
            }
            .file-preview-thumbnails {
            }
        </style>
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
                    <?php
                    include '../function/dbconnect.php';
                    include_once '../model/product_data.php';
                    include_once '../model/categories_data.php';

                    if (isset($_GET["action"]) && $_GET["action"] == "edit") {
                        $product = new Product($_GET["id"], "", "", "", "", "", "", "", "");
                        $result = $product->searchProductByID($conn);
                        $row = $result->fetch_assoc();
                        $imgURL = "../" . $row["pro_imageURL"];
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal form-bordered" action="" method="post" id="formProductInsert" enctype="multipart/form-data">
                                <section class="panel">
                                    <div class="panel-body" id="edit-body">
                                        <div class="form-group">
                                            <input type="hidden" id="productID" name="productID" value="<?php
                                            if (isset($_GET["action"]) && $_GET["action"] == "edit") {
                                                echo $row["pro_id"];
                                            }
                                            ?>">
                                            <label class="col-md-2 control-label" for="productCategory">Category</label>
                                            <div class="col-md-8">
                                                <select class="form-control mb-md" id="productCategory" name="productCategory">
                                                    <?php
                                                    $category = new Category("", "", "", "");
                                                    include '../function/dbconnect.php';
                                                    $resultCate = $category->showAllCategories($conn);
                                                    if ($resultCate->num_rows > 0) {
                                                        while ($rowCate = $resultCate->fetch_assoc()) {
                                                            ?>
                                                            <option <?php if (isset($_GET["action"]) && $_GET["action"] == "edit" && $row["cate_id"] == $rowCate["cate_id"]) { ?> selected="selected" <?php } ?> value="<?php echo $rowCate["cate_id"]; ?>|<?php echo $rowCate["cate_name"]; ?>"><?php echo $rowCate["cate_name"]; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="productName">Name</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="productName" name="productName" value="<?php
                                                if (isset($_GET["action"]) && $_GET["action"] == "edit") {
                                                    echo $row["pro_name"];
                                                }
                                                ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="productPrice">Unit Price</label>
                                            <div class="col-md-8">
                                                <div class="input-group mb-md">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control" id="productPrice" placeholder="0.00" name="productPrice" value="<?php
                                                    if (isset($_GET["action"]) && $_GET["action"] == "edit") {
                                                        echo $row["pro_unitprice"];
                                                    }
                                                    ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="inputImage">Image</label>
                                            <div class="col-md-8">
                                                <img src="<?php
                                                if (isset($_GET["action"]) && $_GET["action"] == "edit") {
                                                    echo $row["pro_imageURL"];
                                                }
                                                ?>" id="imageInfo" style="display: none" alt="alt"/>
                                                <input id="productImage" name="productImage" type="file" class="file" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="inputDescription">Description</label>
                                            <div class="col-md-8">
                                                <textarea name="DSC" class="materialize-textarea" id="productDescription" required><?php
                                                    if (isset($_GET["action"]) && $_GET["action"] == "edit") {
                                                        echo $row["pro_details"];
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" style="padding-top: 0px"></label>
                                            <div class="col-sm-8">
                                                <div class="checkbox-custom checkbox-default">
                                                    <input type="checkbox" <?php if (isset($_GET["action"]) && $_GET["action"] == "edit" && $row["pro_featured"] == 1) { ?> checked <?php } ?> id="productFeatured" name="productFeatured">
                                                    <label for="checkboxExample1">&nbsp;&nbsp;Feature product?</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer class="panel-footer" id="edit-footer">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <input type="submit" onclick="checkProduct();" value="Submit" class="btn btn-primary" id="submitProduct" name="submitProduct">
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
                                            <footer class="panel-footer" style="background: ">
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
                    <script>
                        $(function () {
                            $('textarea[name="DSC"]').ckeditor();
                        });
                    </script>
                </section>
            </div>
        </section>

        <!-- Vendor -->
        <!--<script src="assets/vendor/jquery/jquery.js"></script>-->
        <script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        <!-- Specific Page Vendor -->
        <script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
        <script src="assets/vendor/pnotify/pnotify.custom.js"></script>
        <!--<script src="assets/vendor/select2/select2.js"></script>-->
        <!--<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>-->
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
        <!--<script src="assets/javascripts/tables/examples.datatables.editable.js"></script>-->
        <script src="assets/javascripts/ui-elements/examples.modals.js"></script>
    </body>
</html>