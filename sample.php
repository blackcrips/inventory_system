<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/sample.css">
  <title>Document</title>
</head>
<body>
  <?php 
  include_once('./includes/autoLoadClassesMain.inc.php');
  $productsView = new productsView();
  echo '<pre>';
  var_dump($productsView->viewSalesReport());
  ?>
</body>
</html>