<?php

include 'FileMaker.php';
$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
        $rec = $fm->newFindAllCommand("streetsto_location");
        $result = $rec->execute();

        $resp = $result->getRecords();
         $super = [];
        foreach ($resp as $record) {
        $super[$record->getField('id')] =  $record->getField('name');
        }

        echo json_encode($super);

?>
