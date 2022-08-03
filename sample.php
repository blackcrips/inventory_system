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


    <div class="container-edit">
        <form action="./includes/editProducts.inc.php" method="POST"></form>
        <table>
            <tbody>
                <tr>
                    <td>Category:</td>
                    <td><input type="text" value="Shampoo"></td>
                </tr>
                <tr>
                    <td>Produt name:</td>
                    <td><input type="text" value="1"></td>
                </tr>
                <tr>
                    <td>Product description:</td>
                    <td><input type="text" value="1"></td>
                </tr>
                <tr>
                    <td>Supplier price:</td>
                    <td><input type="text" value="1"></td>
                </tr>
                <tr>
                    <td>Retail price:</td>
                    <td><input type="text" value="1"></td>
                </tr>
                <tr>
                    <td>Reseller price:</td>
                    <td><input type="text" value="1"></td>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td><input type="text" value="1"></td>
                </tr>
                <tr>
                    <td>Store name:</td>
                    <td><input type="text" value="Shampoo"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>