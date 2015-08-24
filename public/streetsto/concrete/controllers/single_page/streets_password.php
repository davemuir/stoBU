<?php
namespace Concrete\Controller\SinglePage;
use \Concrete\Core\Page\Controller\PageController;
use Config;
use Loader;
use User;
use UserInfo;
use UserAttributeKey;
class StreetsPassword extends PageController {
	 public function update(){
	 
	 	 if(changePassword){

	 		$db= Loader::db();
      $u = UserInfo::getByID($_POST['cID']);
      $u->changePassword($_POST['password']);
      echo $u->uID;
     }else{
      echo "bad";
     }
	 	

        
			

	 }
	  public function reset(){
      if(isset($_POST['cID'])){
        echo 'start';

            $db = Loader::db();
            $password = $_POST['pass'];
            $ui = UserInfo::getByID($_POST['cID']);
            $ui->changePassword($password);
            $email = $ui->getUserEmail();
            
            
            //$email = "davidmuirdesign@gmail.com";
            $uName = $email;
          

            $mh = Loader::helper('mail');
            $mh->to($email);
            $mh->from('admin@streetsto.com');
            $mh->setSubject($uName.',you have been granted access to Streets To');
            $mh->addParameter("uName", $uName);
            $mh->addParameter("password", $password);
            $mh->load("streetsto_forgotPassword");
            $mh->sendMail();

           echo "resetting";
      }
    
     
  }
}