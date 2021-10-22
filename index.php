<?php
require_once 'DBScanner.php';

$a = new DBScanner();

echo $a->Tables()->Count();