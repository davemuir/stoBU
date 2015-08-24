<?php
if(isset($_POST['email'])){
		include 'FileMaker.php';
		$jsonemail =  json_encode($_POST['email']);
		$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	    $rec = $fm->newFindCommand("streetsto_accounts");
		$rec->addFindCriterion('email',$jsonemail);
        $result = $rec->execute();
        if (FileMaker::isError($result)) {                      
	        echo json_encode(0);           
		
		}else{
			 $resp = $result->getRecords();
			 $recID = $resp[0]->getRecordID();
			  foreach ($resp as $record) {
				$cID =  $record->getField('concreteID');
				}    
			  $length = 8;
		      $password = "";
		        // define possible characters
		        $possible = "0123456789abcdfghjkmnpqrstvwxyz";
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
		      curl_setopt($ch, CURLOPT_URL,"http://sto.apengage.io/streetsto/index.php/streets_password/reset");
		      curl_setopt($ch,  CURLOPT_POST, 1);
		      curl_setopt($ch, CURLOPT_POSTFIELDS,"cID=".$cID."&pass=".$password);
		      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                                                                                                             $response = curl_exec ($ch);
		      curl_close ($ch);
		      //$response = json_decode($response);
   			  //echo json_encode($response);
				
				$data2 = [
				 'password' => $password
				];
				$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
				$rec = $fm->newEditCommand('streetsto_accounts',$recID,$data2);
				$result = $rec->execute();
				if (FileMaker::isError($result)) {      
					echo json_encode(0);
				}else{  
					$resp = $result->getRecords();
					echo json_encode(1);
				}
		}
}
?>