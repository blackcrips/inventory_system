<?php
include_once('./includes/autoLoadClassesMain.inc.php');
$loginController = new LoginController();
$loginController->redirectToLogin();

?>
<!DOCTYPE html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="./css/miscellaneousHistory.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Document</title>
</head>
<body>
<?php include_once('./header.php'); ?>
<div class="container">
    <div class="title">
        MISCELLENEOUS HISTORY
    </div>
    <div class="container-table">
        <table class="table active table-bordered table-striped table-hover" id="data-table">
            <thead>
                <tr>
                    <td>Item</td>
                    <td>Product price</td>
                    <td>Quantity</td>
                    <td>Service fee</td>
                    <td>Remarks</td>
                    <td>Purchase date</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($productsView->showMiscellaneous() as $value) :?>
                    <tr>
                        <td><?php echo $value['item']; ?></td>
                        <td><?php echo $value['product_price']; ?></td>
                        <td><?php echo $value['quantity']; ?></td>
                        <td><?php echo $value['service_fee']; ?></td>
                        <td><?php echo $value['remarks']; ?></td>
                        <td><?php echo $value['added_at']; ?></td>
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
        $('#data-table').DataTable();
    });
  </script>
</body>
</html>