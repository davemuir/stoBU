<?php
use Illuminate\Support\MessageBag;
class AnalyticsController extends BaseController {

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
	$companyID = $user->locationID;
	if($user->user_access != "Admin"){
			$id = $user->companyID;
			$company = Company::find($id);
			$perks = Perk::where('companyID','=',$id)->where('state','=',1)->get();
	    	$beacons = Beacon::where('branchID','=',$companyID)->get();

	    	//$keenEvent = "newBeam";
           //$keenAnalytic = $this->keenQuery($keenEvent);
            //$keenAnalytic = json_encode($keenAnalytic);
	    	return View::make('/analytics/index')->with('beacons',$beacons)->with('company',$company)->with('perks',$perks);//->with('keenAnalytic',$keenAnalytic);
	}else{
			$id = $user->companyID;
			$company = Company::find($id);
			$perks = Perk::where('state','=',1)->get();
	    	$beacons = Beacon::all();

	    	//$keenQuery = "count";
	    	//$keenEvent = "newBeam";
            //$keenAnalytic = $this->keenQuery($keenEvent,$keenQuery);
            //$keenAnalytic = json_encode($keenAnalytic);
	    	return View::make('/analytics/index')->with('beacons',$beacons)->with('company',$company)->with('perks',$perks);//->with('keenAnalytic',$keenAnalytic);
	}
	
}

public function raw(){

	$user = Auth::user();
	$companyID = $user->locationID;
	return View::make('/analytics/raw')->with('companyID',$companyID);
	
}

public function csvTwo($companyID){
	//return $companyID;
	$keenEvent = "enterBeaconRegion";	
	return $this->keenCSV1($keenEvent,$companyID);
	//return $companyID;
	//returns a page not csv format
	//return View::make('/analytics/csvconvert')->with('companyID',$companyID);
}

}
