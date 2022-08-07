<?php
include_once('./autoLoadClasses.inc.php');
date_default_timezone_set('Asia/Manila');

$loginController = new LoginController();
$loginController->loginData();

if (!isset($_POST['username']) && !isset($_POST['password'])) {
    echo "<script>alert('Invalid username or password')</script>";
    echo "<script>window.location.href = '../homePage.php'</script>";
}
