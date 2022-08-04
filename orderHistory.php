<?php
include_once('./includes/autoLoadClassesMain.inc.php');
$productsView = new ProductsView();
// $productsView->viewOrderHistory();

// echo "<pre>";
// var_dump($productsView->viewOrderHistory());

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="./css/header.css" class="rel">
    <link rel="stylesheet" href="./css/orderHistory.css" class="rel">
    <title>Order History</title>
</head>
<body>
  <?php include_once("header.php"); ?>  
  <div class="container">
    <div class="title">
        Order History
    </div>
    <div class="container-table">
        <table class="table active table-bordered table-striped table-hover" id="data-table">
            <thead>
                <tr>
                    <td>Order id</td>
                    <td>Store name</td>
                    <td>Contact person</td>
                    <td>Contact number</td>
                    <td>Address</td>
                    <td>Order date</td>
                    <td>Status</td>
                    <!-- <td>Action</td> -->
                </tr>
            </thead>
            <tbody>
            <?php foreach($productsView->viewOrderHistory() as $value) :?>
                    <tr class="container-order-id">
                        <td class="order-id"><?php echo $value['order_id']; ?></td>
                        <td><?php echo $value['store_name']; ?></td>
                        <td><?php echo $value['contact_person']; ?></td>
                        <td><?php echo $value['contact_no']; ?></td>
                        <td><?php echo $value['address']; ?></td>
                        <td><?php echo $value['order_date']; ?></td>
                        <td><?php echo $value['status']; ?></td>
                        <!-- <td>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>                                
                            </div>
                        </td> -->
                    </tr>
                <?php endforeach;?>

            </tbody>
        </table>
    </div>
</div>





<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/orderHistory.js"></script>
</body>
</html>