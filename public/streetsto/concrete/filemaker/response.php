<?php
//not being used in apengage
include 'FileMaker.php';

$fm = new FileMaker('test.fmp12', '192.168.128.136', 'Admin', 'hack123');
 $request = $fm->newFindAllCommand('test'); 
$result = $request->execute();
$records = $result->getRecords();


var_dump($records[0]);
?>
