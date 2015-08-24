<?php
	header("Content-type: text/xml; charset=utf-8");
	
	$p1 = rand(1, 100);
	$p2 = rand(1, 100);
	$p3 = rand(1, 100);

	// date format example : "2010/02/15 20:30:00"
	date_default_timezone_set('US/Eastern');
	$dateFmt = date('Y/m/d H:i:s', time());
	
	echo "<items>\n";
	echo "<item>\n";
	echo "<Time>" . $dateFmt . "</Time>\n";
	echo "<P1>" . $p1 . "</P1>\n";
	echo "<P2>" . $p2 . "</P2>\n";
	echo "<P3>" . $p3 . "</P3>\n";
	echo "</item>\n";
	echo "</items>\n";
?>