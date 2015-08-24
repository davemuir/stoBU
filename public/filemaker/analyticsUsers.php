<?php
if(isset($_POST['beacons'])){

	include 'FileMaker.php';
	$fm = new FileMaker("salesDemo.fmp12","75.98.16.6","Admin","jklmjklm");
	$beaconArr = $_POST['beacons'];

	$ultimate = [];
	$uCount = 0;
	foreach($beaconArr as $beacon){
		$id = $beacon['_id'];
		$rec = $fm->newFindCommand("beaconInteractions");
		$rec->addFindCriterion('beacon_id','='.$id);
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
	        	$super[$count]['beaconID'] =  $record->getField('beacon_id');
	        	$super[$count]['alias'] =  $record->getField('beacons::alias');
	        	$super[$count]['gender'] =  $record->getField('demo_users::gender');
	        	$count++;
	        }
			//echo json_encode($super);
			
		}
		$ultimate[$uCount] = $super;
		$uCount++;
	}
	echo json_encode($ultimate);
	exit;
		

		
}
