<?php 
include 'FileMaker.php';
if($_POST['dbo']){

	$dbo = $_POST['dbo'];
	$dboName = $dbo[0];
	$dboHost = $dbo[1];
	$dboUser = $dbo[2];
	$dboPass = $dbo[3];
	$dboLayout = $dbo[4];
	
	$fm = new FileMaker($dboName,$dboHost,$dboUser,$dboPass);
	$layouts = $fm->listLayouts();
	$layout = $fm->getLayout($dboLayout); 
	$request = $fm->newFindAllCommand($dboLayout);
	$result = $request->execute();
	$records = $result->getRecords();
	//echo json_encode($records); exit();
$arr = Array();
foreach($records as $key){
        $fields = $key->getFields();
}
$fieldArray = $fields;
$gnar = Array();
foreach($fields as $row){
	$gnar[] = [$row];	
}
$fresh = Array();
foreach($gnar as $key){
	$fieldName = $key[0];
	$into = [];
	foreach($records as $key){
        $field = $key->getField($fieldName);
        $flag = 'false';
        foreach($into as $val){
        	if($field == $val){
        		$flag = 'true';
        	}
        }
        if($flag == 'false'){
        	array_push($into,$field);	
        }
        

	}
	array_push($fresh,[$fieldName => $into]);
}
$super = [$fieldArray,$fresh,$layouts];
echo json_encode($super);
}
?>
