<?php

use Concrete\Core\Attribute\Key\Key;
use Concrete\Core\Http\ResponseAssetGroup;

defined('C5_EXECUTE') or die('Access denied.');

$r = ResponseAssetGroup::get();
$r->requireAsset('javascript', 'underscore');
$r->requireAsset('javascript', 'core/events');
$r->requireAsset('core/legacy');

$activeAuths = AuthenticationType::getList(true, true);
$form = Loader::helper('form');

$active = null;
if ($authType) {
    $active = $authType;
    $activeAuths = array($authType);
}


/** @var Key[] $required_attributes */

$attribute_mode = (isset($required_attributes) && count($required_attributes));

//if(isset($_POST['username'])){
	
    //$userID = 2;
    //User::loginByUserID($userID);
    //echo "loggedin post";
    //}
?>
<?php
if(isset($_GET['cEmail'])){
   
    $userID = $_GET['cID'];
    User::loginByUserID($userID);
    echo "loggedin GET";
    header("location: http://sto.apengage.io/streetsto/index.php");
    exit;
?>
<?php
}else{
echo 'hi';
}
?>