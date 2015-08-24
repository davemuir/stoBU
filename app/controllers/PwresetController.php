<?php
use Illuminate\Support\MessageBag;
class PwresetController extends Controller {

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
print_r($_SERVER);
	return View::make('pwreset/reset');
}


  
  
	
	//displays the form for the new password to be added.
//	public function forgotPassword($email){
//---------------------------------------------------------------------
	public function forgotPassword(){
	/*
$data["errors"] = new MessageBag(["company" => ["Email invalid."]]);
//$data["email"] = Input::get("email");
return Redirect::to("/login")->withInput($data);
*/
		$myUser = User::where('email','=',Input::get("email"))->get();
		foreach ($myUser as $key => $value) {
			$id    = $value->_id;
			$fname = $value->fname;
			$lname = $value->lname;
			$email = $value->email;
		}
		$data = array(
			"fname"    => $fname,
			"lname"    => $lname,
			"tempPass" => "1234"
		);
		$userData = array(
			"email" => $email,
			"fname" => $lname.','.$fname
		);
		Mail::send('emails.passwordReset', $data, function($message) use($userData){
			$message->to($userData['email'], "candidate")->subject('Hi '.$userData['fname'].', you have been ....');
		});
		return Redirect::to("/");
//---------------------------------------------------------------------
//		return Redirect::to("/resetpassword");
	}

}


