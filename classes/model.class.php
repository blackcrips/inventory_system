<?php

class Model extends Dbh
{
    protected function validateExistingEmail($email)
    {
        $sql = "SELECT email from userlogin WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$email])) {
            die();
        }

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email already exist!')</script>";
            echo "<script>window.location.href = '../signup.php'</script>";
            die();
        } else {
            return;
        }
    }

    protected function getUserData($email)
    {
        $sql = "SELECT * from userlogin WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$email])) {
            die();
        }

        if ($stmt->rowCount() == 0) {
            echo "Please contact your system administrator";
        } else {
            $result = $stmt->fetch();
            return $result;
        }
    }

    protected function signUpUser($firstname, $middlename, $lastname, $email, $password)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO userlogin (`firstname`,`middlename`,`lastname`,`email`,`password`) VALUES (?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$firstname, $middlename, $lastname, $email, $hashPassword])) {
            die();
        } else {
            header("Location: ../index.php");
            exit;
        }
    }

    private function getActiveSession($username)
    {
        $sql = "SELECT username,PHPSESSION,COOKIESESSION FROM sessions WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $rowCount = $stmt->rowCount();
        $result = $stmt->fetchAll();
        return array($rowCount, $result);
    }

    protected function getSessions()
    {
        $sql = "SELECT username,PHPSESSION,COOKIESESSION,date_created FROM sessions";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function loginUser($username, $password)
    {
        $sql = "SELECT * FROM userlogin WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);

        if ($stmt->rowCount() == 0) {
            echo "<script>alert('Invalid username or password!')</script>";
            echo "<script>window.location.href = '../index.php'</script>";
        } else {
            $hashedPassword = $stmt->fetch();
            if (password_verify($password, $hashedPassword['password'])) {
                if ($this->getActiveSession($hashedPassword['email'])[1][0]['username'] > 0) {

                    $getCookie = $this->getActiveSession($hashedPassword['email'])[1];     // array value

                    $this->createSessionLogin($hashedPassword);
                    $this->checkCookieState($getCookie);
                }
            } else {
                echo "<script>alert('Invalid username or password!')</script>";
                echo "<script>window.location.href = '../index.php'</script>";
            }
        }
    }

    public function createSessionLogin($array)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['loginUser'] = array(
            "name" => $array['firstname'] . " " . $array['lastname'],
            "email" => $array['email']
        );
    }

    private function checkCookieState($getCookie)
    {

        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_COOKIE['userLoginData'])) {
            $serial = $this->createCookie();
            $this->insertSerial($_SESSION['loginUser']['email'], $serial, $serial);
            setcookie('userLoginData', $serial, time() + (86400 * 30), "/");
        } else {
            for ($i = 0; $i < count($getCookie); $i++) {
                if ($getCookie[$i]['COOKIESESSION'] == $_COOKIE['userLoginData']) {
                    $this->updateSerial($getCookie[$i]['username'], $getCookie[$i]['PHPSESSION'], $getCookie[$i]['COOKIESESSION']);
                    header("Location: ../homePage.php");
                    exit;
                } else {
                    continue;
                }
            }


            $this->createCookie();
        }
    }

    public function createCookie()
    {
        $sql = "SELECT COOKIESESSION FROM sessions";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        $serial = $this->createSerial(62);

        foreach ($results as $result) {
            if ($serial == $result) {
                $serial = $this->createSerial(62);
            } else {
                return $serial;
            }
        }
    }

    public function createSerial($serialCount)
    {
        $serialTemplate = "1qay2wsx3edc4rfv5tgb6zhn7ujm8ik9olpAQWSXEDCVFRTGBNHYZUJMKILOP";
        $serial = '';

        for ($i = 0; $i < $serialCount; $i++) {
            $index = rand(0, strlen($serialTemplate) - 1);
            $serial .= $serialTemplate[$index];
        }

        return $serial;
    }


    protected function insertSerial($username, $session, $cookie)
    {
        $sql = "INSERT INTO sessions (`username`,`PHPSESSION`,`COOKIESESSION`,`date_created`) VALUE (?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username, $session, $cookie, date('Y-m-d H-i-s')]);
    }

    protected function updateSerial($username, $session, $cookie)
    {
        $currentDate = date('Y-m-d H-i-s');
        $sql = "UPDATE sessions SET `username` = ?, `PHPSESSION` = ?, `COOKIESESSION` = ?, `date_created` = ? WHERE COOKIESESSION = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username, $session, $cookie, $currentDate, $cookie]);
    }

    protected function getSessionDateCreated($id)
    {
        $sql = "SELECT added_at FROM sessions WHERE PHPSESSION = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Function to get the client IP address
    protected function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    // Products Model

    protected function getAllData()
    {
        $sql = "SELECT 
        product_name,
        product_description,
        product_code,
        price,
        quantity 
        FROM products_name pn
        JOIN products_price pp
            ON pn.product_code = pp.id";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount <= 0) {
            $output = array(
                "recordsTotal"      => $rowCount,
                "recordsFiltered"   => $rowCount,
                "data"   => $rowCount,
            );
            exit(json_encode($output));
        } else {

            foreach ($result as $rowData) {
                $sub_array = array();
                $sub_array[] = $rowData['product_name'];
                $sub_array[] = $rowData['product_description'];
                $sub_array[] = $rowData['product_code'];
                $sub_array[] = $rowData['price'];
                $sub_array[] = $rowData['quantity'];
                $sub_array[] = "<div class='action-buttons'>
                                    <form action='#' id='form-action-buttons' method='post'>
                                        <input type='button' class='btn btn-primary' data-view-details value='Edit'>
                                        <input type='hidden' name='viewDetailsHidden' id='viewDetailsHidden' value='" . $rowData['product_code'] . "'>
                                    </form>
                                </div>";


                $data[] = $sub_array;
            }

            $output = array(
                "recordsTotal"      => $rowCount,
                "recordsFiltered"   => $rowCount,
                "data"              => $data
            );

            exit(json_encode($output));
        }
    }

    protected function logoutUser($email)
    {
        $updateStatus = "";
        $sql = "UPDATE userlogin SET status = ? WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$updateStatus, $email])) {
            die();
        }
    }

    protected function insertProductsName($category, $productName, $productDescription, $productCode)
    {
        $sql = "INSERT INTO products_name (`category`,`product_name`,`product_description`,`product_code`) VALUES(?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$category, $productName, $productDescription, $productCode]);
    }

    protected function insertSupplierName($serialCode, $supplierName, $supplierAddress, $contactNo, $secondaryNo, $contactPerson, $products)
    {
        $sql = "SELECT supplier_name,contact_no FROM supplier WHERE supplier_name = ? OR contact_no = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$supplierName, $contactNo]);
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            return false;
        } else {
            $sql = "INSERT INTO supplier (`store_code`,`supplier_name`,`supplier_address`,`contact_no`,`secondary_no`,`contact_person`,`products`) VALUES(?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$serialCode, $supplierName, $supplierAddress, $contactNo, $secondaryNo, $contactPerson, $products]);
            return true;
        }
    }

    protected function insertProductPrice($id, $price, $resellerPrice, $supplierPrice, $quantity, $storeCode)
    {
        $sql = "INSERT INTO products_price (`id`,`price`,`reseller_price`,`supplier_price`,`quantity`,`store_code`) VALUES(?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, $price, $resellerPrice, $supplierPrice, $quantity, $storeCode]);
    }

    protected function getProductCode()
    {
        $sql = "SELECT product_code FROM products_name";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getSupplierCode()
    {
        $sql = "SELECT store_code FROM supplier";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getSupplierName()
    {
        $sql = "SELECT supplier_name,store_code FROM supplier";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    protected function getAllContactNumbers($contactNo)
    {
        $sql = "SELECT contact_no FROM clients_details WHERE contact_no = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$contactNo]);
        $result = $stmt->rowCount();

        return $result;
    }

    protected function insertClientDetails($storeName, $contactPerson, $contactNo, $address)
    {
        $sql = "INSERT INTO clients_details (`store_name`,`contact_person`,`contact_no`,`address`) VALUES(?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute([$storeName, $contactPerson, $contactNo, $address])) {
            echo "<script>alert('Added successfully!')</script>";
            echo "<script>window.location.href ='../kevin.php'</script>";
        } else {
            echo "<script>alert('Error creating data!')</script>";
            echo "<script>window.location.href ='../kevin.php'</script>";
        }
    }

    protected function existingClient($searchValue)
    {
        $sql = "SELECT store_name,id FROM clients_details
        WHERE store_name LIKE :serachValue || 
        contact_person LIKE :serachValue || 
        contact_no LIKE :serachValue || 
        address LIKE :serachValue";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([':serachValue' => '%' . $searchValue . '%']);

        $result = $stmt->fetchAll();

        exit(json_encode($result));
    }

    protected function getAllCategories()
    {
        $sql = "SELECT category FROM products_name";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function getProductBycategory($productName)
    {
        $sql = "SELECT product_name FROM products_name WHERE category = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productName]);

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function getProductByName($productName)
    {
        $sql = "SELECT product_description FROM products_name WHERE product_name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productName]);

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function getPrices($category, $productName, $productDescription)
    {
        $sql = "SELECT product_code FROM products_name WHERE category = ? AND product_name = ? AND product_description = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$category, $productName, $productDescription]);

        $result = $stmt->fetch();


        $sql = "SELECT * FROM products_price WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$result['product_code']]);

        $fetchData = $stmt->fetchAll();

        return $fetchData;
    }

    protected function getColumnNames()
    {
        $sql = "CALL getTableNames('clients_details')";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        foreach ($result as $value) {
            $columnNames = array();
            $columnNames[] = $value['COLUMN_NAME'];

            $data[] = $columnNames;
        };

        exit(json_encode($data));
    }

    protected function getOrderId($orderId){
        $sql = "SELECT order_id FROM products_orders WHERE order_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$orderId]);

        $rowCount = $stmt->rowCount();
        return $rowCount;
    }

    protected function insertOrders($orderId,$productName,$quantity,$price,$productCode,$clientId,$orderStatus){
        $sql = "INSERT INTO products_orders (`order_id`,`product_name`,`quantity`,`price`,`product_code`,`client_id`,`status`) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        

        if($stmt->execute([$orderId,$productName,$quantity,$price,$productCode,$clientId,$orderStatus])){
            return true;
        } else {
            return false;
        }
    }

    private function getProductQuantity($productCode){
        $sql = "SELECT quantity FROM products_price WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productCode]);

        $productQuantity = $stmt->fetch();

        return $productQuantity['quantity'];

    }

    protected function setNewQuantity($productCode,$quantity){
        $originalQuantity = $this->getProductQuantity($productCode);
        $newQuantity = intVal($originalQuantity) - intVal($quantity);

        $sql = "UPDATE products_price SET quantity = :newQuantity WHERE id = :productCode";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([':newQuantity' => $newQuantity, ':productCode' => $productCode]);
    }

    protected function getClientsDetails($id){
        $sql = "SELECT * FROM clients_details WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();

        return $result;
    }

    protected function orderToday($today){
        $sql = "SELECT order_id FROM products_orders WHERE added_at = ? AND status='pending'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$today]);

        $result = $stmt->fetchAll();
        return $result;
    }

    protected function singleOrderToday($id){
        $sql = "SELECT cd.store_name,po.status FROM products_orders po JOIN clients_details cd ON po.client_id = cd.id WHERE po.order_id =? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result;
    }

    protected function getSingleClient($id){
        $sql = "SELECT store_name FROM clients_details WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result;
    }

    protected function getOrders($orderId,$today){
        $sql = "SELECT product_name,quantity,price FROM products_orders WHERE order_id = ? AND added_at = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$orderId,$today]);

        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getOrderDetails($id){
        $sql = "SELECT store_name,contact_person,contact_no,address FROM clients_details cd JOIN products_orders po ON cd.id = po.client_id
        WHERE po.order_id = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();
        return $result;
    }

    protected function changeStutusOfOrder($orderId){
        $sql = "SELECT id FROM products_orders WHERE order_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$orderId]);

        $results = $stmt->fetchAll();
        // exit(json_encode($results));
        foreach($results as $result){
            $id = $result["id"];
            $sql = "UPDATE products_orders SET status = 'delivered' WHERE id = $id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
        }
    }

    protected function displayEditProducts(){
        $sql = "SELECT category,product_name,product_description,product_code,pp.store_code,pp.price,pp.reseller_price,pp.supplier_price,pp.quantity,s.supplier_name
         FROM products_name po 
         JOIN products_price pp 
            ON po.product_code = pp.id
        JOIN supplier s 
            ON pp.store_code = s.store_code";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        
        return $results;
    }

    protected function singleProduct($productId){
        $sql = "SELECT category,product_name,product_description,product_code,pp.store_code,pp.price,pp.reseller_price,pp.supplier_price,pp.quantity FROM products_name po JOIN products_price pp ON po.product_code = pp.id WHERE po.product_code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productId]);
        $results = $stmt->fetch();

        return $results;
        
    }

    protected function updateOrder($category,$productName,$productDescription,$supplierPrice,$retailPrice,$resellerPrice,$quantity,$productCode){
        $sql = "UPDATE products_name SET `category` = ?, `product_name` = ?, `product_description` = ? WHERE `product_code` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$category,$productName,$productDescription,$productCode]);

        $sql = "UPDATE products_price SET `price` = ?, `reseller_price` = ?, `quantity` = ?, `supplier_price` = ? WHERE id = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$retailPrice,$resellerPrice,$quantity,$supplierPrice,$productCode]);
    }

    private function getOrderHistoryOrderNumber(){
        $sql = "SELECT order_id FROM products_orders";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $emptyOrderId = [];

        for($i = 0; $i < count($result); $i++){
            array_push($emptyOrderId,$result[$i]['order_id']);
        }

        $uniqueOderId = array_unique($emptyOrderId);
        $returnArray = [];

        foreach($uniqueOderId as $id){
            $sql = "SELECT store_name,contact_person,contact_no,address,po.status,po.added_at 
            FROM clients_details cd
            JOIN products_orders po
                ON po.client_id = cd.id
            WHERE po.order_id = $id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            $data = $stmt->fetch();

            $dataTemplate = array(
                'order_id' => $id,
                'store_name' => $data['store_name'],
                'contact_person' => $data['contact_person'],
                'contact_no' => $data['contact_no'],
                'address' => $data['address'],
                'status' => $data['status'],
                'order_date' => $data['added_at'],
            );

            array_push($returnArray,$dataTemplate);
        }

        return $returnArray;
    }

    protected function getOrderHistory(){
        return $this->getOrderHistoryOrderNumber();
    }

}
