<?php

namespace api\v1;
use Illuminate\Support\MessageBag;
/**
 *--------------------------------------------------------------------------
 * API Gatekeeper: V1
 *--------------------------------------------------------------------------
 *
 * Custom methods to extend system's functionality by exposing some of the features via API
 * This controller does not have an explicit index method, as this is handled by the get:api/v1 route
 *
 *
 * @author DavidMuir <dmuir@ap1.io>
 * @package api/v#/controllers
*/

class BeaconController extends \BaseController {

	public function view($uuid,$major,$minor){
		
		//all beacons have same uuid / major /minor so any beacon can be pulled for branch id.

		$beacons = \Beacon::where('major','=',$major)->where('minor','=',$minor)->get()->first();
		$branchID = $beacons->branchID;
		$company = \Company::where('locationID','=',$branchID)->get()->first();
		$logo = $company->setImage;
		$perks = \Perk::where('branchID','=',$branchID)->where('state','=',1)->orderBy('order', 'asc')->get();
		$super = '<style>body{margin:0 !important;}.right{height:50px;float:left;max-width:80%;overflow-y: hidden;color:#fff;}.left{float:left;padding-right: 10px;}.right span{margin-top:10px;}.mainImg{width:100% !important;float:left;}.banner{clear:both}.banner span{padding-top:5%;line-height:1;font-weight:300;} .banner img{width:45px;height:45px;padding:5px;float:left;}html{font-family:Lato;font-weight:300;}h1{margin-top:40px;}</style><div id="container"><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
		$count = 0;
		$pCount = 1;
		$size = sizeOf($perks);
		foreach($perks as $perk){
			$label = $perk->label;
			if(strlen($label) >= 40){
				$label = substr($label,0,40).'...';
			}
			$title = '<h1 style="background:#24284b;color:#fbffff;margin:0;padding-top:30px;text-align:center;font-family:Lato light 100;font-weight:300;font-size:2.1em;max-width:70%;margin: auto;">'.$perk->title.'</h1>';
			//$banner = '<div style="background:#24284b;" class="banner"><div  style="background:#24284b;" class="left"><img src="'.$logo.'"></div><div class="right"><span><br/>'.$label.'</span></div></div>';
			//$banner = '<div style="background:#24284b;" class="banner"><div  style="background:#24284b;" class="left"></div><div class="right"></div></div>';
			if(isset($perk->mainImg)){
				$mainImage = '<img class="mainImg" style="padding-bottom:20px;width:100% !important" src="http://'.$_SERVER['HTTP_HOST'].$perk->mainImg.'">';
			}else{
				$mainImage = "";
			}

			if(isset($perk->disclaimer)){
				$disclaimer = "<i>".$perk->disclaimer."</i>";
			}else{
				$disclaimer = "";
			}
			$desc = $perk->elements[0]['content'];
			$html = '<div class="perkBody" style="width:100%;background:#24284b;"><div class="perkHeader" style="width:100%;margin:auto;color:white;clear:both;">'.$mainImage.''.$title.'</div><div class="perkDesc" style="padding:5px;padding-bottom:20px;text-align:left;width:80%;margin:auto;background:#24284b;color:#fbffff;">'.$desc.''.$disclaimer.'</div></div>';
			if($pCount < $size){
				$html .= '<div style="margin:auto;width:100%;background:#3e4160;color:#3e4160;height:1px;"></div>';
			}
			$super .= $html;
			$pCount++;
		}

		$super .= '</div>';
		//return \Response::json($super);
		return $super;
	}
	
}