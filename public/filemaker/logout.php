<?php
include 'FileMaker.php';
if(isset($_POST)){

		$id = $_POST['cID'];
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://sto.apengage.io/streetsto/index.php/streets_register/logout");
		curl_setopt($ch,  CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"cID=".$id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec ($ch);
		curl_close ($ch);
		
	
		echo $response;
}else{
	echo json_encode('empty string');
}
?>
