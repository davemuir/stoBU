<?php
include 'FileMaker.php';
if(isset($_POST['type'])){
	if($_POST['type'] == "create"){
	$data = [
		'perkName'=>$_POST['title'],
		'perkContents'=>$_POST['contents'],
		'location_fk'=>$_POST['locationID'],
		'perkMongoID'=>$_POST['mongoID']
	];
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newAddCommand("streetsto_perks",$data);
	$result = $rec->execute();
	$records = $result->getRecords();
	$recID = $records[0]->getRecordId();
	echo $recID;
	}
}

?>