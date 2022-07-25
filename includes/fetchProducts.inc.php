<?php
include_once('./autoLoadClasses.inc.php');
session_start();
$productsView = new productsView();
$productsView->getRequestedProduct();
