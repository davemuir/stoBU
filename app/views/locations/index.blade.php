<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Locations</title>
@include("header2")
<?php
  $user = Auth::user();
?>  
@include("guestNav2")
<style>
 
#panel {
position: relative;
background-color: #fff;
padding: 5px;
}
#map-canvas{
	height:290px;
	width:100%;
}
#mapZone{
	width:100%;
	float:left;
}
#reviewZone{
	width:40%;
	float:left;
	padding:0px 10px;
}
#entryTable tr th:nth-last-child(2),#exitTable tr th:nth-last-child(2){
width:90%;
}
#entryTable, #exitTable{
	border-radius:5px !important;
	width:90% !important;
	margin:auto;
}
#entryTable thead tr, #exitTable thead tr{
	background:#efefef !important;
}
table.table-striped.table tr th{
	color:#000 !important;
}
.tab-content{
background:#fff;
padding-bottom:20px;
box-shadow: 1px 1px 1px 1px #dedede;
min-height:340px;
}
.bar{
	height:100%;
	background-color: #149bdf;
	width:25%;
}
ol{
	list-style-type:decimal !important;
}
h3{
	font-size:18px;
	color:#4d4d4d !important;
	font-weight:500;
	margin-bottom:10px;
}
h4{
	font-size:16px;
	color:#4d4d4d !important;
}
.progress.active .bar {
  -webkit-animation: progress-bar-stripes 2s linear infinite;
  background-image: -webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));
  background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);
  background-image: -moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);
  background-image: -o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);
  background-image: linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);
  -webkit-background-size: 40px 40px;
  -moz-background-size: 40px 40px;
  -o-background-size: 40px 40px;
  background-size: 40px 40px;
 }
 .ms-container{
 	width:100% !important;
 }
 #exitReviewList, #entryReviewList, #beaconReview{
 	margin-left:20px;
 }
 .nav-pills>li {
 	width:33%;
 	text-align:center;
 }
 .icon{
 	width:60px;
 	height:60px;
 	fill:#25ad98 !important;
 }
 ul.nav-pills li.active a:hover, .active, ul.nav-pills li a, ul.nav-pills li, ul.nav-pills li a:hover{
 	background:rgba(0,0,0,0) !important;
 	padding:0 !important;
 }
ul.nav-pills li.active a{
	background:rgba(0,0,0,0) !important;
}
.labelIcons{
	padding-top:10px;
}
#submitLocation{
	bottom:0;
	position: absolute;
}



.dataTables_length, .dataTables_filter {
  margin: 0 15px;
}
#campaignTable th, #campaignTable tbody td{
  border:1px solid #dddddd;
  border-left:none;
}
#campaignTable{
  padding-top:15px;
  font-size:14px;
}
.dataTables_wrapper .dataTables_filter input{
  float:right;
}
#campaignTable th:first-child{
border-left:1px solid #dddddd;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
  color:#1189a4 !important;
  background:#fff;
  border: 1px solid #cacaca;
}
.icon-editicon-01{
    width: 22px;
  height: 22px;
}
.editTD{
  text-align:center;
}
.icon-plus{
  fill:#1c7c6c;
  width: 23px;
  height: 23px;
  margin-top: 11px;
  margin-left:15px;
}
.dataTables_wrapper{
  margin-top:10px;
}
h1{
  float:left;
  color:#1c2025 !important;
}
.circle {
  width: 10px;
  height: 10px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  float:right;
  margin-top: 5px;

}
.green{
  background:#3DC23D;
  /*box-shadow:0px 1px 7px 1px #005926;
    box-shadow: 0px 1px 0px 1px #005926;
  */
}
.red{
  background:red;
  /*box-shadow:0px 1px 7px 1px #8A010B;
    box-shadow: 0px 1px 0px 1px #8A010B;
  */
}
.panel-heading{
  background:#dedede !important;
  text-align:left;
}
.campaignWrapper{
  background:#fbfbfb;
  margin-top:30px;
}
td .icon{
	width:22px;
	height:22px;
	display:block;
	margin: auto;
	fill:#666666 !important;
}
td .icon:hover{
	cursor:hand;
}
.icon-plus{
	fill: #1189a4 !important;
}
.label.label-primary{
	background-color:#1188a3;
	margin:5px;
}
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOyhAG7XU7oxlzvzduNJYjFdJxV6LkiY8"></script>
<script>
	$(document).ready(function(){
		var companyID = "<?php echo $user->companyID;?>";
		var rootLocation = location.hostname;
		//remove function
		$('.see').click(function(){
			var geocoder = new google.maps.Geocoder();
			var infowindow = new google.maps.InfoWindow();
			var address = $(this).attr('address');
			geocoder.geocode({ 'address': address}, function(results, status) {
				     var p = results[0].geometry.location;
				     console.log(results);
					 map.setCenter(p);		
					      
			});
			
		});
		$('.icon-bin').click(function(){
			var id = $(this).attr('id');
			 var c = confirm("Are you Sure?");
		    if (c == true) {
		  		$.ajax({
				    type: 'post',
					url: 'http://'+rootLocation+'/index.php/locations/remove',
				    data: {id:id},
				    success: function(response) {	
				   		console.log(response);
				   		//$('#campaignRoot').html('<h1>Campaign Successfully Saved</h1>');
				   		setTimeout(function(){  
	                    	window.location.assign('http://'+rootLocation+'/index.php/locations');
	                  	}, 1000);
				    }
				});
		    } else {
		    return false;
		    }
	
		});
		$('.icon-editicon-01').click(function(){
			var id = $(this).attr('id');
			
			window.location.href = 'http://'+rootLocation+'/index.php/locations/edit/'+id;
				
		});
		$('#campaignTable').DataTable( {
		    paging: true,
		    "order": [[0, "asc" ]]
		  });

		var latlng = new google.maps.LatLng(43.7000, -79.4000);
		var mapOptions = {
			    zoom: 3,
			    center: latlng,
			  }
		var addressString = "366 Adelaide street east, Canada";
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		codeAddress(addressString,latlng,map,companyID);
	});

	
	function codeAddress(addressString,latlng,map,companyID) {
			var rootLocation = location.hostname;
			//get the locations 
			$.ajax({
				    type: 'get',
					url: 'http://'+rootLocation+'/index.php/api/locations/'+companyID,
				    success: function(response) {	
				   		//console.log(response);
				   		var allLocations = response;
				   		var address,marker;
				   		var geocoder = new google.maps.Geocoder();
				   		var infowindow = new google.maps.InfoWindow();
				   		for( var location in allLocations ){
							  
							  address = allLocations[location].address;
							  title = allLocations[location].name;
								 var title2 = title+address;
							  	geocoder.geocode({ 'address': address}, function(results, status) {
							     var p = results[0].geometry.location;
							     console.log(results);
							      var marker = new google.maps.Marker({
							          map: map,
							          title: title,
							          address:results[0].formatted_address,
							          position: results[0].geometry.location
							      });
							      map.setCenter(marker.getPosition());
							      map.setZoom(10);
							      google.maps.event.addListener(marker, 'click', function() {
							      	
                          
			                          infowindow.setContent(this.address);
			                          infowindow.open(map, marker);
			                        
								    	
								  });
							  });
							  	
						}//end foreach	
				    }
			});
	}
	


</script>
<div class="innerContent" id="mainInnerContent">
	<div class="container">
		<!--<div class="row">-->
		<div class="col-md-12">
			<h1>Locations</h1>
			<a href="{{URL::route('New Location')}}"><svg class="icon icon-plus"><use xlink:href="#icon-plus"></use></svg><span class="mls"></span></a>
		</div>
		<div class="col-md-12" id="locationMapCanvasContainer">
			<div id="mapZone">
		    	<div id="map-canvas"></div>
		    </div>
		</div>
		<div class="col-md-12">
			<div class="campaignWrapper">
			<header class="panel-heading">All Locations</header>
		     <table id="campaignTable" class="table striped">
		      <thead>
		        <tr><th>Title</th><th>Address</th><th>Beacons</th><th>Focus</th><th>Edit</th><th>Delete</th></tr>
		      </thead>
		      <tbody>
		        <?php
		          foreach($locations as $location){
		            echo "<tr><td>".$location->name."</td><td>".$location->address."</td>";
		            echo "<td>";
		            foreach($location->beacons as $beacon){
		            //do loop for beacons here
		            	echo "<span class='label label-primary beacon-label'>".$beacon."</span>";
		       		}
		            echo "</td>";
		            echo "<td><svg address='".$location->address."' id='icon-target' class='icon icon-target see'><use xlink:href='#icon-search'></use></svg><span class='mls'></span></td>";
		            echo "<td><svg id='".$location->_id."' class='icon icon-editicon-01'><use xlink:href='#icon-editicon-01'></use></svg><span class='mls'></span></td><td><svg class='icon icon-bin' id='".$location->_id."'><use xlink:href='#icon-bin'></use></svg><span class='mls'></span></td></tr>";
		          }
		        ?>
		      </tbody>
		    </table>
		    </div>
		</div>
		
		<!--</div>-->
	</div>
</div>

