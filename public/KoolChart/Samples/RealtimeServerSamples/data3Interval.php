<?php
	header("Content-type: text/xml; charset=utf-8");
	
	$requestAllData = $_GET['requestAllData'];
	date_default_timezone_set('US/Eastern');
	$dateFmt = date('Y/m/d H:i:s', time());
	$data1 = 0;
	
    echo "<items>\n";
	echo "<infoMsg>\n";

	echo "<index>" . 0 . "</index>\n";
	echo "<timeNow>" . $dateFmt . "</timeNow>\n";

	if($requestAllData == "true")
	{
			
		//The second of current time
		$second = substr($dateFmt, 17, 2);
		//yyyy/mm/dd hh:mm
		$ymd = substr($dateFmt, 0, 16) . ":00";
		
		$startDateTime = $dateFmt;
		$endDateTime = date('Y/m/d H:i:s', strtotime($ymd)+600); 
		
		echo "<isInitData>true</isInitData>\n";
		echo "<nextInitDate>" . $endDateTime . "</nextInitDate>\n";
		
		echo "<startDate>" . $startDateTime . "</startDate>\n";
		echo "<endDate>" . $endDateTime . "</endDate>\n";
		
		echo "</infoMsg>\n";
		
		$data1 = 50 + rand(1, 100);

		echo "<item>\n";
		echo "<date>" . $dateFmt . "</date>\n";
		echo "<data3>" . $data1 . "</data3>\n";
		echo "</item>\n";
	}
	else
	{
		echo "<isInitData>false</isInitData>\n";
		echo "</infoMsg>\n";

		$data1 = 50 + rand(1, 100);

		echo "<item>\n";
		echo "<date>" . $dateFmt . "</date>\n";
		echo "<data3>" . $data1 . "</data3>\n";
		echo "</item>\n";
	}
    echo "</items>\n";
?>