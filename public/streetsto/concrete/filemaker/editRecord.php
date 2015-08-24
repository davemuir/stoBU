<?php 
include 'FileMaker.php';
var_dump($_POST);
if(isset($_POST['edit'])){
	$edit = $_POST['edit'];
	$recID = $_POST['recordID'];
        $fm = new FileMaker('test.fmp12', '192.168.128.136', 'Admin', 'hack123');
	$newEdit = $fm->newEditCommand('test', $recID, $edit);
	$result = $newEdit->execute(); 
        echo $result;
}else{
echo "no request";
}
?>
