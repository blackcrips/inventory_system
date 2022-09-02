<?php

class LoginController extends Model
{

    public function signUp()
    {
        if (count($_POST) != 6) {
            header("LOCATION: ../signup.php");
            exit;
        }

        $postValues = $_POST;
        foreach ($postValues as $value) {
            if ($value == "") {
                header("LOCATION: ../signup.php");
                exit;
            }
        }

        if (!isset($_POST)) {
            header("LOCATION: ../signup.php");
            exit;
        }

        $firstname = htmlspecialchars($_POST['firstname']);
        $middlename = htmlspecialchars($_POST['middlename']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);


        $this->validateExistingEmail($email);
        $this->signUpUser($firstname, $middlename, $lastname, $email, $password);
    }


    public function loginData()
    {
        if ($_POST['username'] == "" || $_POST['password'] == "") {
            echo "<script>alert('Invalid username or password')</script>";
            echo "<script>window.location.href = '../index.php'</script>";
        } else {
            // $this->validateLogin($_POST['username'], $_POST['password']);
            $valUsername = $_POST['username'];
            $valPassword = $_POST['password'];
            return $this->validateLogin($valUsername,$valPassword);
            
        }
    }

    private function validateLogin($username, $password)
    {
        $valUsername = htmlentities($username);
        $valPassword = htmlentities($password);
        if($this->loginUser($valUsername, $valPassword)){
            header("Location: ../homePage.php");
            exit;
        } else {
            header("Location: ../index.php");
            exit;
        }
        
    }


    public function redirectingUser()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $serials = $this->getSessions();
        if (!isset($_SESSION['loginUser']) || !isset($_COOKIE['userLoginData'])) {
            return;
        } else {
            for ($i = 0; $i < count($serials); $i++) {
                if ($serials[$i]['PHPSESSION'] == $_SESSION['loginUser'] || $serials[$i]['COOKIESESSION'] == $_COOKIE['userLoginData']) {
                    $userLogin = $serials[$i]['username'];
                    $newSerial = $this->createSerial(62);
                    $this->updateSerial($userLogin, $newSerial, $newSerial);
                    $arrayValue = $this->getUserData($userLogin);
                    $this->createSessionLogin($arrayValue);
                    header("Location: homePage.php");
                    exit;
                }
            }
        }
    }

    public function redirectToLogin()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        
        $serials = $this->getSessions();
        if (!isset($_SESSION['loginUser']) || !isset($_COOKIE['userLoginData'])) {
            header("Location: index.php");
            exit;
        } else {
            for ($i = 0; $i < count($serials); $i++) {
                if ($serials[$i]['PHPSESSION'] == $_SESSION['loginUser'] || $serials[$i]['COOKIESESSION'] == $_COOKIE['userLoginData']) {
                    $userLogin = $serials[$i]['username'];
                    $newSerial = $this->createSerial(62);
                    $this->updateSerial($userLogin, $newSerial, $newSerial);
                    $arrayValue = $this->getUserData($userLogin);
                    $this->createSessionLogin($arrayValue);
                    return;
                }
            }
        }
    }

    public function addProducts()
    {
        if (!isset($_POST['category'])) {
            header("Location: ../index.php");
            exit;
        } else {
            $category = htmlspecialchars($_POST['category']);
            $productName = htmlspecialchars($_POST['product_name']);
            $productDescription = htmlspecialchars($_POST['product_description']);
            $productPrice = htmlspecialchars($_POST['product_price']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $storeCode = htmlspecialchars($_POST['supplier_name']);
            $supplierPrice = htmlspecialchars($_POST['supplier_price']);

            $fetchCodes = $this->getProductCode();
            $generateCode = $this->createSerial(5);
            $serialCode = '';
            $foldername = $category . "-" . $productName . "-" . $productDescription;

            foreach ($_POST as $post) {
                if ($post == '') {
                    echo "<script>alert('Plase fill up all fields!')</script>";
                    echo "<script>window.location.href ='../addProduct.php'</script>";
                    return;
                }
            }

            foreach ($fetchCodes as $value) {
                if ($value == $generateCode) {
                    continue;
                } else {
                    $serialCode = $generateCode;
                    $this->insertProductsName($category, $productName, $productDescription, $serialCode);
                    $this->insertProductPrice($serialCode, $productPrice, $supplierPrice, $quantity, $storeCode);
                        $this->uploadProductPhoto($_FILES['upload-files'],$foldername);
                    echo "<script>alert('Product Added!')</script>";
                    echo "<script>window.location.href ='../index.php'</script>";
                    return;
                }
            }
        }
    }

    protected function uploadProductPhoto($productPhotos,$foldername){
        $products = [];

        if($productPhotos['name'] != ''){
            for($i = 0; $i < count($productPhotos['name']); $i++){
                $constructProduct = array(
                    'name' => $productPhotos['name'][$i],
                    'full_path' => $productPhotos['full_path'][$i],
                    'type' => $productPhotos['type'][$i],
                    'tmp_name' => $productPhotos['tmp_name'][$i],
                    'error' => $productPhotos['error'][$i],
                    'size' => $productPhotos['size'][$i],
                    
                );
                array_push($products,$constructProduct);
            }

            $fileDestination = '../images/Products/' . $foldername . '/';
            
            for($y = 0; $y < count($products); $y++){
                if (!file_exists($fileDestination)) {
                    mkdir($fileDestination, 077, true);
                }

                $fileNewDestination = $fileDestination . "Photo" . $y . ".jpeg";
        
                move_uploaded_file($products[$y]['tmp_name'],$fileNewDestination);
            }
        } else {
            $fileDestination = '../images/products/' . $foldername . '/';

            if (!file_exists($fileDestination)) {
                mkdir($fileDestination, 077, true);
            }

            $fileNewDestination = $fileDestination . "Photo.jpeg";
            $fileTmpDestination = '../images/products/noImageAvailable.jpeg';
    
            move_uploaded_file($fileTmpDestination,$fileNewDestination);
        }
    }

    public function addSupplier()
    {
        if (!isset($_POST['supplier-name'])) {
            header("Location: ../index.php");
            exit;
        } else {
            $supplierName = htmlspecialchars($_POST['supplier-name']);
            $supplierAddress = htmlspecialchars($_POST['supplier-address']);
            $contactNo = htmlspecialchars($_POST['contact-no']);
            $secondaryNo = htmlspecialchars($_POST['secondary-no']);
            $contactPerson = htmlspecialchars($_POST['contact-person']);
            $products = htmlspecialchars($_POST['products']);

            $getSupplierCode = $this->getSupplierCode();
            $generateCode = $this->createSerial(5);
            $serialCode = '';

            foreach ($_POST as $post) {
                if ($post == '') {
                    echo "<script>alert('Plase fill up all fields!')</script>";
                    echo "<script>window.location.href ='../addSupplier.php'</script>";
                    return;
                }
            }

            if (count($getSupplierCode) == 0) {
                $serialCode = $generateCode;
                $this->insertSupplierName($serialCode, $supplierName, $supplierAddress, $contactNo, $secondaryNo, $contactPerson, $products);
                header("LOCATION: ../index.php");
                exit;
            } else {
                foreach ($getSupplierCode as $value) {
                    if ($value == $generateCode) {
                        continue;
                    } else {
                        $serialCode = $generateCode;
                        if ($this->insertSupplierName($serialCode, $supplierName, $supplierAddress, $contactNo, $secondaryNo, $contactPerson, $products) == false) {
                            echo "<script>alert('Record already exist!')</script>";
                            echo "<script>window.location.href='../addSupplier.php'</script>";
                        } else {
                            $this->insertSupplierName($serialCode, $supplierName, $supplierAddress, $contactNo, $secondaryNo, $contactPerson, $products);
                            echo "<script>alert('Added successfully!')</script>";
                            echo "<script>window.location.href ='../index.php'</script>";
                            return;
                        }
                    }
                }
            }
        }
    }

    public function addClient()
    {
        if (!isset($_POST['store-name'])) {
            header("LOCATION: ../index.php");
            exit;
        } else {
            $storeName = htmlspecialchars($_POST['store-name']);
            $contactPerson = htmlspecialchars($_POST['contact-person']);
            $contactNo = htmlspecialchars($_POST['contact-no']);
            $address = htmlspecialchars($_POST['address']);

            if (empty($storeName) || empty($contactPerson) || empty($contactNo) || empty($address)) {
                echo "<script>alert('Please fill up all field!')</script>";
                echo "<script>window.location.href='../index.php'</script>";
            } else {
                $this->insertClientDetails($storeName, $contactPerson, $contactNo, $address);
            }
        }
    }

    public function getContactNumbers()
    {
        if (!isset($_POST['request-status'])) {
            header("LOCATION: ../index.php");
            exit;
        } else {
            $contactNo = htmlspecialchars($_POST['request-status']);
            $contactNumbers = $this->getAllContactNumbers($contactNo);
            exit(json_encode($contactNumbers));
        }
    }

    public function getExistingClient()
    {
        if (!isset($_POST['request-status'])) {
            header("LOCATION: ../index.php");
            exit;
        } else {
        }

        $searchValue = htmlspecialchars($_POST['request-status']);

        return $this->existingClient($searchValue);
    }

    public function createSessionOrder(){
        if(!isset($_POST['client-id'])){
            header("Location: ./index.php");
            exit;
        } else {
            $_SESSION['client-id'] = htmlspecialchars($_POST['client-id']);
            header("LOCATION: ../createOrder.php");
            exit;
        }
    }

    public function logout()
    {
        if (!isset($_POST['logout'])) {
            header("Location: ./index.php");
            exit;
        } else {
            $this->logoutUser($_SESSION['loginUser']['email']);
            $this->unsetSESSIONS();
            header("LOCATION: ../index.php");
            exit;
        }
    }

    private function createOrderID(){
        $serialTemplate = "1234567890";
        $serial = '';

        for ($i = 0; $i < 12; $i++) {
            $index = rand(0, strlen($serialTemplate) - 1);
            $serial .= $serialTemplate[$index];
        }

        return $serial;
    }

    private function checkOrderId(){
        $orderId = $this->createOrderID();
        while($this->getOrderId($orderId) > 0){
        $orderId = $this->createOrderID();
        }

        return $orderId;
    }

    public function preventDoubleOrder(){

        if(!isset($_POST['client-id'])){
                header("Location: ./index.php");
                exit;
        }
    }

    public function createOrder(){
        if(!isset($_POST['request-status'])){
            header("Location: ../index.php");
            exit;
        } else {
            
            $orderId = $this->checkOrderId();    
            
            $status = '';

            foreach($_POST['request-status'] as $value){
            $productName = htmlspecialchars($value['product-name']);
            $productCode = htmlspecialchars($value['product-code']);
            $quantity = htmlspecialchars($value['quantity']);
            $price = htmlspecialchars($value['price']);
            $clientId = htmlspecialchars($value['client-id']);
            $orderStatus = "pending";

                if($this->insertOrders($orderId,$productName,$quantity,$price,$productCode,$clientId,$orderStatus)){
                    $this->setNewQuantity($productCode,$quantity);
                    unset($_SESSION['client-id']);
                    $_SESSION['client-id'] = null;
                    $status = true;
                } else {
                    $status = false;
                }

            }
            

            exit(json_encode($status));

        }
    }

    public function changeOrderStatus(){
        if(!isset($_POST['order-id'])){
            header("LOCATION: ../homePage.php");
            exit;
        } else {
            $orderId = htmlspecialchars($_POST['order-id']);
            return $this->changeStutusOfOrder($orderId);
        }   


    }

    public function editOrder(){
        
        if(!isset($_POST['category'])){
            header("LOCATION: ../index.php");
            exit;
        } else {
            $category = htmlspecialchars($_POST['category']);
            $productName = htmlspecialchars($_POST['product-name']);
            $productDescription = htmlspecialchars($_POST['product-description']);
            $supplierPrice = htmlspecialchars($_POST['supplier-price']);
            $retailPrice = htmlspecialchars($_POST['retail-price']);
            $resellerPrice = htmlspecialchars($_POST['reseller-price']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $productCode = htmlspecialchars($_POST['product-code']);

            $this->updateOrder($category,$productName,$productDescription,$supplierPrice,$retailPrice,$resellerPrice,$quantity,$productCode);

            
            echo "<script>alert('Product records successfully updated')</script>";
            echo "<script>window.location.href = '../editProducts.php'</script>";

        }
        
    }

    public function deleteOrder(){
        if(!isset($_POST['order-id'])){
            header("LOCATION: ../homePage.php");
            exit;
        }

        $oderId = htmlspecialchars($_POST['order-id']);
        exit(json_encode($this->deleteOrderHistory($oderId)));
    }

    public function deleteProduct(){
        if(!isset($_POST['product-code'])){
            header("LOCATION: ../homePage.php");
            exit;
        }

        $productCode = htmlspecialchars($_POST['product-code']);
        return $this->deleteSingleProduct($productCode);
    }
    
    public function getImagesFolderNames()
    {
        
        if(!isset($_POST['folder-name'])){
            header("Location: ../createOrder.php");
            exit();
        }
        
        $folderName = htmlspecialchars($_POST['folder-name']);
        $path = "../images/products/";
        $files = scandir($path);

        for($i = 0; $i < count($files);$i++)
        {
            $fileFolderName = array_diff(scandir($path . $folderName),array('.','..'));
            if($files[$i] == $folderName){
                $sampleFiles = array
                (
                    'folder-name' => $files[$i],
                    'photo-count' => count($fileFolderName)
                );
                exit(json_encode($sampleFiles));
            }
        }
    }

    






































    protected function unsetSESSIONS()
    {
        if (isset($_SESSION)) {
            session_unset();
        }

        if (isset($_COOKIE['userLoginData'])) {
            unset($_COOKIE['userLoginData']);
            setcookie('userLoginData', '', time() - 3600, '/'); // empty value and old timestamp
        }
    }

    
}
