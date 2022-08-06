<div class="header-content" id="header-content">
            <div class="header-left">
                <div class="store-name">
                    <h4>DOTA STORE</h4>
                </div>
                <div class="header-navigation">
                    <ul>
                        <li><a href="./homePage.php">HOME</a></li>
                        <li><a href="./orderHistory.php">ORDER HISTORY</a></li>
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
<script defer>
    window.onresize = function(){
        let headerDiv = document.getElementById('header-content');
        headerDiv.classList.toggle('header-toggle');
    }
</script>
