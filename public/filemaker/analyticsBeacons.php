<?php
if(isset($_POST['beaconID'])){

	include 'FileMaker.php';
	$fm = new FileMaker("salesDemo.fmp12","75.98.16.6","Admin","jklmjklm");
	$arr = [
				'beacon_id' => $_POST['beaconID'],
				'user_id' => $_POST['userID']	
	];
	$rec = $fm->newAddCommand("beaconInteractions",$arr);
	$result = $rec->execute();
	if (FileMaker::isError($result)) {

			echo json_encode(0);
		
		
	}else{
	

		echo json_encode(1);
	}
}
else if(isset($_GET['beaconID'])){
	include 'FileMaker.php';
	$fm = new FileMaker("salesDemo.fmp12","75.98.16.6","Admin","jklmjklm");
	
	$rec = $fm->newFindCommand("beaconInteractions");
	$rec->addFindCriterion('beacon_id','='.$_GET['beaconID']);
	$result = $rec->execute();

	if (FileMaker::isError($result)) {

		echo json_encode(0);
		
		
	}else{
	
		$resp = $result->getRecords();
		$super = [];
		$count = 0;
		foreach ($resp as $record) {
        	$super[$count]['id'] =  $record->getField('id');
        	$super[$count]['userID'] =  $record->getField('user_id');
        	$super[$count]['date'] =  $record->getField('timeStamp');
        	$count++;
        }
		echo json_encode($super);
	
	}
}
