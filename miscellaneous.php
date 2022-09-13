<?php
include_once('./includes/autoLoadClassesMain.inc.php');
$loginController = new LoginController();
$loginController->redirectToLogin();
$productsView = new ProductsView();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/miscellaneous.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Add miscellaneous</title>
</head>

<body>

<?php include_once('./header.php'); ?>
    <div class="container-body">
        <form action="./includes/miscellaneous.inc.php" method="POST" enctype="multipart/form-data">
            <table>
                <caption>
                    <label>Miscellaneous items</label>
                </caption>
                <tbody>
                    <tr>
                        <td>
                            <label for="item">Item name: </label>
                        </td>
                        <td>
                            <input type="text" name="item" id="item">
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="product-price">Product price: </label>
                        </td>
                        <td>
                            <div class="container-content">
                                <input type="text" name="product-price" id="product-price">
                                <label for="quantity">Quantity: </label>
                                <input type="text" name="quantity" id="quantity">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="service-fee">Service fee: </label>
                        </td>
                        <td>
                            <input type="text" name="service-fee" id="service-fee" value="0">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="remarks">Remarks: </label>
                        </td>
                        <td>
                            <textarea name="remarks" id="remarks"></textarea>
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/miscellaneous.js"></script>
</body>

</html>