<?php 

include 'FileMaker.php';
$fm = new FileMaker("streetsto_location.fmp12","192.168.128.136","Admin","streetsto");
$rec = $fm->newFindAllCommand("streetsto_location");
$result = $rec->execute();
$records = $result->getRecords();
$data = [];
$count = 0;
foreach($records as $record){
	$data[$count]["beaconUUID"] = $record->getField('beaconUUID');
	$data[$count]["beaconMajor"] = $record->getField('beaconMajor');
	$data[$count]["beaconMinor"] = $record->getField('beaconMinor');
	$count++;
}
echo json_encode($data);

?>
