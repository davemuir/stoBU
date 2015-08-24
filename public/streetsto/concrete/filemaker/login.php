<?php
if(isset($_POST['email'])){

	//facebook login

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];

	$uuid = $_POST['uuid'];
	$email = str_replace('"', '',$_POST['email']);
	$jsonemail =  json_encode($_POST['email']);
	$uname = $email;
	$data = [
		[0=>$email],
		[1=>$uuid]
	];
	$fields = [
		[0=>"email"],
		[1=>"uuid"]
	];

	
	
 	# Filter through rows and echo desired information
	#                                   # while ($row = mysql_fetch_object($result)) {
	#                                           echo $row->name; 
	#                                     }
	include 'FileMaker.php';
	$fm = new FileMaker("streetstoaccounts.fmp12","192.168.128.136","Admin","streetsto");
	$rec = $fm->newFindCommand("streetsto_accounts");
	$rec->addFindCriterion('email',$jsonemail);
	$result = $rec->execute();
	if (FileMaker::isError($result)) {

		$data = [
			"uuid" => $uuid,
			"email"=> $email,
			"fname"=> $fname,
			"lname"=> $lname
		];
		$fm = new FileMaker("streetstoaccounts.fmp12","192.168.128.136","Admin","streetsto");
		$rec = $fm->newAddCommand("streetsto_accounts",$data);
	        $result = $rec->execute();
		$records = $result->getRecords();
	
		$recID = $records[0]->getRecordId();
   		//create a temp password for the form and email to them to use if they wish not to login via facebok
		 $length = 8;
		 $password = "";
		        // define possible characters
		 $possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		 $i = 0;
		 // add random characters to $password until $length is reached
		 while ($i < $length) {
		      // pick a random character from the possible ones
	              $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			 // we don't want this character if it's already in the password
                      if (!strstr($password, $char)) {
			      $password .= $char;
			      $i++;
			 }
		}
	       	$ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"http://ec2-54-174-18-220.compute-1.amazonaws.com/streetsto/index.php/streets_register/register");
                curl_setopt($ch,  CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"username=".$uname."&email=".$email."&password=".$password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                                                                                                             $response = curl_exec ($ch);
		curl_close ($ch);
		
		//echo json_encode($response);
		//return false;
		$pieces = explode(',',$response);
		$data2 = [
			"concreteID" => intval($pieces[0]),
			"username" => $pieces[1],
			"password" => $password//substr($pieces[1],0,60)
		];
                                $fm = new FileMaker("streetstoaccounts.fmp12","192.168.128.136","Admin","streetsto");
                                $rec = $fm->newEditCommand('streetsto_accounts',$recID,$data2);
		                $result = $rec->execute();
				 $resp = $result->getRecords();
		                $super = [];
		                foreach ($resp as $record) {
			                        $super['cID'] =  $record->getField('concreteID');
				                $super['cEmail'] =  $record->getField('email');
				}		
				echo json_encode($super);
	}else{
		$resp = $result->getRecords();
		$recID = $resp[0]->getRecordID();
		foreach($resp as $rep){
			$curuuid = $rep->getField('uuid');
		}
		if($curuuid !== $uuid){
			$data2 = [
				"uuid"=>$uuid
			];
			$fm = new FileMaker("streetstoaccounts.fmp12","192.168.128.136","Admin","streetsto");
			$rec = $fm->newEditCommand('streetsto_accounts',$recID,$data2);
			$result = $rec->execute();
			$resp = $result->getRecords();
	
			  $super = [];

			  foreach ($resp as $record) {
				$super['cID'] =  $record->getField('concreteID');
				$super['cEmail'] =  $record->getField('email');
			  }
		echo json_encode($super);
		}else{	
			
		$super = [];


			foreach ($resp as $record) {
				$super['cID'] =  $record->getField('concreteID');
				$super['cEmail'] =  $record->getField('email');
			}
	
		//write sql log in  
	   	
			mysql_connect('parsedata.com', 'parsedat_ap1', 'blackcomb1981') or die('Could not connect: ' . mysql_error());

			mysql_select_db('parsedat_apbeacon') or die('Could not select database');
			$query = 'INSERT INTO ap1inout '.'(user_id,name,action) '.
		       'VALUES ( "'.$resp[0]->getField('id').'", "'.$resp[0]->getField('fname').' '.$resp[0]->getField('lname').'", 1 )';
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
			echo json_encode($super);                                                                                                                       
		}
	}
	
}
if(isset($_POST['loginemail'])){


	//$login = $_POST['login'];
	//$email = ($_POST['login'] == "true" ? $_POST['loginemail']: $login['email']);
	//$password = ($_POST['login'] == "true" ? $_POST['password']: $login['password']);

	$password = $_POST['password'];
	//$email = str_replace('"',"",$_POST['loginemail']);	
	$email = filter_var($_POST['loginemail'], FILTER_SANITIZE_EMAIL);
	$emails = explode('@',$email);	
		//echo $emails[0];
	$email = $emails[0];

	include 'FileMaker.php';
	        $fm = new FileMaker("streetstoaccounts.fmp12","192.168.128.136","Admin","streetsto");
	        $rec = $fm->newFindCommand("streetsto_accounts");

		$rec->addFindCriterion('email',$email);
//		$rec->addFindCriterion('password',$password);
   	        $result = $rec->execute();
                $resp = $result->getRecords(); 
                $super = [];
		foreach ($resp as $record){
			$super['password'] =  $record->getField('password');
			$super['cID'] =  $record->getField('concreteID');
			$super['cEmail'] =  $record->getField('email');
		}
		mysql_connect('parsedata.com', 'parsedat_ap1', 'blackcomb1981') or die('Could not connect: ' . mysql_error());

                mysql_select_db('parsedat_apbeacon') or die('Could not select database');
                $query = 'INSERT INTO ap1inout '.'(user_id,name,action) '.
		 'VALUES ( "'.$resp[0]->getField('id').'", "'.$resp[0]->getField('fname').' '.$resp[0]->getField('lname').'", 2 )';
	         $result = mysql_query($query) or die('Query failed: ' . mysql_error());
	                        
	                        
echo json_encode($super);
}//else{
//echo json_encode('no post here');
//}




