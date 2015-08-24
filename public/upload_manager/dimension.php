<?php
	list($width, $height, $type, $attr) = getimagesize("../userlogo/{$_REQUEST['name']}");
	if($width == $height){
		$width = $height = 64;
	}else{
		if($width < $height){
			$width  = round( ($width*64)/$height );
			$height = 64;
		}else{
			$height  = round( ($height*64)/$width );
			$width = 64;
		}
	}
?>
{
	"jsonrpc" : "2.0", 
	"name" : "<?php echo $_REQUEST['name']; ?>" , 
	"width":"<?php echo $width; ?>" , 
	"height":"<?php echo $height; ?>" , 
	"tag":"<?php echo $_REQUEST['tag']?>" 
}