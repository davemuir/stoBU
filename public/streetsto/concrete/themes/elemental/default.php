<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>
<?php
$u = new User();
$user =  $u->getUserName();
 if($user == '' ){
 	header('Location:http://sto.apengage.io/streetsto/index.php/splash');
 	die();
 }
function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        //'/android/i' => 'Android',  
    );
    //array for chrome and android
    $bMobileUA = array(
        '/blackberry/i' => 'BlackBerry', 
        '/chrome/i'     =>  'Chrome'
    );
    //any handheld browser
     $cMobileUA = array(
        '/mobile/i'     =>  'Handheld Browser',
        '/webos/i' => 'Mobile',
    );
    //Return true if Mobile Agent is detected
    foreach($bMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            //return true;
            echo 'chrome detected';
            return true;
        }
    }
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            //return true;
            echo 'i-device detected';
            return true;
        }
    }
    //Otherwise on a web browser 
   
    //echo 'false';
    //return false;
}
isMobileDevice()
 ?>
<link rel="stylesheet" href="/css/streetsList.css"/>

<style>

	.list{
		list-style: none;
		padding-left:0px;
	}
	.list .leftSpan{
		margin-left:40px;
		font-family:Lato;
	}
	.locationList{
		font-family:Lato;
	}
	.parentList:hover,.typeList:hover,.locationList:hover{
		background:#cccccc;
		color:#fff;
	}
	.parentList,.typeList,.locationList{
		font-size:20px;
		padding: 14px 0px;
		padding-left:5%;
		border-bottom:1px solid #cccccc;
	}
	.parentList:first-child,.typeList:first-child,.locationList:first-child{
		border-top:1px solid #cccccc;
	}
	.backButton{
		font-size:27px;
		padding-left:5%;
	}
	#backContainer .iconContainer .icon {
		position:relative !important;
		width:5em !important;
		height:5em !important;
	}
	#backContainer .iconContainer{
		margin:auto;
		width:5em;
	}
	.backButton{
		color:#00b8ba;
		font-weight:900;
		text-shadow: 0px 0px 2px #fff;
	}
	h3{
		text-align:center;
		color:#fff !important;
		font-size:20px;
		padding-top:20px;
		padding-bottom:10px;
		margin:0;
		text-shadow: 0px 0px 2px #2f2f2f;
		font-family:Lato !important;
		font-size:25px !important;
	}
	.btn-primary{
		padding: 5px 15px 5px 15px !important;
		background-color:#3a5fa6;
	}
	/*.list span{
		text-transform: lowercase;
	}
	.list span:first-letter{
		text-transform: uppercase;
	}*/
</style>
<main>
	<div class="mainContainer">
<?php
$a = new Area('Main');
$a->enableGridContainer();
$a->display($c);
?>
<script>
$(document).ready(function(){
	//populate the workbook select

	getSelect();
	function getSelect(){
		$('.mainContainer').fadeIn("fast", function() {
  					});
		$("#backContainer").empty();
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'http://sto.apengage.io/filemaker/list.php', false);
		xhr.send(null);
		if (xhr.status == 200) {
				$("#backContainer").css({'height':'auto'});
			     var resp = JSON.parse(xhr.response);	
			     console.log(resp);
			     $('.list').empty();
			    for (record in resp) {
			    	$('.list').append("<li class='parentList' id='"+record+"'><svg class='icon icon-"+record+"''><use xlink:href='#icon-"+record+"''></use></svg><span class='leftSpan'>"+resp[record]+"</span></li>");
				}

				$('.parentList').click(function(){
					var type = $(this).attr('id');
					var name = $(this).children('span').text();
					$('.mainContainer').fadeOut( "fast", function() {
    						// Animation complete.
    						getType(type,name);
  					});
					
				});
		}
	}

	//function for location
	function getType(type,name){
		$("#backContainer").empty();
		$("#backContainer").css({'background':'url(/img/'+type+'.png)','background-repeat': 'no-repeat','height':'200px', 'background-size': 'cover' });
		$("#backContainer").append('<h3>'+name+'</h3><div class="iconContainer"> <svg class="icon icon-'+type+'""><use xlink:href="#icon-'+type+'"></use></svg></div><span class="backButton" id="back"> <button class="btn btn-primary">Main Menu</button> </span>');
		$('#back').click(function(){
			 typeBack();
		});
		
		$.ajax({
			    type: 'post',
				url: 'http://sto.apengage.io/filemaker/list.php',
			    data: {type:type},
			    success: function(response) {
			    	$('.mainContainer').fadeIn("fast", function() {
  					});
			    	var resp = JSON.parse(response);	
			   		console.log(resp);
			     	$('.list').empty();
			   		for (record in resp) {
			    		$('.list').append("<li class='locationList' id='"+record+"'><span>"+resp[record]+"</span></li>");
					}
			    	$('.locationList').click(function(){
			    		var favouriteID = $(this).attr("id");
			    		var location = $(this).text();
			    		window.location = "index.php/location?lid="+location;
			    	});
			    }
		});
	}
	function typeBack(){
		$('.mainContainer').fadeOut( "fast", function() {
    						getSelect();
    						
  					});
		

	}

});

</script>
<div id="backContainer">
	
</div>
<ul class="list">

</ul>
<?php
$a = new Area('Page Footer');
$a->enableGridContainer();
$a->display($c);
?>
</div>
</main>

<?php  $this->inc('elements/footer.php'); ?>
