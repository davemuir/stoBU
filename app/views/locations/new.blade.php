<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Location</title>
@include("header2")
<?php
  $user = Auth::user();
?>  
@include("guestNav2")
 <style>
      #map-canvas {
        height: 50%;
        margin: 0px;
        padding: 0px
      }
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
      	width:60%;
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
  color:#19b79a !important;
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
    </style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
	$(document).ready(function(){


		//remove function
		$('.icon-bin').click(function(){
			var id = $(this).attr('id');
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
		});

		$('#campaignTable').DataTable( {
		    paging: true,
		    "order": [[0, "asc" ]]
		  });
		var rootLocation = location.hostname;
		var beaconArr = [];
		var addressString;
		var locationName;
		
		$('#my-select').multiSelect({
			selectableHeader: "<div class='custom-header'>Configured Beacons +</div>",
			selectionHeader: "<div class='custom-header'>Location Beacons - </div>",
		  afterSelect: function(values){
		    beaconArr.push(values);
		  },
		  afterDeselect: function(values){
		    beaconArr.pop(values);  
		  }
		});
		function submitLocation(beaconArr,locationName,address){
			
			$.ajax({
				    type: 'post',
					url: 'http://'+rootLocation+'/index.php/locations/store',
				    data: {beaconArr:beaconArr,locationName:locationName,address:address},
				    success: function(response) {	
				   		console.log(response);
				   		//$('#campaignRoot').html('<h1>Campaign Successfully Saved</h1>');
				   		setTimeout(function(){  
	                    	window.location.assign('http://'+rootLocation+'/index.php/locations');
	                  	}, 3000);
				    }
			});
			
			console.log(beaconArr);
			console.log(locationName);
		}
		$('#submitLocation').click(function(){

			var r = confirm('Are you sure you have reviewed everything?');
			if (r == true) {
				var locationName = $('#locationName').val();
				var address = $('#address').val();
				
			   	submitLocation(beaconArr,locationName,address);
			} else {
				console.log(beaconArr);
			    return false;
			}
		});
		
		$('#address').keyup(function(){
			addressString = $(this).val();
		});
		$('#locationName').keyup(function(){
			locationName = $(this).val();
		});
		$('#addGeocode').click(function(){
			codeAddress(addressString);
		});
		$('#rootwizard').bootstrapWizard({
			tabClass: 'nav nav-pills',
        	onTabShow: function(tab, navigation, index){
	        	//console.log(index);
	        	if(index == 0){
	        		$('#rootwizard').find('.bar').css({width:'33.3%'});
	        	}
	        	if(index == 1){
	        		$('#rootwizard').find('.bar').css({width:'66.6%'});
	        	}
	        	if(index == 2){
	        		$('#reviewName').html(locationName);
	        		
	        		$('#rootwizard').find('.bar').css({width:'100%'});
	        		
	        		//$('#mapZone').html('<div style="height:400px;width:650px;" id="map-canvas"></div>');
	        		addressString = $('#address').val();
	        		$('#reviewAddress').html(addressString);
	        		//console.log(beaconArr);
	        		codeAddress(addressString);
	        	}
        	},onNext: function(tab, navigation, index, currentIndex) {
        	var currentTab = $('#rootwizard').bootstrapWizard('currentIndex') ;
				switch(currentTab) {
			    	case 0:
			        	//var startDate = $('#startDate').val();
						//var endDate = $('#endDate').val();
						if( addressString == ''){
								alert("Location Address is not filled");
								return false;
						}
						if( $('#locationName').val() == ''){
								alert("Location Name is not filled");
								return false;
						}
			        break;
			    	case 1:
			        	if(beaconArr.length <= 0){
			 				alert('no beacons selected');
			 				return false;
			 			}
			 			
			        break;
			        case 2:
			        break;
		    	}
        	},onTabClick: function(tab, navigation, index, currentIndex) {
        	var currentTab = $('#rootwizard').bootstrapWizard('currentIndex') ;
				switch(currentTab) {
			    	case 0:
			        	if( addressString == ''){
								alert("Location Address is not filled");
								return false;
						}
						if( $('#locationName').val() == ''){
								alert("Location Name is not filled");
								return false;
						}
			        break;
			    	case 1:
			        	if(beaconArr.length <= 0){
			 				alert('no beacons selected');
			 				return false;
			 			}
			 			
			        break;
			        case 2:
			        break;
		    	}
        	}
		});
		
		
	});
	function codeAddress(addressString) {
		 var geocoder = new google.maps.Geocoder();
		  var address = addressString;//document.getElementById('address').value;
		  var latlng = new google.maps.LatLng(-34.397, 150.644);

		var mapOptions = {
		    zoom: 12,
		    center: latlng
		  }
		  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		  
		  geocoder.geocode( { 'address': address}, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
		      
		      
				var	co = results[0].geometry.location;
				console.log(co);
		      google.maps.event.trigger(map, 'resize');
		      var marker = new google.maps.Marker({
		          map: map,
		          position: results[0].geometry.location
		      });
		      map.setCenter(marker.getPosition());
		    } else {
		      alert('Geocode was not successful for the following reason: ' + status);
		    }
		  });

		}



</script>
<div class="innerContent" id="mainInnerContent">
	<div class="container">
		<!--<div class="row">-->
		<div class="col-md-12">
			<h1>Locations</h1>
		</div>
		
		<div class="col-md-12">	
			<div id="rootwizard" class="locationRootWizard">
				<div class="navbar">
					<div class="navbar-inner">
					    <div class="container">
							<ul>
						  		<li><a href="#tab1" id="tab1Pill" data-toggle="tab"><svg class="icon icon-setuptest1"><use xlink:href="#icon-setuptest1"></use></svg><span class="mls"></span></a><span class="labelIcons">Setup</span></li>
								<li><a href="#tab2" data-toggle="tab"><svg class="icon icon-beaconsicon-04"><use xlink:href="#icon-beaconsicon-04"></use></svg><span class="mls"></span></a><span class="labelIcons">Beacons</span></li>
								<li><a href="#tab3" data-toggle="tab"><svg class="icon icon-reviewtest-031"><use xlink:href="#icon-reviewtest-031"></use></svg><span class="mls"></span></a><span class="labelIcons">Review</span></li>
							</ul>
					 	</div>
					 </div>
				</div>
				<div id="bar" class="progress progress-striped active">
					<div class="bar"></div>
				</div>
				<div class="tab-content">
			    	<div class="tab-pane" id="tab1">
			    		<div class="container">
			    			<div class="row">
				    		  	<div class='col-sm-12'>
				    		  		<h2>1. New Location</h2>
				    		  		<p style="padding-bottom:20px;">Start with a full address of the location you would like to create.
				    		  		</p>
				    		 	</div>
				    		</div>
			    			<div class="row">
				    		  	<div class='col-sm-6' style="padding-top:30px;">
						    		<h6>Location Name</h6>
						    	</div>
						    </div>
			    			<div class="row">
					    		<div class="col-sm-6" >
							      <input id="locationName" class="form-control" type="textbox" placeholder="Ap1 Office">
							      <!--<input type="button" value="Geocode"  id="addGeocode"> -->
							    </div>
							</div>

							<div class="row">
				    		  	<div class='col-sm-6' style="padding-top:30px;">
						    		<h6>Location Address</h6>
						    	</div>
						    </div>
			    			<div class="row">
					    		<div class="col-sm-6">
							      <input id="address" class="form-control" style="width:100%" type="textbox" placeholder="366 Adelaide St. East, Toronto, Ontario">
							      <!--<input type="button" value="Geocode"  id="addGeocode"> -->
							    </div>
							</div>
					    </div>
					</div>
				    <div class="tab-pane" id="tab2">
				        <div class="container">
				        	<div class="row">
				    		  	<div class='col-sm-12'>
				    		  		<h2>2. Beacons</h2>
				    		  		<p style="padding-bottom:20px;">Add the beacons you have setup in the system to your new location.  Beacons which are physically present in your new location should be added here.
				    		  		</p>
				    		 	</div>
				    		</div>
				        	<div class="row">
				        		<div class='col-sm-12'>
					    			<select multiple="multiple" id="my-select" name="my-select[]">
					      			<!--<optgroup label='Beacon Name'>-->
							     	 	<?php 
							     	 		foreach($beacons as $beacon){ 
									      		echo "<option value='".$beacon->_id."'>".$beacon->alias."</option>";
											}
										?>
						    		</select>
						    	 </div>
						    </div>
					    </div>
				    </div>
					<div class="tab-pane" id="tab3">
						 <div class="container">
						 <div class="row">
				    		  	<div class='col-sm-12'>
				    		  		<h2>3. Review</h2>
				    		  		<p style="padding-bottom:20px;">Review your location, beacons in your location and your location name before submitting.
				    		  		</p>
				    		 	</div>
				    		</div>	
							<div class="row">
								<div id="mapZone">
							    	<div id="map-canvas"></div>
							    </div>
							    <div id="reviewZone">
							    	<h6>Is this where your location resides?</h6>
							    	<ul>
							    		<li>Name : <span id="reviewName"></span></li>
							    		<li>Address : <span id="reviewAddress"></span></li>
							    	</ul>

							    	<button class="btn btn-primary" id="submitLocation">Add Location</button>
							    </div>
							 </div>
							 
					    </div>
				    </div>
				</div>	
				<ul class="pager wizard">
					<li class="previous first" style="display:none;"><a href="#">First</a></li>
					<li class="previous"><a href="#">Previous</a></li>
					<li class="next last" style="display:none;"><a href="#">Last</a></li>
				  	<li class="next"><a href="#" id="next">Next</a></li>
				</ul>
			</div>
		</div>
		<!--</div>-->
	</div>
</div>

