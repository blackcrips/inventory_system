<?php

class productsView extends Model
{
    public function displayAllProducts()
    {
        exit($this->getAllData());
    }

    public function showSupplierName()
    {
        $supplierName = $this->getSupplierName();
        return $supplierName;
    }

    public function showCategories()
    {
        $categories = $this->getAllCategories();

        $arrayValues = [];

        foreach ($categories as $category) {
            foreach ($category as $value) {

                $arrayValues[] = $value;
            }
        }

        $filteredArray = array_unique($arrayValues);

        return $filteredArray;
    }

    public function getRequestedProduct()
    {
        if (!isset($_POST['request-status'])) {
            header("LOCATION: ../index.php");
            exit;
        } else {
            $requestedProduct = htmlspecialchars($_POST['request-status']);
            $columnRequested = htmlspecialchars($_POST['get-column']);
            if ($columnRequested == 'product-name') {
                $fetchedProduct = $this->getProductBycategory($requestedProduct);
                $arrayValues = [];
                foreach ($fetchedProduct as $products) {
                    foreach ($products as $product) {
                        $arrayValues[] = $product;
                    }
                }
                $filteredArray = array_unique($arrayValues);

                exit(json_encode($filteredArray));
            } else if ($columnRequested == 'product-description') {
                $fetchedProduct = $this->getProductByName($requestedProduct);
                $arrayValues = [];
                foreach ($fetchedProduct as $products) {
                    foreach ($products as $product) {
                        $arrayValues[] = $product;
                    }
                }
                $filteredArray = array_unique($arrayValues);

                exit(json_encode($filteredArray));
            } else if ($columnRequested == 'product-description') {
            }
        }
    }

    public function showColumnNames()
    {
        $fetchData = $this->getColumnNames();

        $columnArray = [];
        for ($i = 0; $i < count($fetchData); $i++) {
            array_push($columnArray, $fetchData[$i]['COLUMN_NAME']);
        }

        return $fetchData;
    }

    public function showPrices()
    {
        if (!isset($_POST['category-name'])) {
            header("LOCATION: ../index.php");
            exit;
        } else {
            $category = htmlspecialchars($_POST['category-name']);
            $productName = htmlspecialchars($_POST['product-name']);
            $productDescription = htmlspecialchars($_POST['product-description']);


            $sampleValue = $this->getPrices($category, $productName, $productDescription);
            exit(json_encode($sampleValue));
        }
    }

    public function getNewClients(){
        $today = date("Y-m-d"); //set date today

        $clientId = $this->orderToday($today); // get All orders that placed today

        $orderTemplate = []; // empty array for later getting unique value
        
        for($i = 0; $i < count($clientId); $i++){                   // setting up for loop to separate order id values 
            array_push($orderTemplate,$clientId[$i]['order_id']);   // this will be use for later array_unique
        }

        $uniqueOrderId = array_unique($orderTemplate); // getting unique value of array (remove duplicates)

        $orderIdTemplate = []; // empty array for final value

        foreach($uniqueOrderId as $value) {                             // foreach loop to get client name from server
            $getOrderDetails = $this->singleOrderToday($value);

            $arrayTemplate = array(
                'orderId' => $value,
                'storeName' => $getOrderDetails['store_name'],
                'status' => $getOrderDetails['status']
            );
            array_push($orderIdTemplate,$arrayTemplate);
        }

        return $orderIdTemplate;


    }

    public function checkCredentials(){
        if(!isset($_SESSION['client-id'])){
            header("Location: ./index.php");
            exit;
        }

        $clientId = htmlspecialchars($_SESSION['client-id']);
        return $this->getClientsDetails($clientId);


    }

    public function previewOrder(){
        if(!isset($_POST['request-status'])){
            header("LOCATION: ../index.php");
            exit;
        } else {
            $orderId = htmlspecialchars($_POST['request-status']);
            $today = date("Y-m-d");
            $orderTemplate = [];

            $orderDetails = $this->getOrderDetails($orderId);
            array_push($orderTemplate,$orderDetails);

            $products = $this->getOrders($orderId,$today);

            foreach($products as $value){
                array_push($orderTemplate,$value);
            }
            array_push($orderTemplate,$orderId);
            exit(json_encode($orderTemplate));
        }
    }

    public function getProductsToEdit(){
        return $this->displayEditProducts();
    }

    public function getSingleProductToEdit(){
        $productId = htmlspecialchars($_POST['request-product']);
        exit(json_encode($this->singleProduct($productId)));
    }
    
    public function viewOrderHistory(){
        
        return $this->getOrderHistory();
    }
}
