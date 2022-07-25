<?php
include_once('./includes/autoLoadClassesMain.inc.php');
session_start();
$loginController = new LoginController();
$loginController->redirectToLogin();
$productsView = new productsView();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/addProduct.css">
    <title>Add new product</title>
</head>

<body>
    <div class="container-body">
        <form action="./includes/addProducts.inc.php" method="POST">
            <table>
                <caption>
                    <label>Add new product</label>
                </caption>
                <tbody>
                    <tr>
                        <td>
                            <label for="category">Category: </label>
                        </td>
                        <td>
                            <input type="text" name="category" id="category">
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="product_name">Product name: </label>
                        </td>
                        <td>
                            <input type="text" name="product_name" id="product_name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="product_description">Product description: </label>
                        </td>
                        <td>
                            <input type="text" name="product_description" id="product_description">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="product_price">Product price: </label>
                        </td>
                        <td>
                            <div class="container-content">
                                <input type="text" name="product_price" id="product_price">
                                <label for="quantity">Quantity: </label>
                                <input type="text" name="quantity" id="quantity">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="reseller_price">Reseller price: </label>
                        </td>
                        <td>
                            <input type="text" name="reseller_price" id="reseller_price">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="supplier_name">Supplier name: </label>
                        </td>
                        <td>
                            <select name="supplier_name" id="supplier_name" class="supplier_name">
                                <?php foreach ($productsView->showSupplierName() as $supplier) : ?>
                                    <option value="<?php echo $supplier['store_code'] ?>"><?php echo $supplier['supplier_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="supplier_price">Supplier price: </label>
                        </td>
                        <td>
                            <input type="text" name="supplier_price" id="supplier_price">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="container-button">
                                <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</body>

</html>