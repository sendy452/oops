<?php
require_once 'DBScanner.php';

$db = new DBScanner();
$tb = $db->Tables();

//AddTable
$db->Tables()->AddTable("tabel_tambah", true);

echo "<h1>GetTable</h1>";
print_r($db->Tables()->GetTable());

echo "<h1>Count</h1>";
print_r($db->Tables()->Count());

echo "<h1>Delete</h1>";
print_r($db->Tables()->DeleteTable());

//AddField
$tb->Fields()->AddField("field_baru","varchar", 255, false, false);

echo "<h1>GetField</h1>";
print_r($tb->Fields()->GetField());

echo "<h1>Count</h1>";
print_r($tb->Fields()->Count());

echo "<h1>Delete</h1>";
print_r($tb->Fields()->DeleteField());