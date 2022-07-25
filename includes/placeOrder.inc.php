<?php
include_once('./autoLoadClasses.inc.php');
session_start();
$loginController = new LoginController();
$loginController->createSessionOrder();