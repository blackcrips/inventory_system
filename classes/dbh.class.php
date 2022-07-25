<?php

class Dbh
{

    private $host = "localhost";
    private $username = "root";
    private $password = "123456";
    private $dbname = "inventory_system";

    protected function  connect()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
