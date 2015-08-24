<?php
if(isset($_GET['id'])){
	$locID = $_GET['loc'];
	$userID = $_GET['id'];
	$interaction = $_GET['type'];
	//echo json_encode($_GET['loc']);
	//echo json_encode($userID);
	//return false;
	$data = [
		"perkID"=>$locID,
		"userID"=>$userID,
		//"redemptionType"=>$interaction
	];
	 include 'FileMaker.php';
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newAddCommand("streetsto_interactions",$data);
	$result = $rec->execute();
	$records = $result->getRecords();
	echo json_encode($records);				  
}

?>
