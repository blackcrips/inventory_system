<?php
include_once('./includes/autoLoadClassesMain.inc.php');
$loginController = new LoginController();
$loginController->redirectToLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/addSupplier.css">
    <title>Add new supplier</title>
</head>

<body>

<?php include_once('./header.php'); ?>
    <div class="container-body">
        <form action="./includes/addSupplier.inc.php" method="POST">
            <table>
                <caption>
                    <label>Add new supplier</label>
                </caption>
                <tbody>
                    <tr>
                        <td>
                            <label for="supplier-name">Supplier name: </label>
                        </td>
                        <td>
                            <input type="text" name="supplier-name" id="supplier-name">
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="supplier-address">Supplier address: </label>
                        </td>
                        <td>
                            <input type="text" name="supplier-address" id="supplier-address">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="contact-no">Contact no.: </label>
                        </td>
                        <td>
                            <input type="text" name="contact-no" id="contact-no">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="secondary-no">Secondary no.: </label>
                        </td>
                        <td>
                            <input type="text" name="secondary-no" id="secondary-no">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="contact-person">Contact person: </label>
                        </td>
                        <td>
                            <input type="text" name="contact-person" id="contact-person">
                        </td>
                    </tr>
                    <tr>
                        <td class="products">
                            <label for="products">Products: </label>
                        </td>
                        <td>
                            <textarea type="text" name="products" id="products"></textarea>
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