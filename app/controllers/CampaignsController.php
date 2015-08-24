<?php
use Illuminate\Support\MessageBag;
use Illuminate\Console\Command;




class CampaignsController extends BaseController {

	public function __construct(){
        //this is a method of BaseController, if I comment out the line, it works fine
        //$this->getDays();
 	}

	public function index(){
		$user = Auth::user();
		$companyID = $user->companyID;
		$campaigns = Campaign::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		return View::make('/campaigns/index')->with('campaigns',$campaigns);
	}

	public function newCampaign(){
		$user = Auth::user();
		$companyID = $user->companyID;
		$perks = Perk::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		$beacons = Beacon::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		return View::make('/campaigns/new')->with('perks',$perks)->with('beacons',$beacons);
	}
	public function storeCampaign(){

		if($_POST){
			$user = Auth::user();
			$companyID = $user->companyID;
			if(isset($_POST['campaignID'])){

				//return 'no post';
				$campaign = Campaign::where('_id',$_POST['campaignID'])->get();
				$campaign->title = "bogus";
				$campaign->save();
				return $campaign;
			}else{
				$campaign = new Campaign;
			}
			
			$super = [];
			$enBeams =[];
			$exBeams =[];
			$beacons = [];
			$beaconArr = $_POST['beaconArr'];
			$beaconCount = 0;
			foreach($beaconArr as $beacon){
				$super['beacon'][$beaconCount]= $beacon;
				$beaconCount++;
			}
			if(isset($_POST['entryArr'])) {
				$entryArr = $_POST['entryArr'];
				$entryCount = 0;
				foreach($entryArr as $entry){
					$super['entry'][$entryCount] = $entry;
					
					//$beam = $entryArr[$entryCount][0];
					$enBeams[] =  $entryArr[$entryCount][0];
					//$ENTRY = $entryArr[$entryCount];
					$entryCount++;
				}
				$campaign->entry = $enBeams;
			}else{
				$campaign->entry = $enBeams;
			}

			if(isset($_POST['exitArr'])) {
				$exitArr = $_POST['exitArr'];
				$exitCount = 0;
				foreach($exitArr as $exit){
					$super['exit'][$exitCount]= $exit;
					$exBeams[] =  $exitArr[$exitCount][0];
					$exitCount++;
				}
				$campaign->exit = $exBeams;
			}else{
				$campaign->exit = $exBeams;
			}

			if(isset($_POST['beaconArr'])) {
				$beaconArr = $_POST['beaconArr'];
				$bCount = 0;
				foreach($beaconArr as $b){
					$super['beacons'][$bCount]= $b;
					$beacons[] =  $beaconArr[$bCount][0];
					$bCount++;
				}
				$campaign->beacons = $beacons;
			}
			$campaignName = $_POST['campaignName'];
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];

			$super['campaignName'] = $campaignName;
			$super['startDate'] = $startDate;
			$super['endDate'] = $endDate;
			
			//save the model for campaign
			$campaign->companyID = $companyID;
			$campaign->startDate = $startDate;
			$campaign->endDate = $endDate;
			$campaign->title = $campaignName;
			$campaign->save();

			//keen call
			$keenEvent = "newCampaign";
			$keenData = $campaign;
			
			$this->keenCurl($keenData,$keenEvent);

			return $campaign;
			
		}else{
			return 'no post';
		}
		
	}

	public function storeCampaignGet($beaconArr){
			return 'this';
	}
	public function editCampaign($campaignID){
		$user = Auth::user();
		$companyID = $user->companyID;
		$perks = Perk::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		$beacons = Beacon::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		$campaign = Campaign::where('_id',$campaignID)->get(); 
		return View::make('/campaigns/edit')->with('campaign',$campaign)->with('perks',$perks)->with('beacons',$beacons);
	}

	public function updateCampaign($campaignID){
		
			
		if($_POST){
			$user = Auth::user();
			$companyID = $user->companyID;
			$campaign = Campaign::where('_id',$campaignID)->get()->first();
			
			$super = [];
			$enBeams =[];
			$exBeams =[];
			$beacons = [];
			$beaconArr = $_POST['beaconArr'];
			$beaconCount = 0;
			foreach($beaconArr as $beacon){
				$super['beacon'][$beaconCount]= $beacon;
				$beaconCount++;
			}
			if(isset($_POST['entryArr'])) {
				$entryArr = $_POST['entryArr'];
				$entryCount = 0;
				foreach($entryArr as $entry){
					$super['entry'][$entryCount] = $entry;
					
					//$beam = $entryArr[$entryCount][0];
					$enBeams[] =  $entryArr[$entryCount][0];
					//$ENTRY = $entryArr[$entryCount];
					$entryCount++;
				}
				$campaign->entry = $enBeams;
			}else{
				$campaign->entry = $enBeams;
			}

			if(isset($_POST['exitArr'])) {
				$exitArr = $_POST['exitArr'];
				$exitCount = 0;
				foreach($exitArr as $exit){
					$super['exit'][$exitCount]= $exit;
					$exBeams[] =  $exitArr[$exitCount][0];
					$exitCount++;
				}
				$campaign->exit = $exBeams;
			}else{
				$campaign->exit = $exBeams;
			}
			
			if(isset($_POST['beaconArr'])) {
				$beaconArr = $_POST['beaconArr'];
				$bCount = 0;
				foreach($beaconArr as $b){
					$super['beacons'][$bCount]= $b;
					$beacons[] =  $beaconArr[$bCount][0];
					$bCount++;
				}
				$campaign->beacons = $beacons;
			}
			$campaignName = $_POST['campaignName'];
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];

			$super['campaignName'] = $campaignName;
			$super['startDate'] = $startDate;
			$super['endDate'] = $endDate;
			
			$campaign->companyID = $companyID;
			$campaign->startDate = $startDate;
			$campaign->endDate = $endDate;
			$campaign->title = $campaignName;
			$campaign->save();

			//save the model for campaign
			$keenData = $campaign;
			$keenEvent = "updatedCampaign";
			$this->keenCurl($keenData,$keenEvent);

			return $campaign;

		}else{
			return 'no post';
		}
		
	}
}

