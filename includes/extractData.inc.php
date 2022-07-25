<?php

include_once('./autoLoadClasses.inc.php');

if (!isset($_POST['request_status'])) {
    header("Location: ../login.php");
} else {
    getThisData();
}

function getThisData()
{
    $extractedData = new ProductsView();
    return $extractedData->displayAllProducts();
}
