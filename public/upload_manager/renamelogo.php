<?php
	$oldFileName   = "../userlogo/{$_REQUEST['company']}/{$_REQUEST['file']}";
	$oldThumb_Name = "../userlogo/{$_REQUEST['company']}/thumb_{$_REQUEST['file']}";
	$tmp=explode(".",$_REQUEST['file']);
	$type=$tmp[count($tmp)-1];
	if($type!=''){
		$newFileName   = "../userlogo/{$_REQUEST['company']}/{$_REQUEST['rename']}.{$type}";
		$newThumb_Name = "../userlogo/{$_REQUEST['company']}/thumb_{$_REQUEST['rename']}.{$type}";
		if( file_exists( $newFileName ) ){
			$newName=createFileName($_REQUEST['rename'],1,$type,$_REQUEST['company']);
			$newFileName   = "../userlogo/{$_REQUEST['company']}/{$newName}.{$type}";
			$newThumb_Name = "../userlogo/{$_REQUEST['company']}/thumb_{$newName}.{$type}";
		}
		@rename($oldFileName  ,$newFileName  );
		@rename($oldThumb_Name,$newThumb_Name);
	}
	//---------------------------------------------------------------------
	function createFileName($name,$id,$type,$company){
		$newFileName = "../userlogo/{$company}/{$name}_{$id}.{$type}";
		if( file_exists( $newFileName ) ){
			return createFileName($name,($id+1),$type,$company);
		}
		return "{$name}_{$id}";
	}
?>