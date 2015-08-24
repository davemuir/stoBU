<?php
include 'FileMaker.php';
if(isset($_POST['locationID'])){

	$id = $_POST['locationID'] + 0;
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newFindCommand("streetsto_location");
	$rec->addFindCriterion('id',$id);

	$result = $rec->execute();

	$records = $result->getRecords();
	$data = [];
	$count = 0;
	foreach($records as $record){
		$data["name"] = $record->getField('name');
	}
	echo json_encode($data["name"]);
}
?>