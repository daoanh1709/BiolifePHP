<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location:signin.php");
}
?>
<?php
include '../function/dbconnect.php';
include_once '../model/admin_data.php';

$admin = new Admin($_SESSION['admin_id'], "", "", "", "", "", "", "", "");
$result = $admin->searchAdmin($conn);
$row = $result->fetch_assoc();
$ad_name = $row["ad_name"];
$ad_image = $row["ad_image"];
$ad_email = $row["ad_email"];
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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

        <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
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
            .file-default-preview {
                width: 227px;
                height: 174px;
                margin: 8px;
                border: 1px solid rgba(0,0,0,.2);
                box-shadow: 0 0 10px 0 rgb(0 0 0 / 20%);
                padding: 6px;
                float: left;
                text-align: center;
            }
            .file-thumbnail-footer {
                display: none
            }
            .file-preview-thumbnails {
            }
        </style>
        <script>
            $(document).ready(function () {
                var url1 = $('#imageAdmin').attr('src');
                $("#adminImage").fileinput({
                    initialPreview: [
                        url1
                    ],
                    initialPreviewAsData: true,
                    defaultPreviewContent: '<img src="' + url1 + '" alt="">',
                    showUpload: false
                });
            });
        </script>
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
                        <h2>User Profile</h2>

                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="homeadmin.php">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li><span>User Profile</span></li>
                            </ol>

                            <a class="sidebar-right-toggle" style="cursor: unset"></a>
                        </div>
                    </header>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs">
                                <ul class="nav nav-tabs tabs-primary">
                                    <li class="active">
                                        <a href="#information" data-toggle="tab">Personal Information</a>
                                    </li>
                                    <li>
                                        <a href="#change" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="information" class="tab-pane active">
                                        <form class="form-horizontal" method="post" id="formInfoAdmin" enctype="multipart/form-data">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="profileName">Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="profileName" name="profileName" required value="<?php echo $ad_name; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="profileEmail">Email</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="profileEmail" name="profileEmail" required value="<?php echo $ad_email; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="profileAddress">Image</label>
                                                    <div class="col-md-8">
                                                        <?php
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($ad_image) . '" alt="" style="display:none" id="imageAdmin" class="img-circle">';
                                                        ?>
                                                        <input id="adminImage" name="adminImage" type="file">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <!--<button type="reset" class="btn btn-default">Reset</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="change" class="tab-pane">

                                        <form class="form-horizontal" method="post" action="" id="changePassAdmin">
                                            <fieldset class="mb-xl">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="profileCurrentPassword">Current Password</label>
                                                    <div class="col-md-8">
                                                        <input type="password" class="form-control" id="profileCurrentPassword" name="profileCurrentPassword">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="profileNewPassword">New Password</label>
                                                    <div class="col-md-8">
                                                        <input type="password" class="form-control" id="profileNewPassword" name="profileNewPassword">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="profileConfirmPassword">Confirm Password</label>
                                                    <div class="col-md-8">
                                                        <input type="password" class="form-control" id="profileConfirmPassword" name="profileConfirmPassword">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- end: page -->
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