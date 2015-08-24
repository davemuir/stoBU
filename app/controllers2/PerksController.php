<?php
use Illuminate\Support\MessageBag;
class PerksController extends Controller {

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



public function media(){
	return View::make('/perks/media');
}
public function newPerk(){
	$user = Auth::user();
	$company = Company::where('_id','=',$user->companyID)->get()->first();
	return View::make('/perks/new')->with('company',$company);
}
public function removePerk($perkID){
	$perk = Perk::find($perkID);
	$perk->delete();
	return Redirect::to('/perks/index');
}
public function edit($perkID){
	
	$user = Auth::user();
	$beamID = Perk::where('_id','=',$perkID)->get();
	$company = Company::where('_id','=',$user->companyID)->get()->first();
	return View::make('/perks/edit')->with('perkID',$perkID)->with('beamID',$beamID)->with('company',$company);
}

public function cms(){
	$user = Auth::user();
	$companyID = $user->companyID;
	$perks = Perk::where('companyID','=',$companyID)->orderBy('updated_at', 'desc')->get();
	return View::make('/perks/index')->with('perks',$perks)->with('companyID',$companyID);
}
public function storeNewPerk(){

		$user = Auth::user();
		
		if ($user ) {
		$beam = new Perk;
		$beam->title = Input::get('beamtitle');
	   	$beam->companyID = $user->companyID;
	   	$beam->state = 0;
	   	$beam->branchID = $user->locationID;
		//Create a tag entry for each beacon
		if (Input::get('beamtag')) {
		$tags =  explode( ' ', trim(Input::get('beamtag')) );
		$beam->tags = $tags;
		}

		$beam->label = Input::get('label');
		if(Input::get('image')){
			$beam->mainImg = Input::get('image');
		}
		if(Input::get('beamdisclaimer')){
			$beam->disclaimer = Input::get('beamdisclaimer');
		}
		$beacons = Beacon::where('branchID','=',$user->locationID)->get()->first();
		if(count($beacons) < 1){

			$error = "No beacons Associated with your company";
			return Redirect::to('/perks/index?errors=11');
		}
		$beam->beacons = $beacons->_id;
		$media = $beam->elements;
	    $selection;
	    $szie = Input::get('size');
	    for ($i=0; $i < Input::get('size'); $i++) {
	    	$string = strip_tags(Input::get('field_value_'.$i),'<img>,<iframe>,<a>,<b>,<i>,<br>,<div>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<p>');
	    	$name = array('type' => Input::get('field_name_'.$i), 'content' => str_replace("’", "&apos;", $string));
	        $media[] =  $name;
	    }
	 
	    $beam->elements = $media;
	    $elemValidator = Validator::make(
	    	array('fields' => $beam->elements),
    		array('fields' => 'required')
			);
			if ($elemValidator->fails())
			{
            //printr(Input::all()); exit();
				//return "no elemets";

				return 'errors 1';
			}

		
	    $titleCheck = $beam->title;

	    $beamvalidator = Validator::make(
    		array('beam name' => $titleCheck),
    		array('beam name' => array('required'))
		);
			if ($beamvalidator->fails())
			{
				// The given data did not pass validation
				//return "nothing provided";//View::make("user/cms")->with();

				return 'errors 2';
			}

		$beam->save(); 
		$type = "create";

	
		//send the perk to filemaker to create a qr code
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://sto.apengage.io/filemaker/storePerk.php");
		curl_setopt($ch,  CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"locationID=".$user->locationID."&title=".$beam->title."&type=".$type."&contents=".$beam->elements[0]['content']."&mongoID=".$beam->_id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                                                                                                             $response = curl_exec ($ch);
		curl_close ($ch);
		
//-------------------Send email to admin ------------------------
		$companyOBJ = Company::where('_id','=',$user->companyID)->get();
		$company="";
		foreach( $companyOBJ as $key => $value ){
			$company = $value->name;
		}
		
		$myData  = array('title'=>$beam->title , 'label'=>$beam->label , 'company' => $company , 'fname'=> $user->fname , 'lname' => $user->lname );
		$myUser = User::where('user_access','=','Admin')->get();
		$userTo = array();
		
		foreach ($myUser as $key => $value) {
			$userTo[] = $value->email;
		}
		Mail::send('emails.perksUpdate', $myData, function($message) use ($userTo){
			$message->to($userTo);
			$message->subject('Perk update, new perk added.');
		});
//-------------------------------------------------------------------------------------

		$beam->fmID = $response;
		$beam->save();
		return Redirect::to('/perks/index');


		}
	}

	public function updatePerk(){
		$user = Auth::user();
		
		// Update title
		if ($user) {
		
			$beam = Perk::find(Input::get('beamID'));
			$beam->title = Input::get('beamtitle');
			
			//Create a tag entry for each beacon
			if (Input::get('beamtag')) {
			$tags =  explode( ' ', trim(Input::get('beamtag')) );
		$beam->tags = $tags;
		}
	
		$input1 = Input::get('field_name_');
		$beam->label = Input::get('label');
		$beacons = Beacon::where('branchID','=',$user->locationID)->get()->first();
		$beam->beacons = $beacons->_id;
		$beam->logo = Input::get('logo');
		if(Input::get('image')){
			$beam->mainImg = Input::get('image');
		}
		if(Input::get('beamdisclaimer')){
			$beam->disclaimer = Input::get('beamdisclaimer');
		}
		$media = array();
	    //$string = strip_tags(Input::get('field_value_'),'<img>,<iframe>,<a>,<b>,<i>,<br>,<div>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<p>');

		$name = array('type' => 'html', 'content' => strip_tags(Input::get('field_name_'),'<img>,<table>,<td>,<th>,<thead>,<tbody>,<tr>,<iframe>,<a>,<b>,<i>,<br>,<div>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<p>'));
	    
		$media[] =  $name;
	     
		//return $media;
		$beam->elements = $media;
		$elemValidator = Validator::make(
	    	array('fields' => $beam->elements),
    		array('fields' => 'required')
			);
			if ($elemValidator->fails())
			{
		printr(Input::all()); exit();
				//return "no elemets";

				return Redirect::to("perks/beam")->withErrors($elemValidator);
			}


		$titleCheck = $beam->title;
    
    
	    
		$beam->save();
		$type = "update";
			//update the perk in filemaker
			$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://sto.apengage.io/filemaker/updatePerk.php");
		curl_setopt($ch,  CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"locationID=".$user->locationID."&title=".$beam->title."&type=".$type."&contents=".$beam->elements[0]['content']."&mongoID=".$beam->fmID);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                                                                                                             $response = curl_exec ($ch);
		curl_close ($ch);



		return Redirect::to("perks/index");


		}
	}

	//for editting perks
	

}

