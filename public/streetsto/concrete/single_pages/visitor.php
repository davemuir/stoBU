<?php
defined('C5_EXECUTE') or die("Access Denied.");
if(isset($_GET['lid'])){
	$location =  $_GET['lid'];
	$location = preg_replace('/\\?.*/', '', $location);
	//echo "<script> var location = ".$location."; alert(location); </script>";

	//do filemaker call build list.
?>
<style>
	.streetsList{
		list-style-type: none;
		list-style: none;
	}
	#menuList li{
		margin-bottom:10px;
		list-style-type: none;
		list-style: none;
	}
	#menuList li h4{
		text-align:center;
	}
	
	#topHalfInner{
		background:rgba(255,255,255,0.5);
	}
	#top{
		height:50px;
	}
	#topHalfInner h3{
		margin-top:8px !important;
		margin-bottom:0px !important;
		color:#000;
	}
	.col-sm-12{
		padding:0px !important;
	}
	#menuListContainer{
		margin:auto;
		width:90%;
	}
	#map-canvas { 
		height: 200px;
		width:100%;
		margin: 0; 
		padding: 0;
	}
</style>
	 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOyhAG7XU7oxlzvzduNJYjFdJxV6LkiY8">
    </script>
	<script>
	
	$(document).ready(function(){
		var pmarkers = [];
		//get post - location id
		function get_query(){
    		var url = location.href;
    		var qs = url.substring(url.indexOf('?') + 1).split('&');
		    for(var i = 0, result = {}; i < qs.length; i++){
		        qs[i] = qs[i].split('=');
		        result[qs[i][0]] = decodeURIComponent(qs[i][1]);
		    }
		    return result;
		}
		
		var loc = get_query();
			loc = loc['lid'];
			
		
		
			$.ajax({
				    type: 'post',
					url: 'http://192.168.128.157/filemaker/list.php',
				    data: {lid:loc},
				    success: function(response) {
				    	var resp = JSON.parse(response);	
				    	console.log(resp);

				    	var attrs = resp[1];
				    	resp = resp[0];
				    	var map = attrs[0].map;
				    	var img = attrs[0].img;
				    	var name = attrs[0].location;
				    	var phone = attrs[0].phone;
				    	var address = attrs[0].address;
				    	var description = attrs[0].description;
				    	var hours = attrs[0].hours;
				    	var latitude = attrs[0].latitude;
				    	var longitude = attrs[0].longitude;
				    	var tags = attrs[0].tags;
				    	
						$('#topHalf').css({"background":"url("+img+")","background-size":"cover","width":"100%","height":"50%"});
						$('#topHalfInner').append("<h1>"+name+"</h1><h3>"+phone+"</h3><h3>"+address+"</h3><h3>"+hours+"</h3>");
				    	$('#description p').html(description);
				    	$('#tags p').html('<b>Tags</b> : '+tags);



			    		for(var record in resp){	
			    			var otag = resp[record].otag;
			    			
			    			
			    				var items = "<li";
			    				items += " class='locationItem' data-req='"+resp[record].location+"' id='"+resp[record].menu+"'><"+resp[record].otag+">"+resp[record].title+"</"+resp[record].otag+">";
			    				console.log(resp[record].title);
			    				items += "</li>";
			    				$("#tableList").append(items);
			    		}
				    			
				    	$(".locationItem").click(function(){
				    		var locationID = $(this).attr("data-req");
							var menu = $(this).attr("id");
							var title = $(this).text();
				    		handleChoice(locationID,menu,title);
				    	});

								    	//initialize google map api calls
						var myLatlng = new google.maps.LatLng(latitude,longitude);
						var mapOptions = {
						  zoom: 16,
						  center: myLatlng
						}
						var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

						var marker = new google.maps.Marker({
						    position: myLatlng,
						    title:name
						});
						marker.setMap(map);

							var contentString = '<div id="content">'+
							      '<div id="siteNotice">'+
							      '</div>'+
							      '<h4 id="firstHeading" class="firstHeading">'+name+'</h4>'+
							      '<div id="bodyContent">'+
							      '<p>'+address+'</p>'+
							      '</div>'+
							      '</div>';

							var infowindow = new google.maps.InfoWindow({
							      content: contentString
							});
						    google.maps.event.addListener(marker, 'click', function() {
						   		 infowindow.open(map,marker);
						 	});
						 	//google.maps.event.addDomListener(window, 'load', initialize);
	
						 	$('#parking').click(function(){
						 	var parkingToggle = $(this).attr('class');
						 	if(parkingToggle == 'active'){
							  	
								
								$('#parking').removeClass('active');
								addParking(map);
							}else{   	
								 $('#parking').addClass('active');	
								 removeParking(map);
							}
						});
					}
		});
		function removeParking(map){
			$.ajax({
			    type: 'get',
			   dataType: 'jsonp',
				url: 'https://www.car2go.com/api/v2.0/parkingspots',
			    data: {loc:"Toronto",format:"json"},
			    success:function(response){
			  		var ps = response['placemarks'];
			  		
			    	
			    		
			    	for(var p in ps){
			    		
			    		var ll = ps[p].coordinates;
			    		ll =  ll.replace('[','');
			    		ll =  ll.replace(',0]','');

			    		
			    		var parts = ll.split(',', 2);
			    		var lon = parts[0];
			    		var lat = parts[1];
			    		lon = +lon;
			    		lat = +lat;
			    		
			    	
				    	var myLatlng = new google.maps.LatLng(lat,lon);

				    	var pmarker = new google.maps.Marker({
						    position: myLatlng,
						    icon:{
						        path: google.maps.SymbolPath.CIRCLE,
						        strokeColor: "green",
						        scale: 4
						    },
						    title:ps[p].name
						});
						console.log('remove');
						pmarker.setMap(null);
					}
					
			    }
			});
		}
		function addParking(map){
			$.ajax({
			    type: 'get',
			   dataType: 'jsonp',
				url: 'https://www.car2go.com/api/v2.0/parkingspots',
			    data: {loc:"Toronto",format:"json"},
			    success:function(response){
			  			
						
						pmarker.setMap(map);
						console.log('add');
					}
					
			    }
			});
		}
		//for getting the menus 
		function handleChoice(locationID,menu,title){
			
			
			$.ajax({
				    type: 'post',
					url: 'http://192.168.128.157/filemaker/menus.php',
				    data: {location:locationID,menu:menu,title:title},
				    success: function(response) {
				    	var resp = JSON.parse(response);	
				    	var size = resp.length;
				    	
				    	console.log(resp);
				    	$('#menuList').empty();

				    	var categoryCheck = 0;

				    	for(var i=0;i<size;i++){	
				    		
				    		var record = resp[i]._impl['_fields'];

				    		var item = "<li>";
				    		for(var field in resp[i]._impl['_fields']){
				    			console.log(resp[i]._impl['_fields']);

				    			
				    			if(field == "category"){
				    				if(record[field] != "" && categoryCheck != 1){

				    					$("#menuList").append("<li><h4>"+record[field]+"</h4></li>");
				    					categoryCheck = 1;
				    				}else{
				    					categoryCheck = 0;
				    				}

				    			} 
				    			

				    			if(field != "lid" && field != "category"){
				    				if(field == "price"){
				    					item += "<b>"+record[field]+"</b> - ";
				    				}else{
				    					item += record[field]+" - ";
				    				}
				    			} 
				    		}
				    		item += "</li>";
				    		$('#menuList').append(item);
				    		
				    	}
					}
			});
		}
		function removeParking(){
		}

});
	</script>
	
	<div id="topHalf">
		<div id="top">
		
		</div>
		<div id="topHalfInner">
		
		</div>
	</div>
	<div>
		<div id="map-canvas">

		</div>
	</div>
	<button id="parking" class="active">parking</button>
	<div id="description">
		<p></p>
	</div>
	<div id="tags">
		<p></p>
	</div>
	<ul class="streetsList" id="tableList">
	
	</ul>
	<div id="menuListContainer">
		<ul id="menuList">
		
		</ul>
	</div>
<?php
}


?>
