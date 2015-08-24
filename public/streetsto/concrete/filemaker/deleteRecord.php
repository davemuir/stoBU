<?php 
include 'FileMaker.php';
if(isset($_POST['recordID'])){
	$delete = $_POST['recordID'];
	$dbo = $_POST['dbo'];
	$dboName = $dbo[0];
	$dboHost = $dbo[1];
	$dboUser = $dbo[2];
	$dboPass = $dbo[3];
	$dboLayout = $dbo[4];
        $fm = new FileMaker($dboName,$dboHost,$dboUser,$dboPass);
	$rec = $fm->getRecordById($dboLayout, $delete);
	$rec->delete();
        echo json_encode($dbo);
}else{
echo "no request";
}
?>
