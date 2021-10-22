<?php
require_once 'Tables.php';

class DBScanner
{
    var $tab;

    function __construct(){
       $this->tab = new iTables();
    }

    public function ScanMySql($ip, $username, $password, $dbname)
    {
        $conn = new mysqli($ip, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully on DB: " . $dbname;
    }

    public function Tables()
    {
        return $this->tab;
    }
}
