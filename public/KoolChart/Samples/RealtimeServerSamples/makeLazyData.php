<?php
	header("Content-type: text/xml; charset=utf-8");
	
	$index = $_GET['index'];

	$random1 = 0;
	$random2 = 0;
	$random5 = 0;

	$data1 = 0;
	$data2 = 0;
	$trdvolume = 0;
	
	echo "<items>\n";
	for($i = $index; $i < $index + 20 ; ++$i){
		// generates random data
		$data1 = rand(0, 19999) + 20000;
		$data2 = rand(0, 19999) + 20000;
		
		$trdvolume = rand(0, 119999) + 20000;
		
		echo "<item>\n";
		echo "<index>" . $i . "</index>\n";
		echo "<data1>" . $data1 . "</data1>\n";
		echo "<data2>" . $data2 . "</data2>\n";
		echo "<trdvolume>" . $trdvolume . "</trdvolume>\n";
		echo "</item>\n";
	}
    echo "</items>\n";
?>
