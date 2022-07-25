<?php
include_once('./includes/autoLoadClassesMain.inc.php');
session_start();
$productsView = new productsView();
$loginController = new LoginController();
$loginController->redirectToLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/createOrder.css">
    <title>Create Order</title>
</head>

<body>
    <div class="container-body">
        <div class="container-order-buttons">
            <div class="main-category">
                <?php foreach ($productsView->showCategories() as $values) : ?>
                    <div class="category-button" data-main-buttons id=""><?php echo $values; ?></div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="container-data">
            <div class="container-data-content">
                <div class="details">
                <marquee direction="Left" class="message">Congratulations on our sales, may the lord guide us all day to have more sales!</marquee>
                    <div class="store-name"><?php echo $productsView->checkCredentials()['store_name']; ?></div>
                    <div class="contact-person"><?php echo $productsView->checkCredentials()['contact_person']; ?></div>
                    <div class="contact-no"><?php echo $productsView->checkCredentials()['contact_no']; ?></div>
                    <div class="address"><?php echo $productsView->checkCredentials()['address']; ?></div>
                    <div hidden id="client-id"><?php echo $productsView->checkCredentials()['id']; ?></div>
                </div>
                <hr>
                <hr>
                <div class="container-orders" id="container-orders">
                    <div class="reminder">
                        Your orders will appear here
                    </div>

                    <div class="orders" id="orders">

                    </div>
                    <div class="container-total-price" id="container-total-price">
                        <div class="total-text">TOTAL</div>
                        <div class="price">
                            PHP <span id="total-price">0.00</span>
                        </div>
                    </div>
                    <div class="action-button">
                        <button id="cancel">Cancel</button>
                        <button id="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/createOrder.js"></script>

</body>

</html>