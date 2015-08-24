<?php
include 'FileMaker.php';
if(isset($_POST['values'])){
	$fields = $_POST['fields'];
	$values = $_POST['values'];
	$layout = $_POST['layout'];
	$size = count($fields);

	$dbo = $_POST['dbo'];
	$dboName = $dbo[0];
	$dboHost = $dbo[1];
	$dboUser = $dbo[2];
	$dboPass = $dbo[3];
	$dboLayout = $dbo[4];

	//$fm = new FileMaker('test.fmp12', '192.168.128.136', 'Admin', 'hack123');
	$fm = new FileMaker($dboName,$dboHost,$dboUser,$dboPass);
	for($i=0;$i<$size;$i++){
		$field = $fields[$i];
		$val = $values[$i];
		$data[$field] = $val;
	}
	$rec = $fm->newAddCommand($layout, $data);

	$result = $rec->execute();
	$resp = $result;
	echo json_encode($resp);
}else{
echo "no request";
}
?>
