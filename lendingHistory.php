<?php
include_once('./includes/autoLoadClassesMain.inc.php');
$productsView = new ProductsView();
$loginController = new LoginController();
$loginController->addInterest();
// var_dump($loginController->addInterest());


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
    <link rel="stylesheet" href="./css/lendingHistory.css" class="rel">
    <title>Order History</title>
</head>
<body>
  <?php include_once("header.php"); ?>  

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
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
    <div class="title">
        Order History
    </div>
    <div class="container-table">
        <table class="table active table-bordered table-striped table-hover" id="data-table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Borrower name</td>
                    <td>Borrower date</td>
                    <td>Borrowed amount</td>
                    <td>Interest</td>
                    <td>Due date</td>
                    <td>Amount to pay</td>
                    <td>Total w/ interest</td>
                    <td>Status</td>
                    <td>Amount paid</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($productsView->viewLendingHistory() as $value) :?>
                    <tr class="container-order-id">
                        <td class="order-id"><?php echo $value['id']; ?></td>
                        <td><?php echo $value['borrower_name']; ?></td>
                        <td><?php echo $value['borrow_date']; ?></td>
                        <td><?php echo $value['borrow_amount']; ?></td>
                        <td><?php echo $value['interest']; ?></td>
                        <td><?php echo $value['due_date']; ?></td>
                        <td><?php echo $value['amount_to_pay']; ?></td>
                        <td><?php echo $value['total_with_interest']; ?></td>
                        <td class="status"><?php echo $value['status']; ?></td>
                        <td class="payment"><?php echo $value['amount_paid']; ?></td>
                        <td class="nth-td">
                          <?php 
                          if($value['status'] == "paid"){
                            echo "<button class='edit btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>View</button>";
                          } else {
                            echo "<button class='edit btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button>
                            ";
                          }
                          ?>
                          <button class="btn btn-danger delete">Delete</button>
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
    <script src="./js/lendingHistory.js"></script>
</body>
</html>