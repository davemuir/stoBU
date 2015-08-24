<?php
use Illuminate\Support\MessageBag;
class BeaconsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/  



public function __construct(){
        //this is a method of BaseController, if I comment out the line, it works fine
        //$this->getDays();
  }
  
public function view(){
    $user = Auth::user();
    $beacons = Beacon::where('companyID',$user->companyID)->get();
    return View::make('beacons/index')->with('user', $user)->with('beacons',$beacons);
	
}
  public function createBeacon($uuid,$major,$minor,$alias,$location){
      $user = Auth::user();
      $companyID = $user->companyID;

      $beacon = new Beacon;
      $beacon->major = $major;
      $beacon->minor = $minor;
      $beacon->uuid = $uuid;
      $beacon->alias = $alias;
      $beacon->location = $location;
      $beacon->companyID = $companyID;
      $beacon->save();

      /*
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,"http://sto.apengage.io/filemaker/location_filemaker.php");
      curl_setopt($ch,  CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,"uuid=".$beacon->uuid."&major=".$beacon->major."&minor=".$beacon->minor."&alias=".$beacon->alias."&companyID=".$beacon->companyID."&beaconID=".$beacon->_id);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                                                                                                             $response = curl_exec ($ch);
      curl_close ($ch);
      */
      //keen call
      $keenEvent = "newBeacon";
      $keenData = $beacon;
      
      $this->keenCurl($keenData,$keenEvent);
      return $companyID;
    
  }
  public function destroyBeacon($id){
    $beacon = Beacon::where('_id','=',$id)->get()->first();
    $beacon->delete();
    return Redirect::to('beacons');
  }
  public function updateBeacon(){
    if($_POST){
      $beaconID = $_POST['beaconID'];
      $beacon = Beacon::where('_id',$beaconID)->get()->first();
      $beacon->location = $_POST['locationID'];
      $beacon->alias = $_POST['beaconAlias'];
      $beacon->uuid = $_POST['beaconUUID'];
      $beacon->major = $_POST['beaconMajor'];
      $beacon->minor = $_POST['beaconMinor'];
      $beacon->save();
      return 'stored';
    }
    
  }
  public function import(){
     //filemaker stuff(added from filemaker)
    /*if($_POST){
      $locationID = $_POST['locationID'];
      $uuid = $_POST['uuid'];
      $major = $_POST['major'];
      $minor = $_POST['minor'];
      $alias = $_POST['alias'];
      $beaconID = $_POST['beaconID'];
      $locationName = $_POST['name'];

      $beacon = new Beacon;
      $beacon->major = $major;
      $beacon->minor = $minor;
      $beacon->proximity_uuid = $uuid;
      $beacon->alias = $alias;
      $beacon->beaconID = $beaconID;
      $beacon->locationName = $locationName;
      $beacon->branchID = $locationID;
      $beacon->save();

      return "beacon stored";
    }
      */
  }
  public function editBeacon($beaconID){
      $user = Auth::user();
      $beacon = Beacon::where('_id',$beaconID)->get()->first();
      $companyID = $user->companyID;
      $locations = Location::where('companyID',$user->companyID)->get();

      return View::make('beacons/edit')->with('locations',$locations)->with('beacon',$beacon);
  }  
   public function setupBeacon(){
      $user = Auth::user();
      $locations = Location::where('companyID',$user->companyID)->get();
      $companyID = $user->companyID;

      return View::make('beacons/setup')->with('locations',$locations);
    
  }
  public function addBeacon(){
    //filemaker stuff(updated from filemaker)
    
  }

}
