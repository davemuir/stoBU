<?php
if(isset($_GET['id'])){
	$locID = $_GET['loc'];
	$userID = $_GET['id'];

	//echo json_encode($_GET['loc']);
	//echo json_encode($userID);
	//return false;
	$data = [
		"locationID"=>$locID,
		"userID"=>$userID
	];
	 include 'FileMaker.php';
	$fm = new FileMaker("streets_perks","192.168.128.136","Admin","streetsto");
	$rec = $fm->newAddCommand("streets_perks",$data);
	$result = $rec->execute();
	$records = $result->getRecords();
	echo json_encode($records);				  
}

?>
