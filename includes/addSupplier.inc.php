<?php

include_once('./autoLoadClasses.inc.php');
session_start();
$loginController = new LoginController();
$loginController->addSupplier();

if (isset($_POST['cancel'])) {
    header("Location: ../index.php");
    exit;
}
