<?php
if(isset($_POST['uuid'])){

	$id = $_POST['uuid'];
	$major = $_POST['major'];
	$minor = $_POST['minor'];
	$alias = $_POST['alias'];
	$companyID = $_POST['companyID'];
	$beaconID = $_POST['beaconID'];
	
	include 'FileMaker.php';
	$fm = new FileMaker("salesDemo.fmp12","75.98.16.6","Admin","jklmjklm"); //199.38.217.147

	
	$arr = [
		'uuid' => $id,
		'major' => $major,
		'minor' => $minor,
		'alias' => $alias,
		'beaconID' => $beaconID,
		'companyID' => $companyID
	];

	$rec = $fm->newAddCommand("beacons",$arr);
	$result = $rec->execute();
	$records = $result->getRecords();

}
?>