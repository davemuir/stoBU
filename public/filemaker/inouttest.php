<?php
include 'FileMaker.php';
if(isset($_POST)){

		$arr = $_POST;
		echo json_encode($arr);
		exit;

		$data1 = [
		'time' => $_POST['entry'],
		'userID' => $_POST['cID'],
		'locationID' => $_POST['locationID'],
		'type' => 'in'
		];

		


			$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
			$rec = $fm->newAddCommand("streetsto_inout",$data1);
			$result = $rec->execute();
		if (FileMaker::isError($result)) {
			echo json_encode('broken 1');
			exit;
		}else{
			
			echo json_encode(1);
		}

}else{
	echo json_encode('empty string');
}
?>
