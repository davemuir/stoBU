	<?php
if($_POST['type']){
	include 'FileMaker.php';
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newFindCommand("list_locations");
	$rec->addFindCriterion('pid',$_POST['type']);
	$result = $rec->execute();
	$resp = $result->getRecords();		
	 $super = [];
	foreach ($resp as $record) {
	$super[$record->getField('id')] =  $record->getField('location');
	}
	echo json_encode($super);

}elseif($_POST['lid']){
	
	include 'FileMaker.php';	
	$lid = $_POST['lid'];
	
	$super = [];
	$response = [];
	//do attriubutes for location
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newFindCommand("streetsto_location");
	$rec->addFindCriterion('name',$lid);
	$attr = $rec->execute();
	$resp = $attr->getRecords();

	$attrs = [];
	$count = 0;
	foreach ($resp as $record){
		$attrs[$count]["location"]  =  $record->getField('name');
		$attrs[$count]["map"] =  $record->getField('map');
		$attrs[$count]["phone"] =  $record->getField('phone');
		$attrs[$count]["hours"] =  $record->getField('hours');
		$attrs[$count]["img"] =  $record->getField('img');
		$attrs[$count]["address"] =  $record->getField('address');
		$attrs[$count]["latitude"] =  $record->getField('latitude');
		$attrs[$count]["longitude"] =  $record->getField('longitude');	
		$attrs[$count]["description"] =  $record->getField('description');	
		$attrs[$count]["tags"] =  $record->getField('tags');
		$count++;
	}

	echo json_encode($attrs);
}else{
include 'FileMaker.php';
$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
$rec = $fm->newFindAllCommand("list_categories");
//$rec->addFindCriterion('id','null');
$result = $rec->execute();
$resp = $result->getRecords();
 $super = [];
        foreach ($resp as $record) {
		                $super[$record->getField('id')] =  $record->getField('category');
				        }
echo json_encode($super);
}

?>
