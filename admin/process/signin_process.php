<?php
ob_start();
session_start();

if (isset($_GET['action']) && $_GET['action'] == "login") {
    include '../../function/dbconnect.php';
    include_once '../../model/admin_data.php';
    $email = $_GET["email"];
    $password = $_GET["pass"];
    $admin = new Admin("", "", "", "", "", $email, $password, "", "");
    $result = $admin->checkSignIn($conn);
    $toRec = $result->num_rows;
    if ($toRec == 1) {
        if (isset($_GET["check"]) && $_GET["check"] == "checked") {
            setcookie('admin_login', $email, time() + 60 * 60 * 1, '/Biolife');
            setcookie('admin_pwd', $password, time() + 60 * 60 * 1, '/Biolife');
        } else if (isset($_GET["check"]) && $_GET["check"] == "") {
            if (isset($_COOKIE["admin_login"])) {
                setcookie('admin_login', '', 0, '/Biolife');
            }
            if (isset($_COOKIE["admin_pwd"])) {
                setcookie('admin_pwd', '', 0, '/Biolife');
            }
        }
        $row = $result->fetch_assoc();
        $ad_name = $row["ad_name"];
        $ad_id = $row["ad_id"];
        $_SESSION["admin_name"] = $ad_name;
        $_SESSION["admin_id"] = $ad_id;
        $_SESSION["last_login"] = time();
        echo 'Success';
        exit();
    } else {
        if (isset($_GET["check"]) && $_GET["check"] == "checked") {
            setcookie('admin_login', '');
            setcookie('admin_pwd', '');
        }
        echo 'Fail';
        exit();
    }
}
?>