<?php
if($_POST['type']){
	include 'FileMaker.php';
	$fm = new FileMaker("streetsTo_List.fmp12","192.168.128.136","Admin","streetsto");
	$rec = $fm->newFindCommand("Menu");
	$rec->addFindCriterion('pid',$_POST['type']);
	$rec->addFindCriterion('tid','null');
	$result = $rec->execute();
	$resp = $result->getRecords();		
	 $super = [];
	foreach ($resp as $record) {
	$super[$record->getField('id')] =  $record->getField('type');
	}

	echo json_encode($super);

}elseif($_POST['location']){
	        include 'FileMaker.php';
        $fm = new FileMaker("streetsTo_List.fmp12","192.168.128.136","Admin","streetsto");
        $rec = $fm->newFindCommand("Menu");
        $rec->addFindCriterion('tid',$_POST['location']);
        $result = $rec->execute();
        $resp = $result->getRecords();          
         $super = [];
        foreach ($resp as $record) {
        $super[$record->getField('id')] =  $record->getField('type');
        }       

        echo json_encode($super);

}elseif($_POST['lid']){
	
	include 'FileMaker.php';	
	$lid = $_POST['lid'];
	//echo json_encode($lid);
	//return false;
	//$lid = preg_replace('/\\?.*/', '', $lid);
	$fm = new FileMaker("streetsto_menus.fmp12","192.168.128.136","Admin","streetsto");
	$rec = $fm->newFindCommand("streetsto_menus");
	$rec->addFindCriterion('location',$lid);
	$result = $rec->execute();
	$resp = $result->getRecords();
	$super = [];
	$count = 0;
              foreach ($resp as $record) {
	             $super[$count]["location"]  =  $record->getField('location');
		     $super[$count]["title"] =  $record->getField('title');
		     $super[$count]["otag"] =  $record->getField('tag');
		      $super[$count]["menu"] =  $record->getField('menu_id');
	      	$count++;
	      }
	//echo json_encode('hi');
	//return false;
	$response = [];
	//do attriubutes for location
	$fm = new FileMaker("streetsto_location.fmp12","192.168.128.136","Admin","streetsto");
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

	array_push($response,$super);
	array_push($response,$attrs);
	echo json_encode($response);
}else{
include 'FileMaker.php';
$fm = new FileMaker("streetsTo_List.fmp12","192.168.128.136","Admin","streetsto");
$rec = $fm->newFindCommand("Menu");
$rec->addFindCriterion('pid','null');

$result = $rec->execute();
$resp = $result->getRecords();
 $super = [];
        foreach ($resp as $record) {
		                $super[$record->getField('id')] =  $record->getField('type');
				        }
echo json_encode($super);
}

?>
