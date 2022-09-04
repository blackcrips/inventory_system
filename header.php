<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="navigation">
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer>
    window.onresize = function(){
        let headerDiv = document.getElementById('header-content');
        headerDiv.classList.toggle('header-toggle');
    }

    $('.store-name').on('click', () => {
        $('.logo').fadeIn(1000).delay(2000).fadeOut("slow");

    });
</script>
