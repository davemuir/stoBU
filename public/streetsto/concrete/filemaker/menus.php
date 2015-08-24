<?php
if($_POST['location']){
	        include 'FileMaker.php';
		$location = $_POST['location'];
		$title = $_POST['title'];
		$menu = $_POST['menu'];
		
		$super = [];
		//do menu list
		$fm = new FileMaker($location.".fmp12","192.168.128.136","Admin","streetsto");			
		$rec = $fm->newFindCommand($title);
		$rec->addFindCriterion('lid',$menu);
		$result = $rec->execute();
		$resp = $result->getRecords();
		//array_push($resp);
		echo json_encode($resp);

		
}else{
echo json_encode('nope');
}

?>
