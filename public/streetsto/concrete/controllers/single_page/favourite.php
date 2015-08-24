<?php
namespace Concrete\Controller\SinglePage;
use \Concrete\Core\Page\Controller\PageController;
class Favourite extends PageController {
	 public function signin(){
	 	if($_POST['fav']){
	 		echo $_POST['fav'];
	 	}
	 	
	 }
	
}