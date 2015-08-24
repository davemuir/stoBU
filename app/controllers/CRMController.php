<?php
use Illuminate\Support\MessageBag;
use Illuminate\Console\Command;

class CRMController extends BaseController {
	//----------------------------------------
	public function index(){
		return View::make('/crm/index');
	}
	//----------------------------------------
	public function add(){
		$crmUser = new CRMUsers;
		$crmUser->first_name = Input::get('first_name');
		$crmUser->last_name  = Input::get('last_name');
		$crmUser->email      = Input::get('email');
		$crmUser->save();

		return Redirect::to("/crm");
	}
	//----------------------------------------
	public function edit(){
		$id = $_POST['eid'        ];
		$fn = $_POST['efirst_name'];
		$ln = $_POST['elast_name' ];
		$em = $_POST['eemail'     ];
		$crmUser = CRMUsers::find( $id );
		$crmUser = CRMUsers::where( '_id', $id )
			->update(array(
					'first_name'=> $fn,
					'last_name' => $ln,
					'email'     => $em
			)
		);
		return Redirect::to("/crm");
	}
	//----------------------------------------
	public function delete(){
		$id = $_POST['did'];
		$crmUser = CRMUsers::where( '_id', $id )->delete();
		return Redirect::to("/crm");
	}
	//----------------------------------------
	public function email(){
		$ids = explode( ";", $_POST['ids'] );
		if( is_array($ids) ){
			foreach( $ids as $id ){
				if( trim( $id )=='' ){ continue; }
				$crmUser = CRMUsers::where( '_id', $id )->get()->first();
				$to      = $crmUser->email;
				$subject = $_POST['subject'];
				$body    = $_POST['body']."<br/>".$to."<br/>".count($ids);

				$from = "noreplay@{$_SERVER['SERVER_NAME']}"; 
			
				$header  = "MIME-Version: 1.0" . "\r\n";
				$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$header .= "From: noreplay <{$from}>" . "\r\n";
				$header .= "X-Mailer: PHP/" . phpversion();
			
				mail( $to, $subject, $body, $header );
			}
		}
		return Redirect::to("/crm");
	}
	//----------------------------------------
	public function uploadCsv(){
		if( isset($_FILES['selectedCSVFile']) ){
			$in_csvFile = $_FILES['selectedCSVFile']['tmp_name'];
			if( file_exists($in_csvFile) ){
				$file = fopen( $in_csvFile, "r" );
				$csvFileRows = array();
				while( $line = fgets( $file ) ){
					$CSVcontent = str_getcsv ($line);
					array_push( $csvFileRows, $CSVcontent );
				}
				fclose($file);
//				return View::make('/crm/index')->with('in_csvFile',$_FILES['selectedCSVFile']['tmp_name']);
				Session::put('csvFileRows', $csvFileRows);
				return View::make('/crm/index')->with('csvFileRows',$csvFileRows);
			}else{
				return Redirect::to("/crm");
			}
		}else{
			return Redirect::to("/crm");
		}
	}
	//----------------------------------------
	public function loadCsv(){
		$csvFileRows = Session::get('csvFileRows');
		Session::forget('csvFileRows');
		
		if($csvFileRows==''){ return Redirect::to("/crm"); }
		
		$rowFields = array("first_name"=>-1, "last_name"=>-1, "email"=>-1);
		$postKeys = array_keys( $_POST );
		$maxCol=0;
		foreach($postKeys as $key){
			if( substr($key, 0, 11) == 'select_csv_' ){
				if($_POST[$key]!=''){ $rowFields[$_POST[$key]] = substr($key, 11); $maxCol=( (substr($key, 11)>$maxCol)? substr($key, 11) : $maxCol ); }
			}
		}
		foreach( $csvFileRows as $itm ){
			if( !is_array($itm) ){ continue; }
			$crmUser = new CRMUsers;
			try{ $crmUser->first_name = ($rowFields['first_name']==-1 )? "" : $itm[ $rowFields['first_name'] ]; }catch(Exception $e){ $crmUser->first_name = ""; }
			try{ $crmUser->last_name  = ($rowFields['last_name' ]==-1 )? "" : $itm[ $rowFields['last_name' ] ]; }catch(Exception $e){ $crmUser->last_name = "";  }
			try{ $crmUser->email      = ($rowFields['email'     ]==-1 )? "" : $itm[ $rowFields['email'     ] ]; }catch(Exception $e){ $crmUser->email = "";      }
			$crmUser->save();
		}
		return Redirect::to("/crm");
	}
	//----------------------------------------
}


/*
 //Code  to import CSV for users

public function importCSVUser(){
  	$allUser = User::all();
  	$user = Auth::user();
  	$folder = '/uploads/' . $user->id() . '/app/';
  	$path = public_path() . $folder;
  	 
  	if (Input::file('csvUsers')) {
  	$extension = Input::file('csvUsers')->getClientOriginalExtension();
  	$name = time() .Input::file('csvUsers')->getClientOriginalName();
  	Input::file('csvUsers')->move($path, $name);
  	if(Input::get('fnameOrder') && Input::get('lnameOrder') && Input::get('emailOrder')){
  	$fnameOrder = Input::get('fnameOrder')-1;
  	$lnameOrder = Input::get('lnameOrder')-1;
  	$emailOrder = Input::get('emailOrder')-1;
  	}else{
  	 
  	$nofields = 'no inputs selected selected';
  	return $nofields;
  	return Redirect::to("/addUser")->with('nofields', $nofields);
  	}
  	$row = 1;
  	if (($handle = fopen($path.$name, "r")) !== FALSE) {
  	$test = array();
  	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
  	$test[] = $data;
  	 
  	$num = count($data);
  	$row++;
  	 
  	 
  	if(strpos($data[$emailOrder],'@') !== false){
  	 
  	 
  	 
  	 
  	$user = new User;
  	$user->fname = $data[$fnameOrder];
  	 
  	$user->lname = $data[$lnameOrder];
  	$user->email = $data[$emailOrder];
  	 
  	 
  	$length = 8;
  	$password = "";
  	// define possible characters
  	$possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  	$i = 0;
  	// add random characters to $password until $length is reached
  	while ($i < $length) {
  	// pick a random character from the possible ones
  	$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
  	// we don't want this character if it's already in the password
  	if (!strstr($password, $char)) {
  	$password .= $char;
  	$i++;
  	}
  	}
  	$data = array(
  	"company" => Auth::user()->company->name,
  	"access" => $user->user_access,
  	"fname" => $user->fname,
  	"email" =>$user->email,
  	"lname" => $user->lname,
  	"tempPass" => $password
  	);
  	$user->password = Hash::make($password);
  	$user->user_access = "staff";
  	$userData = array(
  	"email" => $user->email,
  	"fname" => $user->fname,
  	);
  	Auth::user()->company->users()->save($user);
  	Mail::send('emails.requestedUser', $data, function($message) use($userData){
  	$message->to($userData['email'], "candidate")->subject('Hi '.$userData['fname'].', you have been granted user access');
  	});
  	 
  	}
  	}
  	 
  	fclose($handle);
  	}//end handle function
  	return Redirect::to("/addUser");
  	}else{
  	 
  	$nofields = 'no file selected';
  	return Redirect::to("/addUser")->with('nofields', $nofields);
  	}
  	 
  	}
  	
  	
  	*/