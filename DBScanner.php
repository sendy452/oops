<?php
require_once 'Tables.php';
require_once 'Fields.php';

class DBScanner
{
    var $tb;

    public function __construct()
    {
        $this->tb = new iTables();
    }

    public function ScanMySql($ip, $username, $password, $dbname)
    {
        $conn = new mysqli($ip, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }

    public function Tables()
    {
        return $this->tb;
    }
}
