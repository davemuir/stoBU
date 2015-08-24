<?php
if(isset($_POST['firstname'])){

	include 'FileMaker.php';
	$uname = str_replace('"',"",$_POST['email']);
	$data = [
	
			"key_no"=>intval($_POST['key_no']),
           "fname"=>$_POST['firstname'],	
	       "lname"=>$_POST['lastname'],
	       "email"=>$_POST['email'],
	       "password"=>$_POST['password'],
	       "username"=>$_POST['email']
	];
	
	//$serial = (string)$data["key_no"];
	//echo $_POST['key_no'];
	//exit;
	
	$jsonemail =  json_encode($_POST['email']);
	$email = $_POST['email'];
	//return false;
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	                $rec = $fm->newFindCommand("streetsto_accounts"); 
	                $rec->addFindCriterion('email',$jsonemail);
					$result = $rec->execute();
			if (FileMaker::isError($result)) {
				  $fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
				  $rec = $fm->newAddCommand("streetsto_accounts",$data);
				  $rec->setScript('verify');
				  $result = $rec->execute();
				  $records = $result->getRecords();
				  //foreach($records as $record){
				//	$recID = $record->getField('id');
				 // }
				  $recID = intval($recID);
				  $recID = $records[0]->getRecordId();
				  //$resp = $records[0];
				  //$resp = $resp['_impl'];
				  //$resp = $resp['_fields'];
			//	  echo json_encode($recID);
		
				$ch = curl_init();
			 	curl_setopt($ch, CURLOPT_URL,"http://sto.apengage.io/streetsto/index.php/streets_register/register");
				curl_setopt($ch,  CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,"username=".$uname."&email=".$uname."&password=".$_POST['password']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec ($ch);
				curl_close ($ch);
				
			
				//echo $response;
				$pieces = explode(",", $response);
			//	echo $pieces[0];
			//	echo $pieces[1];
				$data2 = [
					"concreteID" => intval($pieces[0]),
					"password" => $_POST['password']//substr($pieces[1],0,60)
				];
				$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
				$rec = $fm->newEditCommand('streetsto_accounts',$recID,$data2); 
				$result = $rec->execute(); 
				$resp = $result->getRecords();
	

				//get error code from filemaker and add to array
				foreach ($resp as $record){
					$code =  $record->getField('errorCode');
				}
				
				/*mysql_connect('parsedata.com', 'parsedat_ap1', 'blackcomb1981') or die('Could not connect: ' . mysql_error());
				
	                        mysql_select_db('parsedat_apbeacon') or die('Could not select database');
				$query = 'INSERT INTO ap1inout '.'(user_id,name,action) '.
				'VALUES ( "'.$resp[0]->getField('id').'", "'.$resp[0]->getField('fname').' '.$resp[0]->getField('lname').'", 0 )';
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
				*/	
					$code = $code+0;
	     			echo json_encode($code);
			}
			else{	
				echo json_encode(0);
			}
			
		
	//create this record if the script there are no others like it,
	//include 'FileMaker.php';
	//$fm = new FileMaker("streetstoaccounts.fmp12","192.168.128.136","Admin","streetsto");
	//$rec = $fm->newAddCommand("streetsto_accounts",$data);
	//$result = $rec->execute();
	//$resp = $result;
			//echo json_encode($resp);
	//needs to hit concrete for a registration record
}
?>
