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
//login routes
Route::get('/',  ["as" => "Login","uses" => "UserController@view"]);
Route::get("/login", ["as" => "login","uses" => "UserController@view"]);
Route::post("/login", ["as" => "login form","uses" => "UserController@loginForm"]);
Route::get("/logout", ["as" => "user/logout", "uses" => "UserController@logoutAction"]);
Route::post("/register", ["as" => "register form","uses" => "UserController@registerForm"]);


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
Route::group(['prefix' => 'api/v1'], function () {
	Route::get('/beacons/{uuid?}/{major?}/{minor?}',  ["uses" => 'api\v1\BeaconController@view']);
});

//email call for titanium app
Route::get('/et/register/{email}/{fname}/{lname}/{userID}', function($email,$fname,$lname,$userID){
	$data = array(
        "email" => $email,
        "fname" => $fname,
        "lname" => $lname,
       	"userID"=> $userID
      );
      $userData = array(
        "email" => $email,
        "fname" => $fname
      );

      Mail::send('emails.titaniumEmailUserConfirm', $data, function($message) use($userData){
          $message->to($userData['email'], "candidate")->subject('Hi '.$userData['fname'].', you have been granted user access');
      });
	return $email." stored";
});

Route::get("/et/confirm/{email?}/{userID?}", ["as" => "Confirm Titanium User", "uses" => "UserController@titaniumConfirm"]);

//dashboard (logged in)
Route::group(["before" => "auth"], function () {
Route::get("/dashboard", ["as" => "Dashboard", "uses" => "DashboardController@view"] );
Route::get("/analytics/index", ["as" => "Analytics", "uses" => "AnalyticsController@view"]);
Route::get("/beacons", ["as" => "Beacons", "uses" => "BeaconsController@view"] );
//media
//location routes (updates to filemaker)
Route::post("/updateLocation", ["as" => "update location", "uses" => "LocationController@updateLocation"]);;

Route::get("/media/index"        , ["as" => "Media"       , "uses" => "MediaController@index"       ] );
Route::post("/media/index"       , ["as" => "Media"       , "uses" => "MediaController@index"       ] );
Route::post("/media/Uploader"    , ["as" => "Uploader"    , "uses" => "MediaController@Uploader"    ] );
Route::post("/media/deleteLogo"  , ["as" => "deleteLogo"  , "uses" => "MediaController@deleteLogo"  ] );
Route::post("/media/renameLogo"  , ["as" => "renameLogo"  , "uses" => "MediaController@renameLogo"  ] );
Route::post("/media/restoreLogo" , ["as" => "restoreLogo" , "uses" => "MediaController@restoreLogo" ] );
Route::post("/media/deleteRlogo" , ["as" => "deleteRlogo" , "uses" => "MediaController@deleteRlogo" ] );
Route::post("/media/deleteARlogo", ["as" => "deleteARlogo", "uses" => "MediaController@deleteARlogo"] );

Route::post("/perks/edit/Uploader"  , ["as" => "Uploader"  , "uses" => "MediaController@Uploader"  ] );
Route::post("/perks/edit/listLogo"  , ["as" => "listLogo"  , "uses" => "MediaController@listLogo"  ] );
//Route::post("/perks/edit/deleteLogo", ["as" => "deleteLogo", "uses" => "MediaController@deleteLogo"] );
//Route::post("/perks/edit/renameLogo", ["as" => "renameLogo", "uses" => "MediaController@renameLogo"] );

Route::post("/perks/Uploader"  , ["as" => "Uploader"  , "uses" => "MediaController@Uploader"  ] );
Route::post("/perks/listLogo"  , ["as" => "listLogo"  , "uses" => "MediaController@listLogo"  ] );
//Route::post("/perks/deleteLogo", ["as" => "deleteLogo", "uses" => "MediaController@deleteLogo"] );
//Route::post("/perks/renameLogo", ["as" => "renameLogo", "uses" => "MediaController@renameLogo"] );

//cms routes
Route::get("/perks/index", ["as" => "CMS", "uses" => "PerksController@cms"] );
Route::get("/perks/edit/{perkID?}", ["as" => "edit perk", "uses" => "PerksController@edit"]);
Route::put("/perks/edit/{perkID?}", ["as" => "update perk", "uses" => "PerksController@updatePerk"]);
Route::get("/perks/new", ["as" => "new perk", "uses" => "PerksController@newPerk"]);
Route::post("/perks/new", ["as" => "store new perk", "uses" => "PerksController@storeNewPerk"]);
Route::any("/perks/remove/{perkID?}", ["as" => "remove perk", "uses" => "PerksController@removePerk"]);
//account
Route::get("/profile", ["as" => "profile", "uses" => "UserController@profileView"]);
Route::post("/profile", ["as" => "update profile", "uses" => "UserController@updateProfile"]);
Route::post("/updateCompany", ["as" => "update company", "uses" => "UserController@updateCompany"]);

Route::post("/Uploader"  , ["as" => "Uploader"  , "uses" => "MediaController@Uploader"  ] );
Route::post("/listLogo"  , ["as" => "listLogo"  , "uses" => "MediaController@listLogo"  ] );

//beacons
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
