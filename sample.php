<?php
include_once('./includes/autoLoadClassesMain.inc.php');
session_start();
$productsView = new ProductsView();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sample.css">
    <title>Document</title>
</head>

<body>


    <div class="preview-order">
        <?php 
        
        echo "<pre>";
        $arrayValue = $productsView->getNewClients();

        var_dump($arrayValue);


        ?>
        </div>
    </div>
</body>

</html>