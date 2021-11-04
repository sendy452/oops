<?php
require_once 'DBScanner.php';

$db = new DBScanner();

$conn = $db->ScanMySql("localhost", "root", "", "bioskop");

$listtable = array(
    'tableName' => 'Coba',
    'isView' => true,
);
$db->Tables()->AddTable($listtable);

echo "<h1>GetTable</h1>";
print_r($db->Tables()->GetTable());

echo "<h1>Count</h1>";
print_r($db->Tables()->Count());

echo "<h1>Delete</h1>";
$db->Tables()->DeleteTable("Coba");

print_r($db->Tables()->GetTable());
print_r("After Delete: ".$db->Tables()->Count());


echo "<h1>GetField</h1>";
//AddField
$tb = $db->Tables()->table("Coba");
$fieldName = 'test_field';
$dataType = 'varchar';
$dataLength = '255';
$isPK = false;
$isNull = true;
$obj = array(
    'fieldName' => $fieldName,
    'dataType' => $dataType,
    'dataLength' => $dataLength,
    'isPK' => $isPK,
    'isNull' => $isNull
);
$tb->Fields()->AddField($obj);
print_r($tb->Fields()->GetField());

echo "<h1>Count</h1>";
print_r($tb->Fields()->Count());

echo "<h1>Delete</h1>";
$tb->Fields()->DeleteField($fieldName);

print_r($tb->Fields()->GetField());
print_r("After Delete: ".$tb->Fields()->Count());