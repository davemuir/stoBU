<?php
        //MAP
        include 'FileMaker.php';
        $fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
        $request = $fm->newFindAllCommand('streetsto_location');
        $result = $request->execute();
        $records = $result->getRecords();
        $co = [];
        $count = 0;
        foreach($records as $record){
                        $co[$count] = ['lat'=>$record->getField('latitude'),'long'=>$record->getField('longitude'),'addr'=>$record->getField('address_street1'),'lname'=>$record->getField('name')];
                        $count++;
        }
        $co = array_map("unserialize", array_unique(array_map("serialize", $co)));
        echo json_encode($co);
?>