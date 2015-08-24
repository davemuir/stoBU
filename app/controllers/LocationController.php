<?php
use Illuminate\Support\MessageBag;
class LocationController extends Controller {

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
  public function updateLocation(){
   $user = Auth::user();
   $location = Location::where('branchID','=',$user->locationID)->first();
   	//return $location;
   if(Input::get("description")){
   		$desc = Input::get("description");
   		$desc = json_encode($desc);
   		$location->description = $desc;
	}
  	if(Input::get('tag')) {
		//$tags =  explode( ' ', trim(Input::get('tag')) );
		$location->tags = Input::get('tag');
	}
	if(Input::get('image')){
	$location->img = Input::get('image');
	}
	if(Input::get('phone')){
	$location->phone = Input::get('phone');
	}
	if(Input::get('address')){
	$location->address_street1 = Input::get('address');
	}
	if(Input::get('district')){
	$location->district = Input::get('district');
	}
	if(Input::get('city')){
	$location->address_city = Input::get('city');
	}
	if(Input::get('country')){
	$location->address_country = Input::get('country');
	}
	if(Input::get('postal')){
	$location->address_postal = Input::get('postal');
	}
	if(Input::get('province')){
	$location->address_province = Input::get('province');
	}
	if(Input::get('hours')){
	$location->hours = Input::get('hours');
	}
	if(Input::get('website')){
	$location->website = Input::get('website');
	}
	
	$location->save();
	//$location = json_encode($location);
	//write to filemaker script
	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://198.1.96.237/filemaker/location_mongo.php");
		curl_setopt($ch,  CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"id=".$user->locationID."&location=".$location);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                                                                                                             $response = curl_exec ($ch);
		curl_close ($ch);

	
	//return $response;
	//exit;	

	return Redirect::to("profile");

  }   

}
