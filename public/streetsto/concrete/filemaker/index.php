<?php
include 'FileMaker.php';
if(isset($_POST['dbo'])){
	 $dbo = $_POST['dbo'];
	 $dboName = $dbo[0];
	 $dboHost = $dbo[1];
	$dboUser = $dbo[2];
	 $dboPass = $dbo[3];
	 if(isset($_POST['layout'])){
	 $dboLayout = $_POST['layout'];	
	 }else{
		 $dboLayout = $dbo[4];
	 }
	$fm = new FileMaker($dboName,$dboHost,$dboUser,$dboPass);
if(isset($_POST['choices'])){
	
	$resp = [];
	$choices =  $_POST['choices'];
	$fields = $_POST['fields'];
	;
	
	$fm = new FileMaker($dboName,$dboHost,$dboUser,$dboPass);
	//$request = $fm->newFindAllCommand('test');
	$request = $fm->newFindCommand($dboLayout);
	//$request =$fm->newFindRequest('test');
	$counted = count($fields);
	for($c = 0;$c<$counted;$c++){	
		$request->addFindCriterion($fields[$c],$choices[$c]);
	}
	//$result = $request->execute();
	$result = $request->execute();
	$records = $result->getRecords();
	//var_dump($choices);
	$fieldSet = [];
	foreach($records as $key){
		
	   	//$iter = 0;
		//foreach($fields as $field){
	   	    	
		//	$fieldVal = $key->getField($field);
		//	if($fieldVal == $choices[$iter]){
								
				array_push($fieldSet,$key);
				
		//	}
		//     $iter++;
		//}
		
		
	}
	array_push($resp,$fieldSet);
	echo json_encode($resp);
			
}else{
$resp = [];       
$fm = new FileMaker($dboName,$dboHost,$dboUser,$dboPass);
$request = $fm->newFindAllCommand($dboLayout);
$result = $request->execute();
$records = $result->getRecords();


//$fieldSet = [];
//foreach($records as $key){
//	$fields = $key->getFields();
//}
//foreach($records as $key){
//	$fieldSet = [];
//	foreach($fields as $field){
//	 $fieldVal = $key->getField($field);
//	 array_push($fieldSet,$fieldVal);
//	}
//	array_push($resp,$fieldSet);
//}
//echo json_encode($resp);

$fieldSet = [];
        foreach($records as $key){
		 array_push($fieldSet,$key);
		              	                                                                                                                                                                                   
	 }
	array_push($resp,$fieldSet);
        echo json_encode($resp);
		
//echo json_encode($records);
}


}//end if db connection supplied dbo
?>


