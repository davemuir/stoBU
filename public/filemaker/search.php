<?php
include 'FileMaker.php';
$super = [];
//tags
$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
$rec = $fm->newFindCommand("streetsto_location");
$rec->addFindCriterion('tags',$_POST['term']);
$result = $rec->execute();
if (FileMaker::isError($result)) {
	$data = [];
	 array_unshift($data,'No Results in Tags');
	 //echo json_encode($data);

}else{
	$records = $result->getRecords();
	$data = [];
	$count = 0;
	foreach($records as $record){
		$data[$count]["location"] = $record->getField('id');
		$data[$count]["locationName"] = $record->getField('name');
		$data[$count]["description"] = $record->getField('description');
		 $data[$count]["tags"] = $record->getField('tags');
		$count++;
	}
	$dataCount = count($data);
	array_unshift($data,$dataCount.' Results In Tags');
	//echo json_encode($data);
}
$super['tags'] = $data;

$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
$rec = $fm->newFindCommand("streetsto_location");
$rec->addFindCriterion('name',$_POST['term']);
$result = $rec->execute();
if (FileMaker::isError($result)) {
	        $data = [];
		         array_unshift($data,'No Results in Locations');
		         //echo json_encode($data);

}else{
	$records = $result->getRecords();
	$data = [];
	$count = 0;
	foreach($records as $record){
		$data[$count]["location"] = $record->getField('id');
		$data[$count]["locationName"] = $record->getField('name');
		$data[$count]["description"] = $record->getField('description');
		$data[$count]["tags"] = $record->getField('tags');
		$count++;
	}
	$dataCount = count($data);
       	array_unshift($data,$dataCount.' Results In Locations');
	//echo json_encode($data);
}
$super['locs'] = $data;
echo json_encode($super);
?>
