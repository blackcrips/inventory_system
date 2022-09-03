<div class="header-content" id="header-content">
            <div class="header-left">
                <div class="store-name">
                    <!-- <h4>Cheap n' Sulit</h4> -->
                    <img src="./images/Store_name.png" alt="Cheap n' Sulit" height="40px" width="200px">
                </div>
                <div class="header-navigation">
                    <ul>
                        <li><a href="./homePage.php">HOME</a></li>
                        <li><a href="./orderHistory.php">ORDER HISTORY</a></li>
                        <li class="lending"><span> LENDING </span>
                            <ul>
                                <li><a href="lending.php">ADD</a></li>
                                <li><a href="editLending.php">EDIT</a></li>
                            </ul>
                        </li>
                        <li class="add-edit"><span> ADD/EDIT </span>
                            <ul>
                                <li><a href="addproduct.php">ADD PRODUCT</a></li>
                                <li><a href="editProducts.php">EDIT PRODUCT</a></li>
                                <li><a href="./addSupplier.php">ADD SUPPLIER</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="header-right">
                <h3>Menu</h3>
                <form action="./includes/logout.inc.php" method="POST">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
        </div>
        <div class="logo">
            <div class="logo-content"></div>
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
