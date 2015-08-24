<?php
use Illuminate\Support\MessageBag;
class AnalyticsController extends Controller {

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
	    	return View::make('/analytics/index')->with('beacons',$beacons)->with('company',$company)->with('perks',$perks);
	}else{
			$id = $user->companyID;
			$company = Company::find($id);
			$perks = Perk::where('state','=',1)->get();
	    	$beacons = Beacon::all();
	    	return View::make('/analytics/index')->with('beacons',$beacons)->with('company',$company)->with('perks',$perks);
	}
	
}

}
