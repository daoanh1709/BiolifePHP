<?php
include '../function/dbconnect.php';
include_once '../model/admin_data.php';
$ad_id = $_SESSION["admin_id"];
$admin = new Admin($ad_id, "", "", "", "", "", "", "", "");
$result = $admin->searchAdmin($conn);
$row = $result->fetch_assoc();
$ad_name = $row["ad_name"];
$ad_image = $row["ad_image"];
?>
<!-- start: header -->
<header class="header">
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="assets/images/logo-biolife-1.png" height="35" alt="JSOFT Admin" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture" id="loginImage">
                    <?php
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($ad_image) . '" alt="" class="img-circle">';
                    ?>
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                    <span class="name" id="loginName"><?php echo $ad_name; ?></span>
                    <span class="role">administrator</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="adminprofile.php"><i class="fa fa-user"></i> My Profile</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>