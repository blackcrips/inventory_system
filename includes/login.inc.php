<?php
include_once('./autoLoadClasses.inc.php');
session_start();
date_default_timezone_set('Asia/Manila');
$loginController = new LoginController();
$loginController->loginData();

if (!isset($_POST['username']) && !isset($_POST['password'])) {
    echo "<script>alert('Invalid username or password')</script>";
    echo "<script>window.location.href = '../login.php'</script>";
}
