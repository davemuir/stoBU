<?php
	header("Content-type: text/xml; charset=utf-8");
	
	$requestAllData = $_GET['requestAllData'];
	date_default_timezone_set('US/Eastern');
	$dateFmt = date('Y/m/d H:i', time());
	$data1 = 0;

    echo "<items>\n";
	echo "<infoMsg>\n";

	echo "<index>" . $dateFmt . "</index>\n";
	echo "<timeNow>" . $dateFmt . "</timeNow>\n";

	if($requestAllData == "true")
	{
		$yesterday = date('Y/m/d H:i', strtotime($dateFmt) - 24*60*60);
		
		$startDateTime = substr($yesterday, 0, 11) . "23:00";
		$endDateTime = substr($dateFmt, 0, 11) . "23:59";
		$nextInitDate = $endDateTime;

		$gap = strtotime($dateFmt) - strtotime($startDateTime);
		
		echo "<isInitData>true</isInitData>\n";
		echo "<nextInitDate>" . $nextInitDate . "</nextInitDate>\n";
		echo "<startDate>" . $startDateTime . "</startDate>\n";
		echo "<endDate>" . $endDateTime . "</endDate>\n";
		echo "</infoMsg>\n";

		for($i = 0; $i <= $gap; $i += 60*3)
		{
			$data1 = 100 + round(rand(1, 500)/2);

			$nextTime = strtotime($startDateTime) + $i;
			$baseDate = date("Y/m/d H:i", $nextTime);
			
			echo "<item>\n";
			echo "<date>" . $baseDate . "</date>\n";
			echo "<todayTotalData>" . $data1 . "</todayTotalData>\n";
			echo "</item>\n";
		}
	}
	else
	{
		echo "<isInitData>false</isInitData>\n";
		echo "</infoMsg>\n";

		$baseStartTime = time() - (60 * 10);
		
		$gap = time() - $baseStartTime;

		for($i = 0; $i <= $gap; $i += 60*3)
		{
			$data1 = 100 + round(rand(1, 500)/2);

			$nextTime = $baseStartTime + $i;
			$baseDate = date("Y/m/d H:i", $nextTime);

			echo "<item>\n";
			echo "<date>" . $baseDate . "</date>\n";
			echo "<todayTotalData>" . $data1 . "</todayTotalData>\n";
			echo "</item>\n";
		}
	}
	echo "</items>\n";
?>	