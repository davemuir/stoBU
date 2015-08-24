<?php 
include 'FileMaker.php';
if($_POST['restaurant']){
	//$var = "restaurant set";
	//return var_dump($var);
	$resp = [];
	$name = $_POST['restaurant'];
	$layout = $_POST['layout'];
	$fm = new FileMaker("restaurants2.fmp12","192.168.128.136","Admin","streetsto");
	$request = $fm->newFindAllCommand($layout);
	$result = $request->execute();
	$records = $result->getRecords();
	         
	$fieldSet = [];
	foreach($records as $key){
	      $fields = $key->getFields();
	}
	$c = 0;
	foreach($records as $key){
	      
	      $fieldSet = [];
	      foreach($fields as $field){
		$fieldVal = $key->getField($field);
		if($field == "style"){
			$head = $fieldVal;
		}
		$fieldSet[$field] = $fieldVal;
	      }
	     
	      $resp{$head}[] = $fieldSet;
	      $c++;
	}
	echo json_encode($resp);

	//return var_dump($resp);
/*
	      $fieldSet = [];
	      foreach($records as $key){
		 array_push($fieldSet,$key);
	      }                                                                                                                                        array_push($resp,$fieldSet);
	                                      
	         echo json_encode($resp);
 */	
}else{
	//return "blah";	
	$fm = new FileMaker("restaurants2.fmp12","192.168.128.136","Admin","streetsto");
	 
	 $request = $fm->newFindAllCommand("default");

	 $result = $request->execute();

	 $records = $result->getRecords();
	
	
	
				
                                               
	
	 //echo json_encode($records);
?>
	<!--<iframe src="http://192.168.128.136/fmi/webd#restaurants2" style="width:700px;height:700px;"></iframe>-->
<?php
}	

?>
