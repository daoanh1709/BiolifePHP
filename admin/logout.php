<?php

session_start();

// If you want to destroy only users login session
unset($_SESSION['admin_name']);
unset($_SESSION["admin_id"]);
header("location:signin.php");

