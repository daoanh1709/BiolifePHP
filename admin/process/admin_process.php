<?php

session_start();
include '../../function/dbconnect.php';
include_once '../../model/admin_data.php';

if (isset($_POST["profileName"])) {
    $name = $_POST["profileName"];
    $email = $_POST["profileEmail"];
    $ad_id = $_SESSION["admin_id"];
    $image;
    if ($_FILES['adminImage']['tmp_name'] != "") {
        if (getimagesize($_FILES['adminImage']['tmp_name']) == false) {
            echo "<br>Please Select An Image.";
        } else {
            $image = addslashes(file_get_contents($_FILES['adminImage']['tmp_name']));
            $sql = "UPDATE admin SET ad_image = '$image' WHERE ad_id = '$ad_id'";
            $conn->query($sql);
        }
    }
    include '../../function/dbconnect.php';
    $ad_id = $_SESSION["admin_id"];
    $admin = new Admin($ad_id, "", "", "", "", "", "", "", "");
    $result = $admin->searchAdmin($conn);
    $row = $result->fetch_assoc();
    $ad_email = $row["ad_email"];
    if ($ad_email != $email) {
        $admin1 = new Admin($ad_id, $name, "", "", "", $email, "", "", "");
        include '../../function/dbconnect.php';
        $result1 = $admin1->checkAdminEmail($conn);
        if ($result1->num_rows == 0) {
            include '../../function/dbconnect.php';
            if ($admin1->updateAdmin($conn) == true) {
                $_SESSION["admin_name"] = $name;
                $url = $_SERVER['HTTP_REFERER'];
                echo 'Information has been update successfully';
                exit();
            } else {
                echo 'Wow, there is a mistake';
                exit();
            }
        } else {
            echo 'This email address is already registered to another account';
            exit();
        }
    } else {
        include '../../function/dbconnect.php';
        $admin1 = new Admin($ad_id, $name, "", "", "", $email, "", "", "");
        if ($admin1->updateAdmin($conn) == true) {
            $_SESSION["admin_name"] = $name;
            $url = $_SERVER['HTTP_REFERER'];
            echo 'Information has been update successfully';
            exit();
        } else {
            echo 'Wow, there is a mistake';
            exit();
        }
    }
}

if (isset($_POST["profileCurrentPassword"])) {
    include '../../function/dbconnect.php';
    include_once '../../model/admin_data.php';
    $cur_pass = $_POST["profileCurrentPassword"];
    $new_pass = $_POST["profileNewPassword"];
    $ad_id = $_SESSION["admin_id"];
    $admin = new Admin($ad_id, "", "", "", "", "", "", "", "");
    $result = $admin->searchAdmin($conn);
    $row = $result->fetch_assoc();
    $ad_pass = $row["ad_password"];
    $ad_email = $row["ad_email"];
    if ($ad_pass == sha1($cur_pass)) {
        include '../../function/dbconnect.php';
        $admin = new Admin("", "", "", "", "", $ad_email, $new_pass, "", "");
        if ($admin->updateAdminPassword($conn) == true) {
            echo 'Password has been change successfully';
        } else {
            echo 'Wow, there is a mistake';
        }
    } else {
        echo 'Incorrect current password';
    }
}
?>