<?php
include 'FileMaker.php';
if($_POST['referee']){
	
	$data = [
		'referer' => $_POST['cID'],
		'referee' =>  $_POST['referee']
		
	];
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newAddCommand("streetsto_referrals",$data);
	$result = $rec->execute();

	if (FileMaker::isError($result)) {
		echo json_encode(0);
		exit;
	}else{
		$resp = $result->getRecords(); 
		foreach($resp as $rep){
			$fEmail = $rep->getField('streetsto_accounts::email');
		}
		

			$to = $_POST['referee'];
			$subject = 'Dear '.$_POST['referee'].', you have been invited to try Streets TO mobile app';
			$message = 'Visit this link to get the app on on the playstore.'. "\r\n" ."buy your key here - https://torontocitykey.com/shop/";
			$headers = 'From: '.$fEmail. "\r\n" .
	    	'Reply-To: webmaster@example.com' . "\r\n" .
	    	'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $message, $headers);


			
			echo json_encode($fEmail);

		

	}
}
?>
