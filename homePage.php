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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="./css/homePage.css">
    <link rel="stylesheet" href="./css/header.css">
    <script src="./js/header.js" defer></script>
    <title>Inventory System</title>
</head>

<body>
    <div class="container-header" id="container">
    <?php include_once('header.php'); ?>
    <div class="container-join">
            <div class="container-navigation" id="container-navigation">
                <div class="navigation-button" id="navigation-button">
                    <span>Reports &#8594;</span>
                </div>
                <div class="container-content" id="container-content">
                    <div class="container-reports">
                        <a href="./salesReport.php">Sales report</a>
                    </div>
                    <div class="container-reports">
                        Product inventory
                    </div>
                    <div class="container-reports">
                        Customer details
                    </div>
                </div>
            </div>
            <div class="container-body" id="container-body">
                <div class="title">
                    <h1>Inventory System</h1>
                </div>
                <div class="container-body-content">
                    <div class="body-left" id="body-left">
                        <div class="title-group">
                            <label>PRODUCTS</label>
                        </div>
                        <div class="container-table">
                            <div class="container" data-tab-content id="table-details-fresh">
                                <div class="category">
                                    <select name="category" id="category">
                                        <option selected value="All">All</option>
                                        <option value="Shampoo">Shampoo</option>
                                        <option value="Conditioner">Conditioner</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div>
                                        <table class="table active table-bordered table-striped table-hover" id="data-table">
                                            <thead>
                                                <tr id="table-size">
                                                    <th>Product name</th>
                                                    <th>Description</th>
                                                    <th>Product code</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body-right">
                        <div class="first-container">
                            <div class="title-group">
                                <label>Create new order</label>
                            </div>
                            <div class="first-content" id="add-new-client">
                                &#x2b; Add new
                            </div>
                        </div>
                        <div class="first-container">
                            <div class="title-group">
                                <label>Order history</label>
                            </div>
                            <div class="second-content">
                                <table>
                                    <th>
                                        <thead>
                                            <tr>
                                                <th>Store name</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($productsView->getNewClients() as $value): ?>
                                            <tr>
                                                <td>
                                                    <button id='button-pending' class='button-pending'> <?php echo $value['storeName'] ?></button>
                                                    <button id='order-id' hidden><?php echo $value['orderId'] ?></button>
                                                </td>
                                                
                                                <td><?php echo $value['status'] ?></td>
                                               
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/homePage.js"></script>
</body>

</html>