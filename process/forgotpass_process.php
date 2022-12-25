<?php

include '../function/dbconnect.php';
include '../model/customer_data.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../function/PHPMailer/PHPMailer.php';
require '../function/PHPMailer/SMTP.php';
require '../function/PHPMailer/Exception.php';

if (isset($_GET["action"]) && $_GET["action"] == "forgot") {
    $customerEmail = $_GET["email"];
    $customer = new Customer("", "", "", "", $customerEmail, "", "");
    $resultCus = $customer->checkCustomerEmail($conn);
    if ($resultCus->num_rows == 1) {
        include '../function/dbconnect.php';
        include_once '../model/libkresetpassword_data.php';
        $linkReset = new LinkReset($customerEmail, "", "");
        $resultEmail = $linkReset->searchEmail($conn);
        if ($resultEmail->num_rows == 0) {
            include '../function/dbconnect.php';
            $resutlInsert = $linkReset->insertEmail($conn);
        }
        $token = md5($customerEmail) . rand(10, 9999);
        $expFormat = mktime(
                date("H"), date("i") + 5, date("s"), date("m"), date("d"), date("Y")
        );
        
        $expDate = date("Y-m-d H:i:s", $expFormat);
        
        $linkReset->setToken($token);
        $linkReset->setExpireDate($expDate);
        include '../function/dbconnect.php';
        $resutlUpdateLink = $linkReset->updateLinkReret($conn);
        
        $link = "<a href='http://localhost:1000/Biolife/setpassword.php?key=" . $customerEmail . "&token=" . $token . "'>Click To Reset password</a>";
        
        $mail = new PHPMailer(true);
        $mail->CharSet = "utf-8";
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;

        $mail->Username = "dttanha20131@cusc.ctu.edu.vn";
        $mail->Password = "trucanhdao17091999";
        $mail->From = "dttanha20131@cusc.ctu.edu.vn";
        $mail->FromName = "Biolife Store";

        $mail->addAddress($customerEmail);

        $mail->isHTML(true);
        $mail->Subject = "Reset Password";
        $mail->Body = 'Click On This Link to Reset Password: ' . $link . '';

        try {
            $mail->send();
            echo 'Success';
            exit();
        } catch (Exception $ex) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo $resultCus->num_rows;
        exit();
    }
}