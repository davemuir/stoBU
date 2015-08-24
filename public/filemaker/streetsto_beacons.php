<?php 

include 'FileMaker.php';
$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
$rec = $fm->newFindAllCommand("streetsto_beacons");
$result = $rec->execute();
$records = $result->getRecords();
$data = [];
$count = 0;
foreach($records as $record){
	$data[$count]["beaconUUID"] = $record->getField('beaconUUID');
	$data[$count]["beaconMajor"] = $record->getField('beaconMajor');
	$data[$count]["beaconMinor"] = $record->getField('beaconMinor');
	$data[$count]["locationName"] = $record->getField('streetsto_location::name');
	$data[$count]["locationID"] = $record->getField('locationID_fk');
	$count++;
}
//$data = array_values(array_unique($data));
echo json_encode($data);

?>
