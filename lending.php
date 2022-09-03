<?php
include_once('./includes/autoLoadClassesMain.inc.php');
$loginController = new LoginController();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/lending.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Add new product</title>
</head>

<body>

<?php include_once('./header.php'); ?>
    <div class="container-body">
        <form action="./includes/lending.inc.php" method="POST" enctype="multipart/form-data">
            <table>
                <caption>
                    <label>Borrow money</label>
                </caption>
                <tbody>
                    <tr>
                        <td>
                            <label for="borrower-name">Borrower name: </label>
                        </td>
                        <td>
                            <input type="text" name="borrower-name" id="borrower-name">
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="date-borrowed">Date borrowed: </label>
                        </td>
                        <td>
                            <input type="date" name="date-borrowed" id="date-borrowed">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="borrowed-amount">Borrowed amount: </label>
                        </td>
                        <td>
                            <input type="text" name="borrowed-amount" id="borrowed-amount">
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
    <script src="./js/addProducts.js"></script>
</body>

</html>