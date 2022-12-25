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
        <link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="assets/vendor/select2/select2.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
        <link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
        <link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
        <link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
        <link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />
        <link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
        <link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />
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
                        <h2>Customer</h2>

                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="homeadmin.php">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>Customer</span></li>
                            </ol>

                            <a class="sidebar-right-toggle" style="cursor: unset"></a>
                        </div>
                    </header>

                    <!-- start: page -->
                    <section class="panel">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped mb-none" id="datatable-editable" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">#</th>
                                        <th style="text-align: center">Name</th>
                                        <th style="text-align: center">Gender</th>
                                        <th style="text-align: center">Phone</th>
                                        <th style="text-align: center">Email</th>
                                        <th style="text-align: center">Password</th>
                                        <!--<th style="text-align: center">Actions</th>-->
                                    </tr>
                                </thead>
                                <?php
                                include '../function/dbconnect.php';
                                include '../model/customer_data.php';

                                $customer = new Customer("", "", "", "", "", "", "");
                                $result = $customer->showAllCustomer($conn);
                                if ($result->num_rows > 0) {
                                    ?>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $i = $i + 1;
                                            ?>
                                            <tr class="gradeC" style="text-align: center">
                                                <td class="item"><?php echo $i; ?></td>
                                                <td class="item"><?php echo $row["cus_name"]; ?></td>
                                                <td class="item"><?php echo $row["cus_gender"]; ?></td>
                                                <td class="item"><?php echo $row["cus_phone"]; ?></td>
                                                <td class="item"><?php echo $row["cus_email"]; ?></td>
                                                <td class="item"><?php echo $row["cus_password"]; ?></td>
        <!--                                                <td class="actions">
                                                    <button onclick="vieworder(<?php echo $row["ord_id"]; ?>)" class="on-default" style="border: none; background-color: #fff; padding: 0px; margin-right: 5px"><i class="fa fa-bars"></i></button>
                                                    <button onclick="updateorder(<?php echo $row["ord_id"]; ?>)" class="on-default remove-row" style="border: none; background-color: #fff; padding: 0px"><i class="fa fa-pencil"></i></button>
                                                </td>-->
                                            </tr>
                                            <?php
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
        <script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
        <script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
        <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
        <script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
        <script src="assets/vendor/select2/select2.js"></script>
        <script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
        <script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
        <script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
        <script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script src="assets/vendor/fuelux/js/spinner.js"></script>
        <script src="assets/vendor/dropzone/dropzone.js"></script>
        <script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
        <script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
        <script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
        <script src="assets/vendor/codemirror/lib/codemirror.js"></script>
        <script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
        <script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
        <script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
        <script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
        <script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
        <script src="assets/vendor/codemirror/mode/css/css.js"></script>
        <script src="assets/vendor/summernote/summernote.js"></script>
        <script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
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