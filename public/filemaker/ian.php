<?php
	include 'FileMaker.php';
	$fm = new FileMaker("restaurants2.fmp12","192.168.128.136","Admin","streetsto");
	$request = $fm->newFindAllCommand("default");
	$result = $request->execute();
	$records = $result->getRecords();
	$layout = $fm->getLayout('default');

	echo json_encode($layout->getFields());
	
	//echo json_encode($records);
?>
