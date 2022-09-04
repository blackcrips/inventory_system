<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/sample.css">
  <title>Document</title>
</head>
<body>
  <div class="menu-bar">
    <div class="store-name">
      <img src="./images/Store_name.png" alt="Cheap n' Sulit" height="50px" width="200px">
    </div>

    <ul>
      <li class="active"><a href="homePage.php">HOME</a></li>
      <li>HISTORY
        <div class="sub-menu-1">
          <ul>
            <li><a href="lending.php">LENDING HISTORY</a><i class="fa fa-angle-right"></i></li>
            <li><a href="orderHistory.php">ORDER HISTORY</a><i class="fa fa-angle-right"></i></li>
          </ul>
        </div>
      </li>
      <li>LENDING
        <div class="sub-menu-1">
            <ul>
              <li><a href="lending.php">ADD NEW</a><i class="fa fa-angle-right"></i></li>
              <li><a href="editLending.php">EDIT RECORD</a><i class="fa fa-angle-right"></i></li>
            </ul>
          </div>
      </li>
      <li>ADD/EDIT
      <div class="sub-menu-1">
            <ul>
              <li><a href="addProduct.php">ADD PRODUCT</a><i class="fa fa-angle-right"></i></li>
              <li><a href="editProduct.php">EDIT PRODUCT</a><i class="fa fa-angle-right"></i></li>
              <li><a href="addSupplier.php">ADD SUPPLIER</a><i class="fa fa-angle-right"></i></li>
            </ul>
          </div>
      </li>
    </ul>
    <div class="header-right">
      <h3>Menu</h3>
      <form action="./includes/logout.inc.php" method="POST">
          <button type="submit" name="logout">Logout</button>
      </form>
    </div>
    
    <div class="logo">
            <div class="logo-content"></div>
        </div>
  </div>

</body>
</html>