<?php
require_once 'DBScanner.php';

$db = new DBScanner();

$conn = $db->ScanMySql("localhost", "root", "", "bioskop");

?>

<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 10px;
}
</style>
</head>
<body>
<table>
    <tr>
        <td colspan="2"><h1>GetTable by Index</h1></td>
    </tr>
    <?php 
    print_r($db->Tables()->GetTablebyIndex("film")); 
    ?>
</table>
<br><br>
<table>
    <tr>
        <td colspan="2"><h1>GetTable</h1></td>
    </tr>
    <?php 
    //AddTable
    $db->Tables()->AddTable('Coba', true);
    print_r($db->Tables()->GetTable()); 
    ?>
    <tr>
        <td><b>Total Count:</b></td>
        <td><?php print_r($db->Tables()->Count()); ?></td>
    </tr>
</table>
<br><br>
<table>
    <td colspan="2"><h1>Delete</h1></td>
    <?php
    $db->Tables()->DeleteTable("Coba");
    print_r($db->Tables()->GetTable());
    ?>
    <tr>
        <td><b>Total Count:</b></td>
        <td><?php print_r($db->Tables()->Count());?></td>
    </tr>
</table>

<br><br>
<?php 
//AddField
$tb = $db->Tables()->table("Coba");
$tb->Fields()->AddField('test_field', 'varchar', 255, false, true);
?>
<table>
    <tr>
        <td colspan="5"><h1>GetField by Index</h1></td>
    </tr>
    <?php 
    print_r($tb->Fields()->GetFieldbyIndex(0)); 
    ?>
</table>
<br><br>

<table>
    <td colspan="5"><h1>GetField</h1></td>
    <?php print_r($tb->Fields()->GetField());?>
    <tr>
        <td><b>Total Count:</b></td>
        <td colspan="4"><?php print_r($tb->Fields()->Count());?></td>
    </tr>
</table>

<?php
$tb->Fields()->DeleteField("test_field");
?>
<br><br>
<table>
    <td colspan="5"><h1>Delete</h1></td>
    <?php print_r($tb->Fields()->GetField());?>
    <tr>
        <td><b>Total Count:</b></td>
        <td colspan="4"><?php print_r($tb->Fields()->Count());?></td>
    </tr>
</table>
</body>
</html>