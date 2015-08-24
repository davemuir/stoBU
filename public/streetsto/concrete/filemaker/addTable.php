<?php
include 'FileMaker.php';
if(isset($_POST['table'])){
	
	$resp = $_POST['table'];
	$lines = [];
	$num = count($resp);
	for($i=1;$i<$num;$i++){
		array_push($lines,$resp[$i]);
	}
	foreach($resp as $key=>$col){
		$line .=$col.',';		
	}

	 $fm = new FileMaker('test.fmp12', '192.168.128.136', 'Admin', 'hack123');	
	 $scripts = $fm->listScripts(); 
	 $file = fopen("table.csv","w");
	 fputcsv($file,$lines);
	 fclose($file);

	 $f = '192.168.128.157/table.csv';
	 $script = $fm->newPerformScriptCommand('test','importTable',$f);
	 $response = $script->execute();

	 echo json_encode($response);
	
}else{
	
	//$file = file_get_contents('http://192.168.128.157/filemaker/table.csv',NULL, NULL, 1,4);
	//if(isset($file)){
	 //var_dump($file);
	//}else{
	//echo 'nope';
	//}
	$file = fopen("table.csv","w");
	fputcsv($file,array('col1','col2'));
	  

	fclose($file); 

}
?>
