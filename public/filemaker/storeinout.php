<?php
include 'FileMaker.php';
if(isset($_POST)){
		


		$data1 = [
		'time' => $_POST['time'],
		'userID' => $_POST['cID'],
		'locationID' => $_POST['locationID'],
		'type' => $_POST['type']
		];

		/*$data2 = [
		'time' => $_POST['exit'],
		'userID' => $_POST['cID'],
		'locationID' => $_POST['locationID'],
		'type' => 'out'
		];*/


			$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
			$rec = $fm->newAddCommand("streetsto_inout",$data1);
			$rec->setScript('validate');
			$result = $rec->execute();
		if (FileMaker::isError($result)) {
			echo json_encode('broken 1');
			exit;
		}else{
			/*$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
			$rec = $fm->newAddCommand("streetsto_inout",$data2);
			$result = $rec->execute();
			if (FileMaker::isError($result)) {
				echo json_encode('broken 2');
				exit;
			}else{
				echo json_encode(1);
				exit;
			}*/
			echo json_encode(1);
		}

}else{
	echo json_encode('empty string');
}
?>
