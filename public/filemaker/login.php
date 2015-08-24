<?php
if(isset($_POST['registration'])){

	include 'FileMaker.php';
	$fm = new FileMaker("salesDemo.fmp12","75.98.16.6","Admin","jklmjklm"); //199.38.217.147

	if($_POST['registration'] == "form"){
		//put them in
		$email =  json_encode($_POST['email']);
		$rec = $fm->newFindCommand("demo_users");
		$rec->addFindCriterion('email','='.$email);
		$result = $rec->execute();

		//print_r($result);
		//exit;


		if (FileMaker::isError($result)) {

			if('male' == $_POST['gender'] || 'Male' == $_POST['gender']){
			$img = 'http://sto.apengage.io/img/male.png';
			}else{
				$img = 'http://sto.apengage.io/img/female.png';
			}
			$arr = [
					'firstName' => $_POST['fName'],
					'lastName' => $_POST['lName'],
					'gender' => $_POST['gender'],
					'img' => $img,
					'password' => $_POST['password'],
					'email' => $_POST['email']
			];
			$rec = $fm->newAddCommand("demo_users",$arr);
			$result = $rec->execute();
			$records = $result->getRecords();
			$super = [];
			
			$super['firstName'] = $records[0]->getField('firstName');
			$super['lastName'] = $records[0]->getField('lastName');
			$super['loginID'] = $records[0]->getField('id');
			$super['gender'] = $records[0]->getField('male');
			$super['avatar'] = $records[0]->getField('img');
			$super['password'] = $records[0]->getField('password');

			echo json_encode($super);
			//print_r($super);
		}else{
			//email exists
			echo json_encode(0);
		}
		
	}
	
	if($_POST['registration'] == "fb"){

		//facebook handling
		$fbID = $_POST['fbID'];
		
		
		$rec = $fm->newFindCommand("demo_users");
		$rec->addFindCriterion('fbid',$fbID);
		$result = $rec->execute();
		//print_r($result);
		//exit;

		if (FileMaker::isError($result)) {
			//create them 
			$arr = [
				'fbid' => $fbID,
				'firstName' => $_POST['fName'],
				'lastName' => $_POST['lName'],
				'gender' => $_POST['gender'],
				'img' => $_POST['img'],
				'email' => $_POST['email']
			];
			$rec = $fm->newAddCommand("demo_users",$arr);
			$result = $rec->execute();
			$records = $result->getRecords();
			$super = [];
			
			$super['firstName'] = $records[0]->getField('firstName');
			$super['lastName'] = $records[0]->getField('lastName');
			$super['loginID'] = $records[0]->getField('id');
			$super['gender'] = $records[0]->getField('male');
			$super['avatar'] = $records[0]->getField('img');
			$super['fbID'] = $records[0]->getField('fbid');

			echo json_encode($super);

		}else{
			//log them in, they be in the system
			$resp = $result->getRecords();
			$recID = $resp[0]->getRecordID();

			$super = [];
			
			$super['firstName'] = $resp[0]->getField('firstName');
			$super['lastName'] = $resp[0]->getField('lastName');
			$super['loginID'] = $resp[0]->getField('id');
			$super['gender'] = $resp[0]->getField('male');
			$super['avatar'] = $_POST['img'];
			$super['fbID'] = $resp[0]->getField('fbid');

			echo json_encode($super);
		}
	}
	if($_POST['registration'] == "login"){
		//login from inputs
		$email =  json_encode($_POST['email']);
		$password = $_POST['password'];

		$request1 = $fm->newFindRequest("demo_users");
		$request2 = $fm->newFindRequest("demo_users");
		$request1->addFindCriterion('email','=='.$email);
		$request2->addFindCriterion('email','=='.$email);
		$request1->addFindCriterion('password','=='.$password);
		$request2->addFindCriterion('password','=='.$password);
		$compoundFind = $fm->newCompoundFindCommand("demo_users");
		$compoundFind->add(1, $request1);
		$compoundFind->add(2, $request2);
	
		$result = $compoundFind->execute();
		if (FileMaker::isError($result)) {
			//no login for that 
			echo json_encode(0);
		}else{
			$records = $result->getRecords(); 
            $super = [];
            $super['firstName'] = $records[0]->getField('firstName');
			$super['lastName'] = $records[0]->getField('lastName');
			$super['loginID'] = $records[0]->getField('id');
			$super['gender'] = $records[0]->getField('gender');
			$super['avatar'] = $records[0]->getField('img');
			$super['fbID'] = $records[0]->getField('fbid');
			echo json_encode($super);
		}

	}
	
}

