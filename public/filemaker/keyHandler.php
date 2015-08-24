<?php
if($_POST['key_no']){

	$key = $_POST['key_no'];
	$cid = $_POST['cid'];

	include 'FileMaker.php';
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newFindCommand("streetsto_accounts");
	$rec->addFindCriterion('concreteID',$cid);
	$result = $rec->execute();
	$resp = $result->getRecords();
	$recID = $resp[0]->getRecordID();
	$key = (string)$key;
	$data = [
				"key_no"=>$key
	];

	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newEditCommand('streetsto_accounts',$recID,$data);
	$rec->setScript('verify');
	$result = $rec->execute();
	if (FileMaker::isError($result)) {
		echo 'error updating';
	}else{
		$resp = $result->getRecords();
		
		//get error code from filemaker and add to array
		foreach ($resp as $record){
			$super =  $record->getField('errorCode');
		}
		$super = $super +0;
		echo json_encode($super);
	}

}else{
	echo json_encode(0);
}

?>