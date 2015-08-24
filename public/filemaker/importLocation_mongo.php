<?php
if(isset($_POST['id'])){

	$id = $_POST['id'];
	
	include 'FileMaker.php';
	$fm = new FileMaker("KTTC_Database.fmp12","199.38.217.147","Admin","streetsto");
	$rec = $fm->newFindCommand("streetsto_location");
	$rec->addFindCriterion('id',$id);
	$result = $rec->execute();
	
	if (FileMaker::isError($result)) {
		
	echo json_encode("bad");

	}else{
			$resp = $result->getRecords();
			$recID = $resp[0]->getRecordID();
			$super = [];
			$count = 0;
			foreach($resp as $record){
				$super['description'] = $record->getField('description');
				$super['tags'] = $record->getField('tags');
				$super['phone'] = $record->getField('phone');
				$super['hours'] = $record->getField('hours');
				$super['website'] = $record->getField('website');
				$super['img'] = $record->getField('img');
				$super['address_street1'] = $record->getField('address_street1');
				$super['address_street2'] = $record->getField('address_street2');
				$super['address_city'] = $record->getField('address_city');
				$super['address_province'] = $record->getField('address_province');
				$super['address_postal'] = $record->getField('address_postal');
				$super['address_country'] = $record->getField('address_country');
				$super['district'] = $record->getField('district');
				$count++;
			}
			$new = [
				'description'=>$super['description'],
				'tags' => $super['tags'],
				'phone' => $super['phone'],
				'hours' => $super['hours'],
				'website' => $super['website'],
				'img' => $super['img'],
				'address_street1' => $super['address_street1'],
				'address_street2' => $super['address_street2'],
				'address_city' =>$super['address_city'],
				'address_province' =>$super['address_province'],
				'address_postal' => $super['address_postal'],
				'address_country' => $super['address_country'],
				'district' => $super['district']
			];
			//print_r($new);
			echo json_encode($new);

			//echo json_encode($super);
	}

}
?>