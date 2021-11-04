<?php
require_once 'Field.php';

class iFields
{

    public $db, $fd;
    public $arrFd = [];

    public function __construct()
    {
        $this->fd = new Field();
    }

    public function AddField($value)
    {
        $key = $value['fieldName'];
        $this->arrFd[$key] = array(
            'fieldName' => $value['fieldName'],
            'dataType' => $value['dataType'],
            'dataLength' => $value['dataLength'],
            'isPK' => $value['isPK'] ? 'true' : 'false',
            'isNull' => $value['isNull'] ? 'true' : 'false'
        );
        $this->fd->setFieldName('fieldName');
        $this->fd->setDataType('dataType');
        $this->fd->setDataLenght('dataLength');
        $this->fd->setIsPK('isPK');
        $this->fd->setIsNull('isNull');
    }
    public function GetField()
    {
        $string = '';
        foreach ($this->arrFd as $row) {
            $fieldName = $row[$this->fd->getFieldName()];
            $dataType = $row[$this->fd->getDataType()];
            $dataLength = $row[$this->fd->getDataLenght()];
            $isPK = $row[$this->fd->getIsPK()];
            $isNull = $row[$this->fd->getisNull()];

            $string .= "FieldName : $fieldName <br> DataType : $dataType<br> DataLength : $dataLength <br> isPK : $isPK <br> isNULL : $isNull <br><br>";
        }
        return $string;
    }
    public function Count()
    {
        return count($this->arrFd);
    }
    public function DeleteField($fieldrm)
    {
        unset($this->arrFd[$fieldrm]);
    }
}
