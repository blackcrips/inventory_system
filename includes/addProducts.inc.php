<?php

include_once('./autoLoadClasses.inc.php');
session_start();
$loginController = new LoginController();
$loginController->addProducts();

if (isset($_POST['cancel'])) {
    header("Location: ../login.php");
}
