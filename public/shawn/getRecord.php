<?php
include 'FileMaker.php';

$fm = new FileMaker('Nabeel.fmp12', '199.38.217.147', 'Admin', 'admin');


$request = $fm->newFindAllCommand('Nabeel');
$result = $request->execute();
$records = $result->getRecords();
echo "<b>UUID </b><br/>";
foreach ($records as $record){

       echo($record->getField('UUID'));
       echo("<br/>");
}
?>