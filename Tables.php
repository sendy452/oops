<?php
require_once '../oop/Table.php';

class iTables
{

    public $tb, $db, $fd;

    public function __construct()
    {
        $this->tb = new Table();
        $this->fd = new iFields();
    }

    //dibuat procedure
    public function AddTable($value1, $value2)
    {
        $this->tb->setTableName($value1);
        $this->tb->setIsView($value2);
    }

    public function GetTable()
    {
        $db = new DBScanner();
        $sql = "SHOW TABLES";
        $result = mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), $sql);

        while ($row = mysqli_fetch_row($result)) {
            echo "Table: {$row[0]}</br>";
            $isViewRow = mysqli_fetch_row(
                mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), "SELECT TABLE_TYPE FROM information_schema.tables WHERE TABLE_SCHEMA = 'bioskop' AND TABLE_NAME = '$row[0]'")
            );
            if ($isViewRow[0] == 'VIEW') {
                $isView = TRUE;
            }else {
                $isView = FALSE;
            }
            echo "isView: ";
            echo $isView ? 'true' : 'false';
            echo "</br></br>";
        }

        if ($this->tb->getIsView() == 1) {
            $this->tb->setIsView("true");
        }else{
            $this->tb->setIsView("false");
        }

        return mysqli_fetch_array($result) ."Table: " . $this->tb->getTableName() . "</br>isView: " . $this->tb->getIsView();
    }

    public function Count()
    {
        $db = new DBScanner();
        $sql = "SHOW TABLES";
        $result = mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), $sql);
        $num_rows = mysqli_num_rows($result) + count((array) $this->tb->getTableName());

        return "$num_rows Rows\n";
    }

    public function DeleteTable()
    {
        $this->GetTable();
    }

    public function Fields()
    {
        return $this->fd;
    }
}
