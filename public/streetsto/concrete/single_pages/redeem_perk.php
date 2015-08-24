<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>
<script>
$.ajax({
	    type: 'get',
		url: 'http://192.168.128.157/filemaker/perks.php?loc=2',
	    data: {id:223},
	    success:function(response){
	  		console.log(response);
	  	}
});
</script>