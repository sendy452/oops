<?php
require_once '../oop/Table.php';

class iTables
{

    public $tb;

    public $arrTb = [];

    public function __construct()
    {
        $this->tb = new Table();
    }

    public function AddTable($tablelist)
    {
        $key = $tablelist['tableName'];
        $this->arrTb[$key] = array(
           'tableName' => $tablelist['tableName'],
            'isView' => $tablelist['isView'] ? 'true' : 'false',
        );
        $this->tb->setTableName('tableName');
        $this->tb->setIsView('isView');
    }

    public function GetTable()
    {
        $string = '';
        foreach ($this->arrTb as $row) {
            $tableName = $row[$this->tb->getTableName()];
            $isView = $row[$this->tb->getIsView()];

            $string .= "tableName : $tableName <br> isView : $isView<br><br>";
        }
        return $string;
    }

    public function Count()
    {
        return count($this->arrTb);
    }

    public function DeleteTable($tablerm)
    {
        unset($this->arrTb[$tablerm]);
    }
    public function table()
    {
        return $this->tb;
    }
}
