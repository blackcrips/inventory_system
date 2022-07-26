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
            die();
        } else {
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
            $serviceFee = htmlspecialchars($_POST['service_fee']);

            $fetchCodes = $this->getProductCode();
            $generateCode = $this->createSerial(5);
            $serialCode = '';
            $foldername = $category . "-" . $productName . "-" . $productDescription;

            foreach ($_POST as $post) {
                if ($post == '') {
                    echo "<script>alert('Plase fill up all fields!')</script>";
                    echo "<script>window.location.href ='../addProduct.php'</script>";
                    die();
                }
            }
            if($fetchCodes == 0){
                $serialCode = $generateCode;
                $this->uploadProductPhoto($_FILES['upload-files'],$foldername);
                $this->insertProductsName($category, $productName, $productDescription,$serviceFee, $serialCode);
                $this->insertProductPrice($serialCode, $productPrice, $supplierPrice, $quantity, $storeCode);
                echo "<script>alert('Product Added!')</script>";
                echo "<script>window.location.href ='../addProduct.php'</script>";
                die();
            } else {
                foreach ($fetchCodes as $value) {
                    if ($value == $generateCode) {
                        continue;
                    } elseif($value == ''){
                        continue;
                    } else {
                        $serialCode = $generateCode;
                        $this->uploadProductPhoto($_FILES['upload-files'],$foldername);
                        $this->insertProductsName($category, $productName, $productDescription,$serviceFee, $serialCode);
                        $this->insertProductPrice($serialCode, $productPrice, $supplierPrice, $quantity, $storeCode);
                        echo "<script>alert('Product Added!')</script>";
                        echo "<script>window.location.href ='../addProduct.php'</script>";
                        die();
                    }
                }
            }
        }
    }

    protected function uploadProductPhoto($productPhotos,$foldername){
        $products = [];

       

        if($productPhotos['name'][0] == ''){
            $this->uploadEmptyPhoto($foldername);
            
        } else {
            $this->validateUploadFile($productPhotos);

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
                $fileTmpDestination = $products[$y]['tmp_name'];

                    move_uploaded_file($fileTmpDestination,$fileNewDestination);
            }
        }
    }

    private function uploadEmptyPhoto($foldername)
    {
        $fileDestination = '../images/products/' . $foldername . '/';

            if (!file_exists($fileDestination)) {
                mkdir($fileDestination, 077, true);
            }

            $fileNewDestination = $fileDestination . "Photo0.jpeg";
            $fileTmpDestination = '../images/products/noImageAvailable.jpg';
    
            copy($fileTmpDestination,$fileNewDestination);
    }

    private function validateUploadFile($productPhotos)
    {
        $imgType = explode('/', $productPhotos["type"][0]);
        $fileExt = $imgType[1];

        $approvedExt = ['jpg','jpeg','png'];

        if($imgType[0] == 'image'){
            if(!array_search($fileExt,$approvedExt)){
                echo "<script>alert('Invalid file upload!')</script>";
                echo "<script>window.location.href ='../addProduct.php'</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid file upload!')</script>";
            echo "<script>window.location.href ='../addProduct.php'</script>";
            exit();
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
                    die();
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
                            die();
                        } else {
                            $this->insertSupplierName($serialCode, $supplierName, $supplierAddress, $contactNo, $secondaryNo, $contactPerson, $products);
                            echo "<script>alert('Added successfully!')</script>";
                            echo "<script>window.location.href ='../index.php'</script>";
                            die();
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
                die();
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
            $remarks = htmlspecialchars($value['remarks']);
            $orderStatus = "pending";

                if($this->insertOrders($orderId,$productName,$quantity,$price,$productCode,$clientId,$remarks,$orderStatus)){
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
            $this->changeStatusOfOrder($orderId);
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
            die();

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

    public function addNewBorrowMoney()
    {
        if(!isset($_POST['borrower-name'])){
            header("Location: ../homePage.php");
            exit();
        }

        foreach ($_POST as $key => $value) {
            if($value == ''){
                echo "<script>alert('Please check all fields')</script>";
                echo "<script>window.location.href = '../lending.php'</script>";
            die();
            }
        }

        $borrowerName = htmlspecialchars($_POST['borrower-name']);
        $dateBorrowed = htmlspecialchars($_POST['date-borrowed']);
        $borrowedAmount = htmlspecialchars($_POST['borrowed-amount']);
        $status = 'active';

        
        $createDate = date_create($dateBorrowed);
        
        $dueDate = date_add($createDate, date_interval_create_from_date_string('30 days'));

        
        if($this->insertBorrowRecord($borrowerName,$dateBorrowed,$borrowedAmount,$dueDate->format('Y-m-d'),$status)){
            echo "<script>alert('Record added')</script>";
            echo "<script>window.location.href = '../lending.php'</script>";
            die();
        } else {
            echo "<script>alert('Error server! Contact your admin.')</script>";
            echo "<script>window.location.href = '../lending.php'</script>";
            die();
        }

        
    }

    public function deleteBorrowRecord()
    {
        if(!isset($_POST['request-id'])){
            header("Location: ../lendingHistory.php");
            exit();
        }

        $id = htmlspecialchars($_POST['request-id']);

        $this->deleteBorrow($id);
    }

    public function saveLendingChanges()
    {
        if(!isset($_POST['order-id'])){
            header("Location: ../lendingHistory.php");
        }

        $borrowerName = htmlspecialchars($_POST['borrower-name']);
        $borrowDate = htmlspecialchars($_POST['borrow-date']);
        $totalBalance = htmlspecialchars($_POST['total-balance']);
        $orderId = htmlspecialchars($_POST['order-id']);
        $id = explode(' ', $orderId);
        $amountPaid = htmlspecialchars($_POST['amount-paid']);
        $amountTopay = htmlspecialchars($_POST['amount-to-pay']);
        
        if(!isset($_POST['order-status']) || $_POST['order-status'] == ''){
            $status = 'active';
            $amountPaid = 0;
            $action = "Edit record";
            $history = "Change to: " . $borrowerName . " Change to: " . $borrowDate;
            
            $this->lendingAction($id[0],$action,$history,$amountPaid);
            $this->lendingChanges($borrowerName,$borrowDate,$amountTopay,$status,$amountPaid,$id[0]);
        }else {
            $paymentType = htmlspecialchars($_POST['order-status']);
            if($paymentType == 'paid'){
            $action = "Paid borrow amount";
            $history = "Amount paid: " . $amountPaid;
            $this->lendingAction($id[0],$action,$history,$amountPaid);
                $this->lendingChanges($borrowerName,$borrowDate,0,$paymentType,$amountPaid,$id[0]);
            } else {
                $action = "Partial payment";
                $history = "Amount paid: " . $amountPaid;
                $newBorrow = intval($totalBalance) - intval($amountPaid);
                $newDueDate = date('Y-m-d');
                $this->lendingAction($id[0],$action,$history,$amountPaid);
                $this->lendingChanges($borrowerName,$newDueDate,$newBorrow,$paymentType,$amountPaid,$id[0]);
            }
        }
    }

    public function addInterest()
    {
        $lendingRecord = $this->showLendingHistory();

        for ($i=0; $i < count($lendingRecord); $i++) { 
            $this->checkPastDue($lendingRecord[$i]);
        }
    }

    protected function checkPastDue($singleRecord)
    {
        $dateBorrow = date_create($singleRecord['borrow_date']);
        $dateToday = date_create(date('Y-m-d'));

        $diffDate = date_diff($dateBorrow,$dateToday)->days;
        $monthsPastDue = round($diffDate/30);
        $interestRate = floor(intval($singleRecord['amount_to_pay']) * .05);

        if($monthsPastDue <= 1){
            $amountToPay =  $interestRate + intval($singleRecord['amount_to_pay']);

            return $this->staticAmountToPay($amountToPay,$interestRate,$singleRecord['id']);
        } else {
            $interest = round(.05 * $monthsPastDue,2);
            $totalInterest = $interest * $singleRecord['amount_to_pay'];
            $amountToPay = $totalInterest + $singleRecord['amount_to_pay'];
            $interestRate = floor(intval($singleRecord['amount_to_pay']) * $interest);
            
            return $this->staticAmountToPay($amountToPay,$interestRate,$singleRecord['id']);   
        }

    }

    public function lendingAction($id,$action,$history,$amountPaid)
    {
        $saveId = $id;
        $saveAction = $action;
        $saveHistory = $history;
        $saveAmount = $amountPaid;

        $this->saveLendingAction($saveId,$saveAction,$saveHistory,$saveAmount);
    }

    public function miscellaneousItem()
    {
        if(!isset($_POST['item'])){
            header("Location: ../miscellaneous.php");
            exit();
        }

        foreach($_POST as $post){
            if($post == ''){
                echo "<script>alert('Please fill up all fields!')</script>";
                echo "<script>window.location.href = '../miscellaneous.php'</script>";
                exit();
            }

        }

        $item = htmlspecialchars($_POST['item']);
        $productPrice = htmlspecialchars($_POST['product-price']);
        $quantity = htmlspecialchars($_POST['quantity']);
        $serviceFee = htmlspecialchars($_POST['service-fee']);
        $remarks = htmlspecialchars($_POST['remarks']);

        if(!$this->addMiscellaneous($item,$productPrice,$quantity,$serviceFee,$remarks)){
            echo "<script>alert('Error uploading')</script>";
            echo "<script>window.location.href = '../miscellaneous.php'</script>";
            die();
        } else {
            echo "<script>alert('Item added')</script>";
            echo "<script>window.location.href = '../miscellaneous.php'</script>";
            die();
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
