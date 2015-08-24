<style>
body, li, h3{
font-family:Lato !important;
}
</style>
<?php
if($_POST['subject']){
	//hit file maker script
	?>

<script>
$(document).ready(function(){
	//setTimeout(function(){
		var term = $("#term").val();
		console.log(term);
		$.ajax({
				    type: 'post',
					url: 'http://192.168.128.157/filemaker/search.php',
				    data: {term:term},
				    success: function(response) {
				    	
				    	response = JSON.parse(response);
				    	console.log(response);
				    	
				    	var tags = response['tags'];
				    	var size = tags.length;
				    	$('#responseArea').append('<h3>'+tags[0]+'</h3>');
				    	if(size > 1){
				    		$('#responseArea').append('<ul id="inTags">');
					    	for(var i = 1;i < size;i++){
					    		console.log(tags[i].description);
					    		$('#inTags').append('<li><b><a href="../location?lid='+tags[i].locationName+'">'+tags[i].locationName+'</a></b> - '+tags[i].description.substr(0,80)+'...</li>');
					    	}
					    }

					    var tags = response['locs'];
				    	var size = tags.length;
				    	$('#responseArea').append('<h3>'+tags[0]+'</h3>');
				    	if(size > 1){
				    		$('#responseArea').append('<ul id="inLocs">');
					    	for(var i = 1;i < size;i++){
					    		console.log(tags[i].description);
					    		$('#inLocs').append('<li><b><a href="../location?lid='+tags[i].locationName+'">'+tags[i].locationName+'</a></b> - '+tags[i].description.substr(0,80)+'...</li>');
					    	}
					    }
				    	
				    	

				    }
		});
	//}, 1000);
	/*
	$.ajax({
			    type: 'post',
				url: 'http://192.168.128.157/filemaker/streetsto_beacons.php',
			    data: {term:'1'},
			    success: function(response) {
			    	console.log(response);
			    }
	});*/
});
</script>
	<a href="http://sto.apengage.io/streetsto/index.php"><button class="btn btn-primary">Main Menu</button></a>
<div id="responseArea">

</div>
<input type="hidden" id="term" name="Language" value="<?php echo $_POST['subject'];?>">
<?php
	//echo "Results for : ".$_POST['subject'];
}else{
	echo "Try Searching for some terms";
}
?>