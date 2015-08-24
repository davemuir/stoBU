<?php

include 'FileMaker.php';

$fm = new FileMaker('Nabeel.fmp12', '199.38.217.147', 'Admin', 'admin');


$uuid = $_GET['uuid'];

$major = $_GET['major'];
$minor = $_GET['minor'];
$tx = $_GET['tx'];




 $rec = $fm->newAddCommand('Nabeel');

$rec->setField('UUID', $uuid);

$rec->setField('Major', $major);
$rec->setField('Minor', $minor);
$rec->setField('Tx', $tx);
 $added = $rec->execute();
 echo"record added";

?>