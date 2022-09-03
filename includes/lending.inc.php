<?php

include_once('./autoLoadClasses.inc.php');

$loginController = new LoginController();
// $loginController->addNewBorrowMoney();
var_dump($loginController->addNewBorrowMoney());