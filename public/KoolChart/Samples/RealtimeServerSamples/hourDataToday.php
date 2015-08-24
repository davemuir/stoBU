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
		//The hour of current time
		$hour = substr($dateFmt, 11, 2);
		//yyyy/mm/dd
		$ymd = substr($dateFmt, 0, 10);
		
		$startDateTime = $ymd . " " . $hour . ":00:" . $second;
		$endDateTime = date('Y/m/d H', strtotime($startDateTime) + 60*60) . ":00:00";
		
		echo "<isInitData>true</isInitData>\n";
		echo "<nextInitDate>" . $endDateTime . "</nextInitDate>\n";
		echo "<startDate>" . $startDateTime . "</startDate>\n";
		echo "<endDate>" . $endDateTime . "</endDate>\n";
		
		echo "</infoMsg>\n";
		
		//long gap = date.getTime() - startDateTime;
		
		$endDate = strtotime($dateFmt);
		$startDate = strtotime($startDateTime);
		$gap = $endDate - $startDate;
		
		for($i = 0; $i <= $gap; $i += 5)
		{
			$data1 = 100 + round(rand(1, 100)/2);

			$nextTime = $startDate + $i;
			$baseDate = date("Y/m/d H:i:s", $nextTime);  
			
			echo "<item>\n";
			echo "<date>" . $baseDate . "</date>\n";
			echo "<todayData>" . $data1 . "</todayData>\n";
			echo "</item>\n";
		}
	}
	else
	{
			echo "<isInitData>false</isInitData>\n";
			echo "</infoMsg>\n";

			$data1 = 100 + round(rand(1, 100)/2);

			echo "<item>\n";
			echo "<date>" . $dateFmt . "</date>\n";
			echo "<todayData>" . $data1 . "</todayData>\n";
			echo "</item>\n";
	}
    echo "</items>\n";
?>