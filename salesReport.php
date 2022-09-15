<?php 
include_once("./includes/autoLoadClassesMain.inc.php");
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/salesReport.css">
    <title>Sales Report</title>
</head>
<body>
    <?php 
        include_once("header.php");
    ?>

<div class="container">
    <div class="title">
        PRODUCTS SALES VIEW
    </div>
    <div class="container-table">
        <table class="table active table-bordered table-striped table-hover" id="data-table">
            <thead>
                <tr>
                    <td>Product name</td>
                    <td>Category</td>
                    <td>Product code</td>
                    <td>Product description</td>
                    <td>Price</td>
                    <td>Supplier name</td>
                    <td>Total sales</td>
                    <td>Sold count</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($productsView->viewSalesReport() as $value) :?>
                    <tr class="container-order-id">
                        <td><?php echo $value['product_name']; ?></td>
                        <td><?php echo $value['category']; ?></td>
                        <td><?php echo $value['product_code']; ?></td>
                        <td><?php echo $value['product_description']; ?></td>
                        <td><?php echo $value['price']; ?></td>
                        <td><?php echo $value['supplier_name']; ?></td>
                        <td><?php echo $value['total_sale']; ?></td>
                        <td><?php echo $value['total_count']; ?></td>
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
  <script>
    $(document).ready(function(){
        $('#data-table').DataTable(
            {
                "serverSide": false,
            }
        );
    });
  </script>
</body>
</html>