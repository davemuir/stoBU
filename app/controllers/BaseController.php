<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	/**
	 * Setup the keen call used by the controllerS EXTENDING BASECONTROLLER.
	 *  Will Curl the object sent to function to keen for tracking
	 * @return void
	 */
	protected function keenCurl($keenData,$keenEvent){
		
		
          $masterKey = 'EBB50E9E75C517B0163E95B58D9D64F4';
          $projectId = '55ae574890e4bd376c52ba71';
          $writeKey = 'd333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8';
          $readKey = 'b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9';

          //$companyID = '54ca6045e11d53de7707109c';
          $headers = array();
          $headers[] = 'Authorization:'.$masterKey;
          $headers[] = 'Content-Type: application/json';
          $headers[] = "Accept:application/json";
          //encode the object as data
          //should also specify what action we are doing ie. LOGIN vs Campaign Created vs. Beacon Created etc.
          $data = '{
                "'.$keenEvent.'":'.json_encode($keenData).' 
           }';

          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL,"https://api.keen.io/3.0/projects/".$projectId."/events/".$keenEvent."?api_key".$writeKey);
          curl_setopt($ch,  CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);                                                                                                                                                                                               $response = curl_exec ($ch);
          curl_close ($ch);

	}
  //used for raw analytics page
	protected function keenCSV1($keenEvent,$companyID){
		
          $masterKey = 'EBB50E9E75C517B0163E95B58D9D64F4';
          $projectId = '55ae574890e4bd376c52ba71';
          $writeKey = 'd333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8';
          $readKey = 'b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9';

          $headers = array();
          $headers[] = 'Authorization:'.$readKey;
          $headers[] = 'Content-Type: application/json';
          $headers[] = "Accept:application/json";
          //encode the object as data
          //should also specify what action we are doing ie. LOGIN vs Campaign Created vs. Beacon Created etc.
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL,"https://api.keen.io/3.0/projects/".$projectId."/queries/extraction?api_key=".$readKey."&event_collection=".$keenEvent);
          //curl_setopt($ch,  CURLOPT_POST, 1);
          //curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);                                                                                                                                                                                               $response = curl_exec ($ch);
          curl_close ($ch);
       
          $json_file = $response;
          $jfo = json_decode($json_file);
          $res = $jfo->result;
          $csvStr = "";
          //return $response;
          $csvHead = 'img, companyID, fName, lName, date, hour, beaconID, loginID';
         
          echo $csvHead;
          echo("\n");
          foreach($res as $event){
            $hour = substr($event->keen->timestamp,-13,2);//2015-07-30T16:55:20.148Z
            echo $event->img.','.$event->companyID.','.$event->fName.','.$event->lName.','.$event->timestamp.','.$hour.','.$event->beaconID.','.intval($event->loginID);
            echo("\n");
          }
	}
  
  protected function keenCSV2($keenEvent,$companyID){
    
    
          $masterKey = 'EBB50E9E75C517B0163E95B58D9D64F4';
          $projectId = '55ae574890e4bd376c52ba71';
          $writeKey = 'd333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8';
          $readKey = 'b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9';

          $headers = array();
          $headers[] = 'Authorization:'.$readKey;
          $headers[] = 'Content-Type: application/json';
          $headers[] = "Accept:application/json";

          $data = '{
                "event_collection":"'.$keenEvent.'",
                "filters":[{
                  "property_name":"companyID",
                  "operator":"eq",
                  "property_value":"'.$companyID.'"
                }]
           }';

          //encode the object as data
          //should also specify what action we are doing ie. LOGIN vs Campaign Created vs. Beacon Created etc.
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL,"https://api.keen.io/3.0/projects/".$projectId."/queries/count");
          curl_setopt($ch,  CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);                                                                                                                                                                                               $response = curl_exec ($ch);
          curl_close ($ch);
          //return $response;
          $tags = implode(',', $response);
         return $tags;
  }
  
}
