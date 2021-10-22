<?php

class Field{
    var $fieldName, $dataType, $dataLenght, $isPK, $isNull;

    public function setFieldName($value)
    {
        $this->fieldName = $value;
    }
    public function getFieldName()
    {
        return $this->fieldName;
    }

    public function setDataType($value)
    {
        $this->dataType = $value;
    }
    public function getDataType()
    {
        return $this->dataType;
    }
    public function setDataLenght($value)
    {
        $this->dataLenght = $value;
    }
    public function getDataLenght()
    {
        return $this->dataLenght;
    }

    public function setIsPK($value)
    {
        $this->isPK = $value;
    }
    public function getIsPK()
    {
        return $this->isPK;
    }
    public function setIsNull($value)
    {
        $this->isNull = $value;
    }
    public function getIsNull()
    {
        return $this->isNull;
    }
}