<?php
	header("Content-type: text/xml; charset=utf-8");

	$requestAllData = $_GET['requestAllData'];
	date_default_timezone_set('US/Eastern');
	$dateFmt = date('Y/m/d H:i:s', time());
	$data1 = 0;
        
	echo "<items>\n";
	echo "<infoMsg>\n";
    
	echo "<index>0</index>\n";
	echo "<timeNow>" . $dateFmt . "</timeNow>";
    		
	$second = substr($dateFmt, 17, 2);
	$startDateTime = date('Y/m/d H', strtotime($dateFmt) - 24*60*60) . ":00:" . $second;
	$endDateTime = date('Y/m/d H', strtotime($dateFmt) - 23*60*60) . ":00:00";
	$nextInitTime = date('Y/m/d H', strtotime($dateFmt) + 60*60) . ":00:00";
	    
	echo "<isInitData>true</isInitData>\n";
	echo "<nextInitDate>" . $nextInitTime . "</nextInitDate>\n";
    	
	echo "<endDate>" . $endDateTime . "</endDate>\n";
	echo "</infoMsg>\n";
    	
	$gap = strtotime($endDateTime) - strtotime($startDateTime);
    	
	for($i = 0; $i <= $gap; $i += 5)
	{
		$data1 = 100 + round(rand(1, 100)/2);
    
		$nextTime = strtotime($startDateTime) + $i;
		$baseDate = date('Y/m/d H:i:s', $nextTime);
    		
		echo "<item>\n";
		echo "<date>" . $baseDate . "</date>\n";
		echo "<yesData>" . $data1 . "</yesData>\n";
		echo "</item>\n";
	}
        
	echo "</items>\n";
?>