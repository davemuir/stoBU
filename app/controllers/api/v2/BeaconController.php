<?php

namespace api\v2;
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

	public function view($id,$companyID,$uuid,$major,$minor){
		
		//all beacons have same uuid / major /minor so any beacon can be pulled for branch id.

		$beacons = \Beacon::where('major','=',$major)->where('minor','=',$minor)->get()->first();
		$logo = \Company::where('_id','=',$companyID)->get()->first();

		$logo = $logo->setImage;
		//get logo from company object 

		$perks = \Perk::where('companyID','=',$companyID)->where('state','=',1)->orderBy('order', 'asc')->get();
		$super = '<style>body{margin:0 !important;}.right{height:50px;float:left;max-width:80%;overflow-y: hidden;color:#000;}.left{float:left;padding-right: 10px;}.right span{margin-top:10px;}.mainImg{width:100% !important;float:left;}.banner{clear:both}.banner span{padding-top:5%;line-height:1;font-weight:300;} .banner img{width:45px;height:45px;padding:5px;float:left;}html{font-family:Lato;font-weight:300;}h1{margin-top:40px;}</style><div id="container"><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
		$count = 0;
		$pCount = 1;
		
		$size = sizeOf($perks);
		foreach($perks as $perk){
			$label = $perk->label;
			if(strlen($label) >= 40){
				$label = substr($label,0,40).'...';
			}
			$title = '<h1 style="background:#fff;color:#000;margin:0;padding-top:30px;text-align:center;font-family:Lato light 100;font-weight:300;font-size:2.1em;max-width:70%;margin: auto;clear:both;">'.$perk->title.'</h1>';
			$banner = '<div style="background:#fff;" class="banner"><div  style="background:#fff;" class="left"><img class="mainImg" src="'.$logo.'"></div><div class="right"><span><br/>'.$label.'</span></div></div>';
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
			$html = '<div class="perkBody" style="width:100%;background:#fff;"><div class="perkHeader" style="width:100%;margin:auto;color:white;clear:both;">'.$banner.''.$mainImage.''.$title.'</div><div class="perkDesc" style="padding:5px;padding-bottom:20px;text-align:left;width:80%;margin:auto;background:#fff;color:#000;">'.$desc.'</div></div>';
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
	public function campaignIn($id,$companyID,$uuid,$major,$minor){
		$beacons = \Beacon::where('companyID','=',$companyID)->where('major','=',$major)->where('minor','=',$minor)->get();
		//$beaconID = $beacons->_id;
		$logo = \Company::where('_id','=',$companyID)->get()->first();
		$logo = $logo->setImage;

		$campaigns = \Campaign::where('companyID',$companyID)->get();
		$superEntry = [];
		$campCount = 0;
		$enCount = 0;
		$super = [];
		$superHTML = '<style>body{margin:0 !important;}.right{height:50px;float:left;max-width:80%;overflow-y: hidden;color:#000;}.left{float:left;padding-right: 10px;}.right span{margin-top:10px;}.mainImg{width:100% !important;float:left;}.banner{clear:both}.banner span{padding-top:5%;line-height:1;font-weight:300;} .banner img{width:45px;height:45px;padding:5px;float:left;}html{font-family:Lato;font-weight:300;}h1{margin-top:40px;}</style><div id="container"><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
		foreach($campaigns as $campaign){
				//checksomething with the start date
				$beaconCheck = 0;
				foreach($beacons as $beacon){
					foreach($campaign->beacons as $cBeacon){
						if($beacon->_id == $cBeacon){
							$beaconCheck = 1;
						}
					}
				}
				//if is active, go through this loop to set the perks
				$todayd = date("d");
	            $todaym = date("n");
	            $todayy = date("Y");
	            $todayStamp = mktime(23,59,0,$todaym,$todayd,$todayy);

	            $data   = preg_split('/\s+/', $campaign->endDate);
	            $dataStamp = mktime(23,59,0,$data[1], $data[2], $data[0]);

	            $dataStart   = preg_split('/\s+/', $campaign->startDate);
	            $dataStartStamp = mktime(23,59,0,$dataStart[1], $dataStart[2], $dataStart[0]);

	            if($dataStamp >= $todayStamp && $dataStartStamp <= $todayStamp && $beaconCheck >= 1){
					foreach($campaign->entry as $entry){

						$superEntry[$campCount][$enCount] = $entry;
						$enCount++;
						$perk = \Perk::where('_id','=',$entry)->get()->first();
						//build html for the perk's appearance
								$label = $perk->label;
								if(strlen($label) >= 40){
									$label = substr($label,0,40).'...';
								}
								$title = '<h1 style="background:#fff;color:#000;margin:0;padding-top:30px;text-align:center;font-family:Lato light 100;font-weight:300;font-size:2.1em;max-width:70%;margin: auto;clear:both;">'.$perk->title.'</h1>';
								$banner = '<div style="background:#fff;" class="banner"><div  style="background:#fff;" class="left"><img class="mainImg" src="'.$logo.'"></div><div class="right"><span><br/>'.$label.'</span></div></div>';
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
								$html = '<div class="perkBody" style="width:100%;background:#fff;"><div class="perkHeader" style="width:100%;margin:auto;color:white;clear:both;">'.$banner.''.$mainImage.''.$title.'</div><div class="perkDesc" style="padding:5px;padding-bottom:20px;text-align:left;width:80%;margin:auto;background:#fff;color:#000;">'.$desc.'</div></div>';
								//if($pCount < $size){
									$html .= '<div style="margin:auto;width:100%;background:#3e4160;color:#3e4160;height:1px;"></div>';
								//}
								$superHTML .= $html;
								
									
								
						$campCount++;
						$super[$enCount] = $perk;
					}
				}
			
		}
		$superHTML .= '</div>';

		return $superHTML;
	}
	public function campaignOut($id,$companyID,$uuid,$major,$minor){
		$beacons = \Beacon::where('companyID','=',$companyID)->where('major','=',$major)->where('minor','=',$minor)->get();
		//$beaconID = $beacons->_id;
		$logo = \Company::where('_id','=',$companyID)->get()->first();
		$logo = $logo->setImage;

		$campaigns = \Campaign::where('companyID',$companyID)->get();
		$superEntry = [];
		$campCount = 0;
		$enCount = 0;
		$super = [];
		$superHTML = '<style>body{margin:0 !important;}.right{height:50px;float:left;max-width:80%;overflow-y: hidden;color:#000;}.left{float:left;padding-right: 10px;}.right span{margin-top:10px;}.mainImg{width:100% !important;float:left;}.banner{clear:both}.banner span{padding-top:5%;line-height:1;font-weight:300;} .banner img{width:45px;height:45px;padding:5px;float:left;}html{font-family:Lato;font-weight:300;}h1{margin-top:40px;}</style><div id="container"><link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" rel="stylesheet" type="text/css">';
		foreach($campaigns as $campaign){
				//checksomething with the start date
				$beaconCheck = 0;
				foreach($beacons as $beacon){
					foreach($campaign->beacons as $cBeacon){
						if($beacon->_id == $cBeacon){
							$beaconCheck = 1;
						}
					}
				}
				//if is active, go through this loop to set the perks
				$todayd = date("d");
	            $todaym = date("n");
	            $todayy = date("Y");
	            $todayStamp = mktime(23,59,0,$todaym,$todayd,$todayy);

	            $data   = preg_split('/\s+/', $campaign->endDate);
	            $dataStamp = mktime(23,59,0,$data[1], $data[2], $data[0]);

	            $dataStart   = preg_split('/\s+/', $campaign->startDate);
	            $dataStartStamp = mktime(23,59,0,$dataStart[1], $dataStart[2], $dataStart[0]);

	            if($dataStamp >= $todayStamp && $dataStartStamp <= $todayStamp && $beaconCheck >= 1){
					foreach($campaign->exit as $entry){

						$superEntry[$campCount][$enCount] = $entry;
						$enCount++;
						$perk = \Perk::where('_id','=',$entry)->get()->first();
						//build html for the perk's appearance
								$label = $perk->label;
								if(strlen($label) >= 40){
									$label = substr($label,0,40).'...';
								}
								$title = '<h1 style="background:#fff;color:#000;margin:0;padding-top:30px;text-align:center;font-family:Lato light 100;font-weight:300;font-size:2.1em;max-width:70%;margin: auto;clear:both;">'.$perk->title.'</h1>';
								$banner = '<div style="background:#fff;" class="banner"><div  style="background:#fff;" class="left"><img class="mainImg" src="'.$logo.'"></div><div class="right"><span><br/>'.$label.'</span></div></div>';
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
								$html = '<div class="perkBody" style="width:100%;background:#fff;"><div class="perkHeader" style="width:100%;margin:auto;color:white;clear:both;">'.$banner.''.$mainImage.''.$title.'</div><div class="perkDesc" style="padding:5px;padding-bottom:20px;text-align:left;width:80%;margin:auto;background:#fff;color:#000;">'.$desc.'</div></div>';
								//if($pCount < $size){
									$html .= '<div style="margin:auto;width:100%;background:#3e4160;color:#3e4160;height:1px;"></div>';
								//}
								$superHTML .= $html;
								
									
								
						$campCount++;
						$super[$enCount] = $perk;
					}
				}
			
		}
		$superHTML .= '</div>';

		return $superHTML;
	}
	
}