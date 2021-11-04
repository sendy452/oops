<?php
require_once 'Tables.php';

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
        }else{
            $this->getAllTb($conn, $dbname);
        }
        return $conn;
    }

    public function getAllTb($conn, $dbname)
    {
        $result = $conn->query('SHOW TABLES;');

        while ($row = mysqli_fetch_array($result)) {
            $tb_name = $row[0];
            $isViewRow = mysqli_fetch_row(
                $conn->query("SELECT TABLE_TYPE 
                                FROM information_schema.tables 
                                WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$tb_name'")
            );
            $isViewRow[0] == 'VIEW' ? $isView = true : $isView = false;
            $tablelist = array(
                'tableName' => $tb_name,
                'isView' => $isView
            );

            $status = $this->tb->addTable($tablelist);
            $this->addAllField($conn, $dbname, $tb_name);
        }

        return $status;
    }
    public function addAllField($conn, $dbname, $tb_name)
    {
        $check = $this->tb->table($tb_name);
        if (isset($check)) {
            $result = $conn->query("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$tb_name'");

            while ($row = mysqli_fetch_assoc($result)) {
                $fieldName = $row['COLUMN_NAME'];
                $dataType = $row['DATA_TYPE'];
                $dataLength = !empty($row['CHARACTER_MAXIMUM_LENGTH']) ? $row['CHARACTER_MAXIMUM_LENGTH'] : $row['NUMERIC_PRECISION'];
                $isPK = $row['COLUMN_KEY'] == 'PRI' ? true : false;
                $isNull = $row['IS_NULLABLE'] == 'YES' ? true : false;
                $obj = array(
                    'fieldName' => $fieldName,
                    'dataType' => $dataType,
                    'dataLength' => $dataLength,
                    'isPK' => $isPK,
                    'isNull' => $isNull
                );
                $this->tb->table($tb_name)->fields()->addField($obj);
            }

            return $this;
        } else {
            exit("Tabel '$tb_name' tidak ada.");
        }
    }
    
    public function Tables()
    {
        return $this->tb;
    }
}
