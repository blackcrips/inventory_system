<?php
include_once("./includes/autoLoadClassesMain.inc.php");
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
    
    <link rel="stylesheet" href="./css/header.css" class="rel">
    <link rel="stylesheet" href="./css/editProducts.css" class="rel">
    <title>Edit Products</title>
</head>
<body>
    <?php include_once("./header.php") ?>
    

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-changes">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="container-table">
        <table class="table active table-bordered table-striped table-hover" id="data-table">
            <thead>
                <tr>
                    <td>Category</td>
                    <td>Product name</td>
                    <td>Product description</td>
                    <td>Product code</td>
                    <td>Supplier price</td>
                    <td>Retail price</td>
                    <td>Reseller price</td>
                    <td>Quantity</td>
                    <td>Store name</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productsView->getProductsToEdit() as $value) :?>
                    <tr>
                        <td><?php echo $value['category']; ?></td>
                        <td><?php echo $value['product_name']; ?></td>
                        <td><?php echo $value['product_description']; ?></td>
                        <td><?php echo $value['product_code']; ?></td>
                        <td><?php echo $value['supplier_price']; ?></td>
                        <td><?php echo $value['price']; ?></td>
                        <td><?php echo $value['reseller_price']; ?></td>
                        <td><?php echo $value['quantity']; ?></td>
                        <td><?php echo $value['supplier_name']; ?></td>
                        <td>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                                <button class="btn btn-danger" id="delete">Delete</button>
                                <input type="hidden" id="product-code" value="<?php echo $value['product_code']; ?>">
                            </div>
                        </td>
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
    <script src="./js/editProducts.js"></script>
</body>
</html>