<?php
require_once 'Tables.php';
require_once 'Field.php';

class iFields
{

    public $db, $fd;

    public function __construct()
    {
        $this->fd = new Field();
    }

    public function AddField($value1, $value2, $value3, $value4, $value5)
    {
        $this->fd->setFieldName($value1);
        $this->fd->setDataType($value2);
        $this->fd->setDataLenght($value3);
        $this->fd->setIsPK($value4);
        $this->fd->setIsNull($value5);
    }
    public function GetField()
    {
        $db = new DBScanner();
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'film' ORDER BY ORDINAL_POSITION";
        $result = mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), $sql);

        while ($row = mysqli_fetch_row($result)) {
            echo "Field Name: {$row[0]}</br>";

            $DataTypeRow = mysqli_fetch_row(
                mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = '$row[0]' ORDER BY ORDINAL_POSITION")
            );
            echo "Data Type: ". $DataTypeRow[0] ."</br>";

            $DataLengthRow = mysqli_fetch_row(
                mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), "SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = '$row[0]' ORDER BY ORDINAL_POSITION")
            );
            if ($DataLengthRow[0] == ''||null) {
                $DataLengthRow = mysqli_fetch_row(
                    mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), "SELECT NUMERIC_PRECISION FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = '$row[0]' ORDER BY ORDINAL_POSITION")
                );
            }
            echo "Data Length: ". $DataLengthRow[0] ."</br>";

            $isPKRow = mysqli_fetch_row(
                mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), "SELECT COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = '$row[0]' ORDER BY ORDINAL_POSITION")
            );
            if ($isPKRow[0] == 'PRI') {
                $isPK = TRUE;
            }else {
                $isPK = FALSE;
            }
            echo "isPK: ";
            echo $isPK ? 'true' : 'false';
            echo "</br>";

            $isNullRow = mysqli_fetch_row(
                mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), "SELECT COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME = '$row[0]' ORDER BY ORDINAL_POSITION")
            );
            if ($isNullRow[0] == 'NULL') {
                $isNull = TRUE;
            }else {
                $isNull = FALSE;
            }
            echo "isNull: ";
            echo $isNull ? 'true' : 'false';
            echo "</br></br>";
        }

        if ($this->fd->getIsPK() && $this->fd->getIsNull() == 1) {
            $this->fd->setIsPK("true");
            $this->fd->setIsNull("true");
        }else{
            $this->fd->setIsPK("false");
            $this->fd->setIsNull("false");
        }

        return mysqli_fetch_array($result)."Field Name: ". $this->fd->getFieldName()."</br> Data Type: ".$this->fd->getDataType()."</br> Data Length: ".$this->fd->getDataLenght()."</br> isPK: ".$this->fd->getIsPK()."</br> isNull: ".$this->fd->getIsNull();
    }
    public function Count()
    {
        $db = new DBScanner();
        $sql = "SHOW COLUMNS FROM film";
        $result = mysqli_query($db->ScanMySql("localhost", "root", "", "bioskop"), $sql);
        $num_rows = mysqli_num_rows($result) + count((array) $this->fd->getFieldName());

        return "$num_rows Rows\n";
    }
    public function DeleteField()
    {
        $this->GetField();
    }
}
