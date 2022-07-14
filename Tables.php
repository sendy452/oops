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

    public function AddTable($TbName, $isView)
    {
        $table = new Table();
        $table->setTableName($TbName);
        $table->setIsView($isView ? 'true' : 'false');

        $this->arrTb[] = $table;
        return $this;
    }

    public function GetTable()
    {
        $string = '';
        foreach ($this->arrTb as $row) {
            $TbName = $row->getTableName();
            $isView = $row->getIsView();

            $string .= "
            <tr>
                <td>$TbName </td>
                <td>$isView</td>
            </tr>";
        }
        return "
        <tr>
            <th>Nama Tabel</th>
            <th>Is View</th>
        </tr>" 
        . $string;
    }

    public function GetTablebyIndex($key)
    {
        if (filter_var($key, FILTER_VALIDATE_INT) === false) {
            for ($x = 0; $x < sizeof($this->arrTb); $x++) {
                if ($this->arrTb[$x]->getTableName() == $key) {
                    return "
                        <tr>
                            <th>tableName</th>
                            <th>isView</th>
                        </tr>
                        <tr>
                            <td>".$this->arrTb[$x]->tableName."</td>
                            <td>".$this->arrTb[$x]->isView."</td>
                        </tr>
                    ";
                }
            }
            return "Tabel '$key' tidak ditemukan";
        } else {
            if (isset($this->arrTb[$key])) {
                return "
                <tr>
                    <th>tableName</th>
                    <th>isView</th>
                </tr>
                <tr>
                    <td>".$this->arrTb[$key]->tableName."</td>
                    <td>".$this->arrTb[$key]->isView."</td>
                </tr>
            ";
            } else {
                return "Index Tabel ke-'$key' tidak ada";
            }
        }
    }

    public function Count()
    {
        return count($this->arrTb);
    }

    public function DeleteTable($tablerm)
    {
        if (filter_var($tablerm, FILTER_VALIDATE_INT) === false) {
            for ($x = 0; $x < sizeof($this->arrTb); $x++) {
                if ($this->arrTb[$x]->getTableName() == $tablerm) {
                    unset($this->arrTb[$x]);
                    return $this;
                }
            }
        } else {
            if (isset($this->arrTb[$tablerm])) {
                unset($this->arrTb[$tablerm]);
                return $this;
            }
        }
    }
    public function table()
    {
        return $this->tb;
    }
}
