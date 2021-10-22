<?php

class Table{
    
    var $tableName, $isView;

    public function setTableName($value)
    {
        $this->tableName = $value;
    }
    public function getTableName()
    {
        return $this->tableName;
    }

    public function setIsView($value)
    {
        $this->isView = $value;
    }
    public function getIsView()
    {
        return $this->isView;
    }


    public function getsetData()
{
    # code...
}
}