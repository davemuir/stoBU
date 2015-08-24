<?php
use Illuminate\Support\MessageBag;
use Illuminate\Console\Command;



class LocationsController extends BaseController {
	public function index(){
		$user = Auth::user();
		$companyID = $user->companyID;
		$beacons = Beacon::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		$locations = Location::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		return View::make('/locations/index')->with('beacons',$beacons)->with('locations',$locations);
	}
	public function newLocation(){
		$user = Auth::user();
		$companyID = $user->companyID;
		$beacons = Beacon::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		$locations = Location::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		return View::make('/locations/new')->with('beacons',$beacons)->with('locations',$locations);
	}
	public function editLocation($locationID){
		$user = Auth::user();
		$companyID = $user->companyID;
		$beacons = Beacon::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
		$location = Location::where('_id','=',$locationID)->orderBy('updated_at', 'desc')->get();
		return View::make('/locations/edit')->with('beacons',$beacons)->with('location',$location);
	}
	public function addLocation(){
		if($_POST){
			$user = Auth::user();
			$companyID = $user->companyID;
			$locationName = $_POST['locationName'];
			$beaconArr = $_POST['beaconArr'];
			$address = $_POST['address'];
			$super = [];
			$beacons = [];
			$location = new Location;	
			$location->name = $locationName;
			$location->companyID = $companyID;
			$location->address = $address;
			if(isset($_POST['beaconArr'])) {
				
				$bCount = 0;
				foreach($beaconArr as $b){
					$super['beacons'][$bCount]= $b;
					$beacons[] =  $beaconArr[$bCount][0];
					$bCount++;
				}
				$location->beacons = $beacons;
			}
			$location->save();
			return 'location stored';
		}
	}
	public function removeLocation(){
		if($_POST){
			$id = $_POST['id'];
			$location = Location::where('_id','=',$id)->get()->first();
			$location->delete();
			return 'location removed';
		}
	}
	public function updateLocation($locationid){
		if($_POST){
			$user = Auth::user();
			$companyID = $user->companyID;
			$locationName = $_POST['locationName'];
		
			$address = $_POST['address'];
			$super = [];
			$beacons = [];
			$location = Location::where('_id',$locationid)->get()->first();	
			$location->name = $locationName;
			$location->companyID = $companyID;
			$location->address = $address;

			$beaconArr = $_POST['beaconArr'];
			$beaconCount = 0;
			foreach($beaconArr as $beacon){
				$super['beacon'][$beaconCount]= $beacon;
				$beaconCount++;
			}

			if(isset($_POST['beaconArr'])) {
				$beaconArr = $_POST['beaconArr'];
				$bCount = 0;
				foreach($beaconArr as $b){
					$super['beacons'][$bCount]= $b;
					$beacons[] =  $beaconArr[$bCount][0];
					$bCount++;
				}
				$location->beacons = $beacons;
			}
			/*if(isset($_POST['beaconArr'])) {
				
				$bCount = 0;
				foreach($beaconArr as $b){
					$super['beacons'][$bCount]= $b;
					$beacons[] =  $beaconArr[$bCount][0];
					$bCount++;
				}
				$location->beacons = $beacons;
			}*/
			$location->save();
			return $location;
		}
	}
}

