<?php
namespace Concrete\Controller\SinglePage;
use \Concrete\Core\Page\Controller\PageController;
use Config;
use Loader;
use User;
use UserInfo;
use UserAttributeKey;
class StreetsRegister extends PageController {
	 public function register(){
	 	if(isset($_POST['email'])){
	 	
	 		/* $data = [
	 		  "key_no"=>$_POST['key_no'],
               "fname"=>$_POST['firstname'],
               "lname"=>$_POST['lastname'],
               "email"=>$_POST['email'],
               "password"=>$_POST['password'],
               "username"=>$_POST['fname']+$_POST['lname']+$_POST['key_no']
              ];*/
	 		$password = $_POST['password'];
	 		$username = $_POST['username'];
	 		$email = $_POST['email'];

        	$db= Loader::db();
 
            $newUserInfoObject = UserInfo::add(["uName"=>$username,"uEmail"=>$email,"uPassword"=>$password]);
           
            $newUserInfoObject->activate();
           	echo $newUserInfoObject->uID.','.$newUserInfoObject->uName.','.$newUserInfoObject->uPassword;
   
            $mh = Loader::helper('mail');
            $mh->to($email);
            $mh->from('admin@streetsto.com');
            $mh->setSubject($username.',you have been granted access to Streets To');
             $mh->addParameter("uName", $username);
             $mh->addParameter("password", $password);
            $mh->load("streetsto_register");
            $mh->sendMail();
			


       
			//$r = $mh->getMailerObject();
			//print_r($r);
	 	}
	 }
    public function logout(){
      if(isset($_GET['cID'])){
        $id = $_GET['cID'];
        $u = User::getByUserID($id);
        $u->logout();
        echo "logging off";
      }
    }
	
}