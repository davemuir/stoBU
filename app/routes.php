<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//get the user
$user =Auth::user();
//keen routes
//Route::any('/keen/{user}',  ["as" => "keen","uses" => "BaseController@keenCurl"]);

//login routes
Route::get('/',  ["as" => "Login","uses" => "UserController@view"]);
Route::get("/login", ["as" => "login","uses" => "UserController@view"]);
Route::post("/login", ["as" => "login form","uses" => "UserController@loginForm"]);
Route::get("/logout", ["as" => "user/logout", "uses" => "UserController@logoutAction"]);
Route::get("/register", ["as" => "Register", "uses" => "UserController@register"]);
Route::post("/register", ["as" => "register form","uses" => "UserController@registerForm"]);
	
	//public api and access routes
	Route::get('/beacons/global', function(){
		//global list of all beacons
		$beacons = Beacon::all();
		return $beacons;
	});
	/*Route::get('/analytic/csvConversion/1/{companyID?}', function($companyID){
		echo '<script>console.log("javascript");</script>';
		
	});*/
	Route::get('/api/beacon/{companyID?}/{uuid?}/{major?}/{minor?}', function($companyID,$uuid,$major,$minor){
		//company specific list of all beacons
		$beacons = Beacon::where('companyID',$companyID)->where('uuid',$uuid)->where('major',$major)->where('minor',$minor);
		$beacons = $beacons->get();
		return $beacons;
	});
	Route::get('/api/beaconid/{beaconID?}', function($beaconID){
		//company specific list of all beacons
		$beacons = Beacon::where('_id',$beaconID);
		$beacons = $beacons->get();
		return $beacons;
	});
	Route::get('/api/beacons/{companyID?}', function($companyID){
		//company specific list of all beacons
		$beacon = Beacon::where('companyID','=',$companyID)->orderBy('alias','descending')->get(); 
		return $beacon;
	});
	Route::get('/api/beams/{companyID?}', function($companyID){
		//company specific list of all beacons
		$beams = Perk::where('companyID','=',$companyID)->get();
		return $beams;
	});
	Route::get('/api/beam/{companyID?}/{beamID?}', function($companyID,$beamID){
		//company specific list of all beacons
		$beam = Perk::where('companyID',$companyID)->where('_id',$beamID)->get();
		return $beam;
	});
	Route::get('/api/users/{companyID?}', function($companyID){
		//company specific list of all beacons
		$user = User::where('companyID',$companyID)->get();
		return $user;
	});
	Route::get('/api/user/{companyID?}/{userID?}', function($companyID,$userID){
		//company specific list of all beacons
		$user = User::where('companyID',$companyID)->where('_id',$userID)->get();
		return $user;
	});
	Route::get('/api/locations/{companyID?}', function($companyID){
		//company specific list of all beacons
		$location = Location::where('companyID',$companyID)->get();
		return $location;
	});
	Route::get('/api/locationid/{locationID?}', function($locationID){
		//company specific list of all beacons
		$location = Location::where('_id',$locationID)->get()->first();
		return $location;
	});
	//beam/campaign get from campaign setup
	Route::get("/campaigns/getBeam/{beamID}" , function($beamID){
			$beam = Perk::where('_id','=',$beamID)->get()->first();
			return $beam;
	});
	//campaign get from campaign setup
	Route::get("/campaigns/getCampaign/{campaignID}" , function($campaignID){
			$campaign = Campaign::where('_id','=',$campaignID)->get()->first();
			return $campaign;
	});
	//all campaigns get
	Route::get("/api/campaigns/all/{companyID}" , function($companyID){
			$campaigns = Campaign::where('companyID','=',$companyID)->get();
			return $campaigns;
	});
	
	
//reset password
Route::any("/pwreset/reset/{code}", ["as" => "Reset Password", "uses" => "UserController@resetPassword"]);
Route::post("/pwreset/reset/", ["as" => "Reset Form", "uses" => "UserController@doResetPassword"]);
Route::get("/passwordReset", ["as" => "Reset Password", "uses" => "UserController@passwordView"]);
Route::post("/", ["as" => "Forgot Password", "uses" => "UserController@forgotPassword"]);

//email calls
Route::any("/autoAdd/{fname?}/{lname?}/{email?}/{company?}",["as" => "Auto Add User", "uses" => "UserController@autoAddUser"]);
Route::any("/import/company",["as" => "import company", "uses" => "UserController@importCompany"]);

//outside calls
Route::post("/beacons/update/{value?}", ["as" => "update Beacons", "uses" => "BeaconsController@updateBeacon"]);
Route::post('/beacons/filemaker/{value?}',  ["as" => "import beacons","uses" => "BeaconsController@import"]);

//api keys prefix
Route::group(['prefix' => 'api/v2'], function () {
	Route::get('/beacons/{id?}/{companyID?}/{uuid?}/{major?}/{minor?}',  ["uses" => 'api\v2\BeaconController@view']);
	Route::get('/campaigns/in/{id?}/{companyID?}/{uuid?}/{major?}/{minor?}',  ["uses" => 'api\v2\BeaconController@campaignIn']);   
	Route::get('/campaigns/out/{id?}/{companyID?}/{uuid?}/{major?}/{minor?}',  ["uses" => 'api\v2\BeaconController@campaignOut']);
});




//logged in routes only, else goes to login screen
Route::group(["before" => "auth"], function () { 
 //dashboard
	Route::get("/dashboard", ["as" => "Dashboard", "uses" => "DashboardController@view"] );
	Route::get("/dashboard2", ["as" => "Dashboard2", "uses" => "DashboardController@view2"] );

	Route::get("/analytics/index", ["as" => "Analytics", "uses" => "AnalyticsController@view"]);
	Route::get("/analytics/raw", ["as" => "Raw Visuals", "uses" => "AnalyticsController@raw"] );

	//keen csv builod calls
	Route::get("/analytics/csvConversion/2/{companyID?}", ["as" => "CSV builder mk2", "uses" => "AnalyticsController@csvTwo"] );

	Route::get("/beacons", ["as" => "Beacons", "uses" => "BeaconsController@view"] );

	//CRM

	Route::get("/crm"            , [ "as" => "CRM"           , "uses" => "CRMController@index"     ] );
	Route::post("/crm/add"       , [ "as" => "addCRMuser"    , "uses" => "CRMController@add"       ] );
	Route::post("/crm/email"     , [ "as" => "emailCRMuser"  , "uses" => "CRMController@email"     ] );
	Route::post("/crm/edit"      , [ "as" => "editCRMuser"   , "uses" => "CRMController@edit"      ] );
	Route::post("/crm/delete"    , [ "as" => "deleteCRMuser" , "uses" => "CRMController@delete"    ] );
	Route::any( "/crm/csvUpload" , [ "as" => "uploadCRMCSV"  , "uses" => "CRMController@uploadCsv" ] );
	Route::post("/crm/csvLoad"   , [ "as" => "loadCRMCSV"    , "uses" => "CRMController@loadCsv"   ] );

	//media
	//location routes (updates to filemaker)
	Route::post("/updateLocation", ["as" => "update location", "uses" => "LocationController@updateLocation"]);;

	//Route::get("/media"        	 , ["as" => "Media"       , "uses" => "MediaController@index"       ] );
	Route::get("/media/index"        , ["as" => "Media"       , "uses" => "MediaController@index"       ] );
	Route::post("/media/index"       , ["as" => "Media"       , "uses" => "MediaController@index"       ] );
	Route::post("/media/listLogo"    , ["as" => "listLogo"    , "uses" => "MediaController@listLogo"  ] );
	Route::post("/media/Uploader"    , ["as" => "Uploader"    , "uses" => "MediaController@Uploader"    ] );
	Route::post("/media/deleteLogo"  , ["as" => "deleteLogo"  , "uses" => "MediaController@deleteLogo"  ] );
	Route::post("/media/renameLogo"  , ["as" => "renameLogo"  , "uses" => "MediaController@renameLogo"  ] );
	Route::post("/media/restoreLogo" , ["as" => "restoreLogo" , "uses" => "MediaController@restoreLogo" ] );
	Route::post("/media/deleteRlogo" , ["as" => "deleteRlogo" , "uses" => "MediaController@deleteRlogo" ] );
	Route::post("/media/deleteARlogo", ["as" => "deleteARlogo", "uses" => "MediaController@deleteARlogo"] );

	//Reports
	Route::get("/reports"        	 , ["as" => "Reports"       , "uses" => "ReportsController@index"       ] );

	//Locations
	Route::get("/locations"        	 , ["as" => "Locations"       , "uses" => "LocationsController@index"       ] );
	Route::get("/locations/new"        	 , ["as" => "New Location"       , "uses" => "LocationsController@newLocation"       ] );
	Route::get("/locations/edit/{locationID}"        	 , ["as" => "Edit Location"       , "uses" => "LocationsController@editLocation"       ] );
	Route::post("/locations/store"        	 , ["as" => "Add Location"       , "uses" => "LocationsController@addLocation"       ] );
	Route::post("/locations/update/{locationid}"        	 , ["as" => "Update Location"       , "uses" => "LocationsController@updateLocation"       ] );
	Route::post("/locations/remove"        	 , ["as" => "Remove Location"       , "uses" => "LocationsController@removeLocation"       ] );

	//Campaigns
	Route::get("/campaigns"        	 , ["as" => "Campaigns" , "uses" => "CampaignsController@index"       ] );
	Route::get("/campaigns/new"        	 , ["as" => "New Campaign" , "uses" => "CampaignsController@newCampaign"       ] );
	Route::post("/campaigns/store" , ["as" => "Store Campaign", "uses" => "CampaignsController@storeCampaign"]); 
	Route::get("/campaigns/edit/{campaignID}" , ["as" => "Edit Campaign" , "uses" => "CampaignsController@editCampaign"] );
	Route::post("/campaigns/update/{campaignID}" , ["as" => "Update Campaign" , "uses" => "CampaignsController@updateCampaign"] );

	//cms routes
	/*
	Route::get("/perks/index", ["as" => "CMS", "uses" => "PerksController@cms"] );
	Route::get("/perks/edit/{perkID?}", ["as" => "edit perk", "uses" => "PerksController@edit"]);
	Route::put("/perks/edit/{perkID?}", ["as" => "update perk", "uses" => "PerksController@updatePerk"]);
	Route::get("/perks/new", ["as" => "new perk", "uses" => "PerksController@newPerk"]);
	Route::post("/perks/new", ["as" => "store new perk", "uses" => "PerksController@storeNewPerk"]);
	Route::any("/perks/remove/{perkID?}", ["as" => "remove perk", "uses" => "PerksController@removePerk"]);

	//Route::post("/perks/deleteLogo", ["as" => "deleteLogo", "uses" => "MediaController@deleteLogo"] );
	//Route::post("/perks/renameLogo", ["as" => "renameLogo", "uses" => "MediaController@renameLogo"] );
	*/
	Route::get("/beams/index"           , ["as" => "CMS"           , "uses" => "PerksController@cms"]         );
	Route::get("/beams/new"             , ["as" => "new perk"      , "uses" => "PerksController@newPerk"]     );
	Route::post("/beams/new"            , ["as" => "store new perk", "uses" => "PerksController@storeNewPerk"]);
	Route::any("/beams/remove/{perkID?}", ["as" => "remove perk"   , "uses" => "PerksController@removePerk"]  );
	Route::get("/beams/edit/{perkID?}"  , ["as" => "edit perk"     , "uses" => "PerksController@edit"]        );
	Route::post("/beams/Uploader"       , ["as" => "Uploader"      , "uses" => "MediaController@Uploader"]    );
	Route::post("/beams/listLogo"       , ["as" => "listLogo"      , "uses" => "MediaController@listLogo"]    );
	Route::post("/beams/edit/Uploader"  , ["as" => "Uploader"      , "uses" => "MediaController@Uploader"]    );
	Route::post("/beams/edit/listLogo"  , ["as" => "listLogo"      , "uses" => "MediaController@listLogo"]    );
	Route::put("/beams/edit/{perkID?}"  , ["as" => "update perk", "uses" => "PerksController@updatePerk"]     );

	//account
	Route::get("/profile", ["as" => "profile", "uses" => "UserController@profileView"]);
	Route::post("/profile", ["as" => "update profile", "uses" => "UserController@updateProfile"]);
	Route::post("/updateCompany", ["as" => "update company", "uses" => "UserController@updateCompany"]);
	Route::post("/Uploader"  , ["as" => "Uploader"  , "uses" => "MediaController@Uploader"  ] );
	Route::post("/listLogo"  , ["as" => "listLogo"  , "uses" => "MediaController@listLogo"  ] );

	//beacons
	Route::get("/beacons/create/{uuid}/{major}/{minor}/{alias}/{location}", ["as" => "Create Beacon", "uses" => "BeaconsController@createBeacon"]);
	Route::get("/beacons/setup", ["as" => "Setup Beacon", "uses" => "BeaconsController@setupBeacon"]);
	Route::post("/beacons/updateBeacon", ["as" => "Update Beacon", "uses" => "BeaconsController@updateBeacon"]);
	Route::get("/beacons/edit/{beaconID}", ["as" => "Edit Beacon", "uses" => "BeaconsController@editBeacon"]);
	Route::any("/beacons/destroy/{id}", ["as" => "Destroy Beacon", "uses" => "BeaconsController@destroyBeacon"]);
	Route::get("/beacons/index", ["as" => "beacons", "uses" => "BeaconsController@view"]);
	
	//sets state
	Route::get('/beacons/state/inactive/{PerkID}', function($perkID){
			$perk = Perk::where('_id','=',$perkID)->get()->first();
			$perk->state = 0;
			$perk->save();
			return $perkID." un-stored";
	});
	Route::get('/beacons/state/active/{PerkID}', function($perkID){
			$perk = Perk::where('_id','=',$perkID)->get()->first();
			$perk->state = 1;
			$perk->save();
			return $perkID." stored";
	});
	//sets order
	Route::get('/beacons/order/{PerkID}/{order}', function($perkID,$order){
			$perk = Perk::where('_id','=',$perkID)->get()->first();
			$perk->order = $order;
			$perk->save();
			return $perkID." - ".$order." order stored";
	});
	
});
