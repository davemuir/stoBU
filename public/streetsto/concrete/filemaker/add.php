<?php
include 'FileMaker.php';
if(isset($_POST)){
	//create table with fields
	$fieldsArr = $_POST['fields'];
	$count = count($fieldsArr);
	$fm = new FileMaker('test.fmp12', '192.168.128.136', 'Admin', 'hack123');
	//$scripts = $fm->listScripts();
       	
	$AddOrder_data= array(
		'fname' =>'ging',
		'lname' =>'downey'
	);
	$rec = $fm->newAddCommand('new', $AddOrder_data);
	
	$result = $rec->execute();
	$resp = $result;
	echo json_encode($resp);
}else{
	echo "here";
}
?>
