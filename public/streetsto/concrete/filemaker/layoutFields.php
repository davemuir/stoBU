<?php
include 'FileMaker.php';
if($_POST['layout']){
	$dbo = $_POST['dbo'];
	$dboName = $dbo[0];
	$dboHost = $dbo[1];
	$dboUser = $dbo[2];
	$dboPass = $dbo[3];
	$dboLayout = $dbo[4];

	$layout = $_POST['layout'];

	$fm = new FileMaker($dboName,$dboHost,$dboUser,$dboPass);
	$request = $fm->newFindAllCommand($layout);
	$result = $request->execute();
	$records = $result->getRecords();
	foreach($records as $key){
		        $fields = $key->getFields();
	}
	
	$super = [$layout,$fields];
echo json_encode($super);	
}else{
echo 'did not recieve a layout request';
}

?>
