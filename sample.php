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
  <button id="click">Click Me</button>
  <div id="overlay"></div>

  <div id="content">
    <h1>hello</h1>
    <h2>World</h2>
  </div>
  <?php 
  include_once('./includes/autoLoadClassesMain.inc.php');
  $productsView = new productsView();
  var_dump($productsView->showSales());
  ?>
</body>
</html>