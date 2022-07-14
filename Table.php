<?php
require_once 'Fields.php';

class Table{
    
    var $tableName, $isView, $fd;
    function __construct()
    {
        $this->fd = new iFields();
    }

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

    public function tableSet($tableName, $isView){
        $this->tableName = $tableName;
        $this->isView = $isView;
    }
    
    public function Fields()
    {
        return $this->fd;
    }

    // show table
    public function show()
    {
        return "
        <table>
            <tr>
                <th>No</th>
                <th>tableName</th>
                <th>isView</th>
            </tr>
            <tr>
                <td>1</td>
                <td>$this->tableName</td>
                <td>$this->isView</td>
            </tr>
        </table>
        ";
    }
}