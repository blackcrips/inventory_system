<?php

include_once('./autoLoadClasses.inc.php');
session_start();
$loginController = new LoginController();
$loginController->miscellaneousItem();

if (isset($_POST['cancel'])) {
    header("Location: ../index.php");
    exit;
}
