<?php
defined('C5_EXECUTE') or die("Access Denied.");
if(isset($_GET['lid'])){
	$location =  $_GET['lid'];
	$location = preg_replace('/\\?.*/', '', $location);
	//do filemaker call build list.
?>
<style>
	.btn-primary{
		padding: 5px 15px 5px 15px !important;
		background-color:#3a5fa6;
		font-family:Lato;
	}
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
		margin-top:0px !important;
		margin-bottom:0px !important;
		color:#000;
		font-size:16px;
		font-family:Lato;
	}
	#topHalfInner h3,#topHalfInner h1{
		width:90%;
		margin:auto;
		font-family:Lato;
	}
	#topHalfInner h1{
		padding-top: 10px;
	}
	.col-sm-12{
		padding:0px !important;
	}
	#menuListContainer{
		margin:auto;
		margin-top:40px;
		width:88%;
	}
	#menuList{
		padding:0px;
	}
	#map-canvas { 
		height: 200px;
		width:100%;
		margin: 0; 
		padding: 0;
	}
	#description,#tags{
		margin:auto;
		margin-top:20px;
		width:90%;
	}
	.catTitle{
		text-align:center;
		margin-bottom:20px;
		font-family:Lato;
	}p{
		font-family:Lato;
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
			
			//alert(loc);
		
			$.ajax({
				    type: 'post',
					url: 'http://sto.apengage.io/filemaker/list.php',
				    data: {lid:loc},
				    success: function(response) {
				    	var resp = JSON.parse(response);	
				    	console.log(resp);

				    	var attrs = resp;
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



			    		/*for(var record in resp){	
			    			var otag = resp[record].otag;
			    			
			    			
			    				var items = "<li";
			    				items += " class='locationItem' data-req='"+resp[record].location+"' id='"+resp[record].menu+"'><"+resp[record].otag+">"+resp[record].title+"</"+resp[record].otag+">";
			    				console.log(resp[record].title);
			    				items += "</li>";
			    				$("#tableList").append(items);
			    		}*/
				    			
				    	/*$(".locationItem").click(function(){
				    		var locationID = $(this).attr("data-req");
							var menu = $(this).attr("id");
							var title = $(this).text();
				    		handleChoice(locationID,menu,title);
				    	});*/

								    	//initialize google map api calls
						var myLatlng = new google.maps.LatLng(latitude,longitude);
						var mapOptions = {
						  zoom: 15,
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
							      '<div id="bodyContent">'+
							      '<p><h4 id="firstHeading" class="firstHeading">'+name+'</h4>'+address+'</p>'+
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
						 	//alert('parking');
							  	
								
							
								addParking(map);
							
						});
					}
		});
	
		function addParking(map){
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
						
						pmarker.setMap(map);
					}
					
			    }
			});
		}
	
		//for getting the menus 
		/*
		function handleChoice(locationID,menu,title){
			
			//alert('choice');
			$.ajax({
				    type: 'post',
					url: 'http://sto.apengage.io/filemaker/menus.php',
				    data: {location:locationID,menu:menu,title:title},
				    success: function(response) {
				    	var resp = JSON.parse(response);	
				    	var size = resp.length;
				    	
				    	console.log(resp);
				    	$('#menuList').empty();
				    	$('#listTable tbody').empty();

				    	var categoryCheck = 0;

				    	for(var i=0;i<size;i++){	
					    if(title == "Lunch" || title == "Dinner"){	
					    		var record = resp[i]._impl['_fields'];
					    	
					    		var item = "<tr>";
					    		for(var field in resp[i]._impl['_fields']){
					    			console.log(resp[i]._impl['_fields']);

					    			
					    			if(field == "category"){
					    				if(record[field] != "" && categoryCheck != 1){

					    					$("#listTable tbody").append("<tr><td colspan=3><h3 class='catTitle'>"+record[field]+"</h3></td></tr>");
					    					categoryCheck = 1;
					    				}else{
					    					categoryCheck = 0;
					    				}

					    			} 
					    			if(field != "lid" && field != "category"){
					    				if(field == "price"){
					    					item += "<td class='last price'>"+record[field]+"</td> - ";
					    				}
					    				if(field == "title"){
					    					item += "<td class='first title'>"+record[field]+"</td> - ";
					    				}
					    				if(field == "description"){
					    					item += "<td class='middle desc'>"+record[field]+"</td> - ";
					    				}
					    			} 
					    		}
					    		item += "</tr>";
					    		$('#listTable tbody').append(item);
					    		
					    	
					    	$('#listTable tbody tr').each(function(){
							var row = $(this);
							var target = row.children('td.middle');
							row.children('.first').insertBefore(target);
										
							});
						}
						if(title == "Wine"){	
							var record = resp[i]._impl['_fields'];
					    	
					    		var item = "<tr>";
					    		for(var field in resp[i]._impl['_fields']){
					    			console.log(resp[i]._impl['_fields']);

					    			if(field == "category"){
					    				if(record[field] != "" && categoryCheck != 1){

					    					$("#listTable tbody").append("<tr><td colspan=3><h3 class='catTitle'>"+record[field]+"</h3></td></tr>");
					    					categoryCheck = 1;
					    				}else{
					    					categoryCheck = 0;
					    				}

					    			} 
					    			if(field != "lid" && field != "category"){
					    				if(field == "price"){
					    					item += "<td class='last price'>"+record[field]+"</td> - ";
					    				}
					    				if(field == "vintage"){
					    					item += "<td class='first title'>"+record[field]+"</td> - ";
					    				}
					    				if(field == "description"){
					    					item += "<td class='middle desc'>"+record[field]+"</td> - ";
					    				}
					    			} 
					    		}
					    		item += "</tr>";
					    		$('#listTable tbody').append(item);
					    		$('#listTable tbody tr').each(function(){
							var row = $(this);
							var target = row.children('td.middle');
							row.children('.first').insertBefore(target);
										
							});
					    }
					    
					}
				}	
				
			});
		}*/


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
	<a href="http://sto.apengage.io/streetsto/index.php"><button class="btn btn-primary">Main Menu</button></a>
	<button id="parking" class="btn btn-primary active">Show Parking</button>
	<div id="description">
		<p></p>
	</div>
	<div id="tags">
		<p></p>
	</div>
	<ul class="streetsList" id="tableList">
	
	</ul>
	<div id="menuListContainer">
		<!--<ul id="menuList">
		
		</ul>-->
		<table id="listTable">
			<tbody>

			</tbody>
		</table>
	</div>
<?php
}


?>
