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

    public function AddField($fieldName, $dataType, $dataLength, $isPK, $isNull)
    {
        $field = new Field();
        $field->setFieldName($fieldName);
        $field->setDataType($dataType);
        $field->setDataLenght($dataLength);
        $field->setIsPK($isPK ? 'true' : 'false');
        $field->setIsNull($isNull ? 'true' : 'false');

        $this->arrFd[] = $field;
        return $this;
    }
    public function GetField()
    {
        $string = '';
        foreach ($this->arrFd as $row) {
            $fieldName = $row->getFieldName();
            $dataType = $row->getDataType();
            $dataLength = $row->getDataLenght();
            $isPK = $row->getIsPK();
            $isNull = $row->getIsNull();

            $string .= "
            <tr>
                <td>$fieldName </td>
                <td>$dataType</td>
                <td>$dataLength</td>
                <td>$isPK</td>
                <td>$isNull</td>
            <tr>";
        }
        return "
        <tr>
            <th>FieldName</th>
            <th>DataType</th>
            <th>DataLength</th>
            <th>isPK</th> 
            <th>isNULL</th>
        </tr>"
        .$string;
    }

    public function GetFieldbyIndex($key)
    {
        if (filter_var($key, FILTER_VALIDATE_INT) === false) {
            for ($x = 0; $x < sizeof($this->arrFd); $x++) {
                if ($this->arrFd[$x]->getFieldName() == $key) {
                    return "
                        <tr>
                            <th>FieldName</th>
                            <th>DataType</th>
                            <th>DataLength</th>
                            <th>isPK</th>
                            <th>isNULL</th>
                        </tr>
                        <tr>
                            <td>".$this->arrFd[$x]->fieldName."</td>
                            <td>".$this->arrFd[$x]->dataType."</td>
                            <td>".$this->arrFd[$x]->dataLenght."</td>
                            <td>".$this->arrFd[$x]->isPK."</td>
                            <td>".$this->arrFd[$x]->isNull."</td>
                        </tr>
                    ";
                }
            }
            return "Field '$key' tidak ditemukan";
        } else {
            if (isset($this->arrFd[$key])) {
                return "
                <tr>
                    <th>FieldName</th>
                    <th>DataType</th>
                    <th>DataLength</th>
                    <th>isPK</th>
                    <th>isNULL</th>
                </tr>
                <tr>
                    <td>".$this->arrFd[$key]->fieldName."</td>
                    <td>".$this->arrFd[$key]->dataType."</td>
                    <td>".$this->arrFd[$key]->dataLenght."</td>
                    <td>".$this->arrFd[$key]->isPK."</td>
                    <td>".$this->arrFd[$key]->isNull."</td>
                </tr>
            ";
            } else {
                return "Index Field ke-'$key' tidak ada";
            }
        }
    }

    public function Count()
    {
        return count($this->arrFd);
    }
    public function DeleteField($fieldrm)
    {
        if (filter_var($fieldrm, FILTER_VALIDATE_INT) === false) {
            for ($x = 0; $x < sizeof($this->arrFd); $x++) {
                if ($this->arrFd[$x]->getFieldName() == $fieldrm) {
                    unset($this->arrFd[$x]);
                    return $this;
                }
            }
        } else {
            if (isset($this->arrFd[$fieldrm])) {
                unset($this->arrFd[$fieldrm]);
                return $this;
            }
        }
    }
}
