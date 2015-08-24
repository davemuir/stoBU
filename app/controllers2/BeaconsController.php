<?php
use Illuminate\Support\MessageBag;
class BeaconsController extends Controller {

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




public function view(){
    $user = Auth::user();
    $company = Company::all();
    $branches = [];
    foreach($company as $branch){
      $companyID = $branch['_id'];
      //look for branches of this id
      $branched = Branch::where('companyID','=',$companyID)->get();
      $count = count($branched);

      if($count > 0 ){
        //multi branch it
        foreach($branched as $b){
          $branches[$b['_id']] = $branch['name'].'-'.$b['title'];
        }
        
      }else{
        $branches[$companyID] = $branch['name'];
      }
    }
    $beacons = Beacon::all();
    return View::make('beacons/index')->with('user', $user)->with('branches', $branches)->with('beacons',$beacons);
	
}

  public function updateBeacon(){
    if($_POST){
     
      $locationID = $_POST['locationID'];
      $uuid = $_POST['uuid'];
      $major = $_POST['major'];
      $minor = $_POST['minor'];
      $alias = $_POST['alias'];
      $locationName = $_POST['name'];
      $beaconID = $_POST['beaconID'];

      $beacon = Beacon::where('beaconID','=',$beaconID)->get()->first();
      $beacon->major = $major;
      $beacon->minor = $minor;
      $beacon->proximity_uuid = $uuid;
      $beacon->alias = $alias;
      $beacon->beaconID = $beaconID;
      $beacon->locationName = $locationName;
      $beacon->branchID = $locationID;
      $beacon->save();

      return "beacon updated";
    }
  }
  public function import(){
    if($_POST){
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
  } 


}
