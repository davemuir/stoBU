<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
@include("header2")
</head>
<body>
<?php
	$user = Auth::user();
?>
@include("guestNav2")
<style>
body{
	background:#edecf3 !important;
}
.trendGradient{
	height:30px;
	width:100%;
	position:absolute;
	bottom:0;
	background:url('/img/trendGradient.png');
}
.ulContainer .proximityItem{
	width:33.3%;
	float:left;
	padding:4px;
	text-overflow: ellipsis;
}
.proximityItem p{
  font-size: 11px;
  max-height: 13px;
  overflow: hidden;
  text-align:center;
}
.proximityItem img{
	  max-width: 100%;
	  padding-bottom:5px;
}
.item {
 margin-bottom:10px;
}

.masonImg{
	width:50px;
	margin-right:20px;
}

.itemContainer-2{
	padding:20px;
	min-height:350px;
	/*overflow-x:scroll;*/

}
.itemContainer ul{
	float:left;

}
.itemContainer ul li{
	list-style:none;
	color:#fff;
	font-size:13px;
}
.itemContainer a{
	color:#fff;
}
.itemContainer{
	padding:20px;
	height:60px;
	background:#fbfbfb;
}
.itemFooter{
	border-top:3px solid #dfdee5;
	background:#fbfbfb;
	padding:0px 20px;
		text-align:center;
	height:40%;
	min-height:30px;
}
.itemContainer2{
	padding:20px;
	/*min-height:125px;*/
	background:#fbfbfb;
}
.itemContainer3{
	padding:20px;
	min-height:179px;
	background:#fbfbfb;
}
.itemFooter2{
	border-top:3px solid #dfdee5;
	background:#fbfbfb;
	padding:0px 20px;
	text-align:center;
	height:40%;
	min-height:50px;
}
.itemHeader{
	border-bottom:3px solid #dfdee5;
	background:#fbfbfb;
	padding:0px 20px;
	min-height:30px;
}
.itemFooter a{
	float:right;
	padding:5px 0px;
}

.vizPre{
	min-width:300px;
}
.itemContainer .icon{
	fill:#1786a5;
}
.itemFooter .itemLabels{
	text-align:center;
	margin:auto;
}
.itemLabels{
	 font-family: "Open Sans";
  color: #1c2025;
  font-weight:500;
  font-size:15px;
}
#mainInnerContent{
width:100% !important;
}
#carousel-campaigns .carousel-indicators li{
	color:#d0e5ee;
	background-color:#d0e5ee;
	top:88px;
	position:relative;
}
#carousel-campaigns .icon{
	width:100px;
	height:100px;
	margin-top:5px;
}
.carousel{
	margin-bottom:0px;
}
#carousel-campaigns .item{
	text-align:center;
}
#carousel-main h2{
	text-align:right;
	font-weight:300;
}
#inCount,#visitorCount,#todayCount{
	font-weight:300;
	font-size: 26px;
  font-family: "Open Sans";
  margin: 0 0 5px;
  font-weight: 300;
  color: #4d4d4d;
  top: 0;
  font-style: normal;
}
#carousel-main #inCount{
	  font-size: 26px;
	  font-family: "Open Sans";
  		margin: 0 0 5px;
  		font-weight: 300;
  		color: #4d4d4d;
  		top:0;
  		font-style:normal;
}
#carousel-main .carousel-indicators li{
	color:#d0e5ee;
	background-color:#d0e5ee;
	top:46px;
	position:relative;
}
#carousel-main .icon{
	float:left;
	margin-top:-2px;
	width:36px;
	height:36px;
}
.carousel-indicators .active{
	color:#1c8cb6;
	background-color:#1c8cb6 !important;
}

#carousel-users .carousel-indicators li{
	color:#d0e5ee;
	background-color:#d0e5ee;
	top:88px;
	position:relative;
}
#carousel-users .icon{
	width:100px;
	height:100px;
	margin-top:5px;
}
#carousel-users .item{
	text-align:center;
}

#carousel-beacons .carousel-indicators li{
	color:#d0e5ee;
	background-color:#d0e5ee;
	top:88px;
	position:relative;
}
#carousel-beacons .icon{
	width:100px;
	height:100px;
	margin-top:5px;
}
#carousel-beacons .item{
	text-align:center;
}
.itemContainer4{
	min-height:300px;
	background:#fbfbfb;

}
.leftSide{
	width:75%;
	height:100%;
	min-height:300px;
	float:left;
}
.rightSide{
	width:25%;
	float:left;
}
.leftSide iframe{
	width:100%;
	height:100%;
	border:none;
	min-height: 316px;
  margin-left: -8px;
  margin-top: -8px;
}
#inOutProxContainer{
	overflow-y:scroll;
	max-height:180px;
}
.trendBox{
  border-bottom: 1px solid #dedede;
  height: auto;
  position: relative;
  width: auto;
  max-height: 100px;
  min-height: 100px;
  height: 100px;
  padding:4px;

}
#trendScroll{
	overflow-y:scroll;
	max-height:270px;
}
#locationScroll{
	overflow-y:scroll;
	height:100%;
	max-height:270px;
}
.locationIcon{
	float:left;
}
.locationTerm{
	float:left;
	padding-right:4px;
}
.locationBox{
	width:100%;
	min-height:70px;
	padding:10px 0px;
	font-size:12px;
}
#icon-location,.icon-location{
	fill:#FF6A81;
	width:25px;
	height:25px;
}
#map-canvas{
  	height:300px;
  	width:100%;
}
#mapZone{
	width:100%;
	float:left;
	border-right:3px solid #dfdee5;
}
</style>
<?php
function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        //'/blackberry/i' => 'BlackBerry', 
        //'/webos/i' => 'Mobile',
        //'/chrome/i'     =>  'Chrome'
    );

    //Return true if Mobile Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
           $web = 'device';
            //on a webbrowser.
            //return true;
        }else{
        	$web = 'screen';
        }
    }
    //Otherwise on a web browser 
   
    //echo 'false';
    //return false;
}
isMobileDevice();
?>
<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOyhAG7XU7oxlzvzduNJYjFdJxV6LkiY8"></script>
<script src="/js/keenClass.js"></script>
<script>

$(document).ready( function() {
	
	
	var mapZoom, web;
	function customizeForDevice(web){
	    var ua = navigator.userAgent;
	    var checker = {
	      iphone: ua.match(/(iPhone|iPod|iPad)/),
	      blackberry: ua.match(/BlackBerry/),
	      android: ua.match(/Android/)
	    };
	    if (checker.android){
	       console.log('android');
	       	mapZoom = 17;
	       	web = 'android';
	    }
	    else if (checker.iphone){
	        
	    }
	    else if (checker.blackberry){
	        
	    }
	    else {
	       console.log('website');
	       mapZoom = 10;
	       web = 'web';
	    }
	}
	customizeForDevice(web);
	
		
	
	
	
	//must test with multiple beacons
	var bID = "<?php if(isset($beacons[0]) ){echo $beacons[0]->_id;}else{ echo 0;} ?>";
	
	var companyID = "<?php echo $user->companyID;?>";
	var latlng = new google.maps.LatLng(43.7000, -79.4000);
	var rootLocation = location.hostname;

	var mapOptions = {
		    zoom: mapZoom,
		    center: latlng,
	}

	var addressString = "366 Adelaide street east, Canada";
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	codeAddress(addressString,latlng,map,companyID,mapZoom);

	setInterval(function(){ 
		doVisitors();
	}, 1000);

	
	
	
	function doVisitors(){
		//do visitor counts
		var keenQueryID = "<?php echo $company->_id;?>";
		var client = new Keen({
			projectId: "55ae574890e4bd376c52ba71",
			writeKey: "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8",
		    //, protocol: "https"
		    //host: 'http://sto.apengage.io',
		    readKey:"b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9", 
		    requestType: "jsonp"
		});
		//entrys
		var todayCount = new Keen.Query("count", {
		  eventCollection: "enterBeaconRegion",
		 // targetProperty: "newCampaign._id",
		  referrer: document.referrer,
		  timeframe: "this_day",
		  filters: [
    		{
		      "property_name": "companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		var globalCount = new Keen.Query("count", {
		  eventCollection: "enterBeaconRegion",
		 // targetProperty: "newCampaign._id",
		  referrer: document.referrer,
		  filters: [
    		{
		      "property_name": "companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		// Send query
		client.run([todayCount,globalCount], function(err, response){
		  // if (err) handle the error
		  var respData1 = response[0].result;
		  var respData2 = response[1].result;

	      	$('#todayCount').html(respData1);
	      	$('#visitorCount').html(respData2);
		});

	}


	function doLineGraphs(web){

		//old ajax call from filemaker
		/*
		$.ajax({
	    type: 'get',
		url: 'http://'+rootLocation+'/index.php/api/beacons/'+companyID,
		success:function(response){
			var respe = response;
			//console.log(respe);
			var bbcount = 1;	
			
			$('#trendScroll').empty();
		for(var beacon in respe){
			var beacon_id = respe[beacon]._id;
			
			
			$.ajax({
			    type: 'get',
				url: 'http://'+rootLocation+'/filemaker/analyticsBeacons.php?beaconID='+beacon_id,
				success: function(response){
					var resp = JSON.parse(response);
					console.log(resp);
					var beaconHits = [];
					var uniqueHits = [];
					//process hits to unique
					var count = 0;
					for(var entry in resp){
						var date = resp[entry].date.substr(0,10);
						beaconHits[count] = date;
						uniqueHits[count] = date;
						count++;
					}

					var alias = respe[(bbcount-1)].alias ;

					uniqueHits = $.unique(uniqueHits);
					var graphArr = [];
					
					//get a count for each unique date
					for(var un in uniqueHits){
						var unDate = uniqueHits[un];
						var count = 1;
						for(var en in beaconHits){
							//console.log(beaconHits[en]);

							if(moment(beaconHits[en]).unix() == moment(unDate).unix()){
								graphArr[unDate] = count;
								count++;
							}
						}
					}

					var plotArr = [];
					var count2 = 0;
					for(var item in graphArr){
						var split = item.split('/').join(' ');
						var msplit = split.substr(0,2);
						var dsplit = split.substr(3,2);
						var ysplit = split.substr(6,4);
						//console.log(msplit);
						var title = dsplit +' day of '+msplit+'/'+ysplit;
						plotArr[count2] = {a:graphArr[item],y:title};
						count2++;
					}
					var lineWidth, pointSize;	
					var ua = navigator.userAgent;
				    var checker = {
				      iphone: ua.match(/(iPhone|iPod|iPad)/),
				      blackberry: ua.match(/BlackBerry/),
				      android: ua.match(/Android/)
				    };
				    if (checker.android){
				       //lineWidth = '3px'; pointSize = '5px';
				    }
				    else if (checker.iphone){
				        
				    }
				    else if (checker.blackberry){
				        
				    }
				    else {
				       //lineWidth = '1px'; pointSize = '2px';
				    }
					
					
					$('#trendScroll').append('<div class="trendBox"><div class="term" style="width:100%;"><span>'+bbcount+'.) '+alias+'</span></div><div id="trend'+bbcount+'" class="trendChart" style="max-height:80px;width:100%;"></div></div>');
					Morris.Line({
					  element: 'trend'+bbcount,
					  data: plotArr,
					  lineColors:[
					  	"#E82C0C"
					  ],
					  xkey: 'y',
					  ykeys: 'a',
					  labels: ['User Reach'],
					  resize:true,
					  grid:false,
					  axes:false,
					  lineWidth:lineWidth,//if campaign length is certain amount of days
					  pointSize:pointSize,//if campaign length is certain amount of days
					  pointStrokeColors:'#000',
					  fillOpacity:0,
					  behaveLikeLine:true,
					  hideHover:true,
					  hoverCallback: function (index, options, content, row) {
				  			//return "sin(" + row.x + ") = " + row.y;
				  			//console.log(row.y);
				  			return content;
					  }
					});//end morris line
					
					bbcount++;
					
						
					
				}//end success
			});
				
			}//end for each
		}//end success of company beacons call
		});
		
		*/
		//end old filemaker code
		

		//keen call
			
		var lineVars = "KoolOnLoadCallFunction=lineGraphReadyHandler";
		KoolChart.create("line1","lineHolder", lineVars, "100%", "100%");
	
	}

	//getBeaconArray(companyID);
	doLineGraphs(web);
	doVisitors();
	
	$('.trendChart svg').each(function(){
		$(this).css('height','80px');
		
	});	
    $("#carousel-campaigns").carousel({
     	 interval : false,
         pause: "hover"
    });
    $("#carousel-main").carousel({
     	 interval : 5000,
         pause: "hover"
     });
    $("#carousel-users").carousel({ interval : false,
         pause: "hover"
     });
    $("#carousel-beacons").carousel({ interval : false,
         pause: "hover"
     });

	//handle in/out firebase
	var ref = new Firebase("https://salesdemo.firebaseio.com");
	console.log('<?php echo $beacons[0]->_id; ?>');
	var beaconID = "<?php if(isset($beacons[0])){echo $beacons[0]->_id;}else{echo '0';}?>";
	
	var bref = ref.child(beaconID);
		//alert(beaconID);
	var inCount = 0;
	ref.on("value", function(snapshot) {

		var newPost = snapshot.val();
		var object = newPost[beaconID];
		
	  	for(var rec in object){
	  		
	  		var fname = object[rec].fname;
	  		var lname = object[rec].lname;
	  		var img = object[rec].img;
	  		if(object[rec].status == "in"){
	  			inCount++;
	  			$('.proximityItem#'+rec).remove();
	  			$('#inDisplayContainer').append("<div class='proximityItem' id='"+rec+"'><img src='"+img+"'><p>"+fname+" "+lname+"</p></div>");
	  		}else{
	  			$('.proximityItem#'+rec).remove();
	  		}
	  	}
	  	$('#inCount').text(inCount);
	  	inCount = 0;
	 
	});
	
	
      

});//end document.ready

function codeAddress(addressString,latlng,map,companyID,mapZoom) {
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
								 
							  	geocoder.geocode({ 'address': address}, function(results, status) {
							     var p = results[0].geometry.location;
						
							      var marker = new google.maps.Marker({
							          map: map,
							          title: title,
							          address:results[0].formatted_address,
							          position: results[0].geometry.location
							      });
							      map.setCenter(marker.getPosition());
							      map.setZoom(mapZoom);
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

<!--Script for koolchart maker-->

<script>
	var companyID = "<?php echo $user->companyID;?>";
	var rootLocation = location.hostname;

	var activeCount = 0;
	var inactiveCount = 0;
	var keenQueryID = "<?php echo $company->_id;?>";
	//campaigns analytics via koolchart
	
	
	//campaign horizontal bar chart
	var respData;	
	var chartVars = "KoolOnLoadCallFunction=campaignChartReadyHandler";
	KoolChart.create("chart1","chartHolder", chartVars, "100%", "100%");
	function campaignChartReadyHandler(id) {
	    var keenQueryID = "<?php echo $company->_id;?>";
		var client = new Keen({
			projectId: "55ae574890e4bd376c52ba71",
			writeKey: "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8",
		    //, protocol: "https"
		    //host: 'http://sto.apengage.io',
		    readKey:"b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9", 
		    requestType: "jsonp"
		});
		//entrys
		var count_entry = new Keen.Query("count_unique", {
		  eventCollection: "newCampaign",
		  targetProperty: "newCampaign._id",
		  referrer: document.referrer,
		  timeframe: "this_7_days",
		  filters: [
    		{
		      "property_name": "newCampaign.companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		//exits
		var count_exit = new Keen.Query("count_unique", {
		  eventCollection: "newCampaign",
		  targetProperty: "newCampaign._id",
		  referrer: document.referrer,
		  timeframe: "this_30_days",
		  filters: [
    		{
		      "property_name": "newCampaign.companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		// Send query
		client.run([count_entry,count_exit], function(err, response){
		  // if (err) handle the error
		  var respData1 = response[0].result;
		  var respData2 = response[1].result;

		  var layoutStr = '<KoolChart styleName="chart1" >'
	      +'  <Options>'
	      +'     <Caption text="Campaigns Overview" />'
	      +'  	<SubCaption text="campaigns created over time" textAlign="center" />'
	      +'  </Options>'
	      +'   <Bar2DChart showDataTips="true">'
	      +'  <horizontalAxis>'
	      +'      <LinearAxis />'
	      +'  </horizontalAxis>'
	      +'  <verticalAxis>'
	       +'     <CategoryAxis categoryField="Date"/>'
	       +' </verticalAxis>'
	       +' <series>'
	       +'     <Bar2DSeries labelPosition="inside" fill="#1E75DE" xField="Amount" displayName="# of campaigns created" showValueLabels="[5,6,7]" itemRenderer="SemiCircleBarItemRenderer" >'
	       +'         <showDataEffect>'
	       +'             <SeriesInterpolate direction="right"/>'
	        +'        </showDataEffect>'
	       +'     </Bar2DSeries>'
	       +' </series>'
	    	+'</Bar2DChart>'
	      //+'<Style><Style>'
	      +'</KoolChart>';

	        var chartData = [{"Date":"past 7 days", "Amount":respData1},{"Date":"past 30 days", "Amount":respData2}];

			document.getElementById(id).setLayout(layoutStr);
	      	document.getElementById(id).setData(chartData);
	      	
		});
	
	}

	//user horizontal bar chart
	//shows a user login count from the backend system
	var chartVarsTwo = "KoolOnLoadCallFunction=userChartReadyHandler";
	KoolChart.create("userChart","userChartHolder", chartVarsTwo, "100%", "100%");
	function userChartReadyHandler(id) {
	    var keenQueryID = "<?php echo $company->_id;?>";
		var client = new Keen({
			projectId: "55ae574890e4bd376c52ba71",
			writeKey: "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8",
		    //, protocol: "https"
		    //host: 'http://sto.apengage.io',
		    readKey:"b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9", 
		    requestType: "jsonp"
		});
		//entrys
		var loginWeek = new Keen.Query("count", {
		  eventCollection: "login",
		 // targetProperty: "login._id",
		  referrer: document.referrer,
		  timeframe: "this_7_days",
		  filters: [
    		{
		      "property_name": "login.companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		//exits
		var loginMonth = new Keen.Query("count", {
		  eventCollection: "login",
		//  targetProperty: "login._id",
		  referrer: document.referrer,
		  timeframe: "this_30_days",
		  filters: [
    		{
		      "property_name": "login.companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		// Send query
		client.run([loginWeek,loginMonth], function(err, response){
		  // if (err) handle the error
		  var respData1 = response[0].result;
		  var respData2 = response[1].result;

		  var userlayoutStr = '<KoolChart styleName="userChart" >'
	      +'  <Options>'
	      +'     <Caption text="User Overview" />'
	      +'  	<SubCaption text="User Logins" textAlign="center" />'
	      +'  </Options>'
	      +'   <Bar2DChart showDataTips="true">'
	      +'  <horizontalAxis>'
	      +'      <LinearAxis />'
	      +'  </horizontalAxis>'
	      +'  <verticalAxis>'
	       +'     <CategoryAxis categoryField="Date"/>'
	       +' </verticalAxis>'
	       +' <series>'
	       +'     <Bar2DSeries labelPosition="inside" fill="#13ACDE" xField="Amount" displayName="# of campaigns created" showValueLabels="[5,6,7]" itemRenderer="SemiCircleBarItemRenderer" >'
	       +'         <showDataEffect>'
	       +'             <SeriesInterpolate direction="right"/>'
	        +'        </showDataEffect>'
	       +'     </Bar2DSeries>'
	       +' </series>'
	    	+'</Bar2DChart>'
	      //+'<Style><Style>'
	      +'</KoolChart>';

	        var chartData = [{"Date":"past 7 days", "Amount":respData1},{"Date":"past 30 days", "Amount":respData2}];

			document.getElementById(id).setLayout(userlayoutStr);
	      	document.getElementById(id).setData(chartData);
		});
	
		
	}

	//Beacon horizontal bar chart
	var beaconchartVars = "KoolOnLoadCallFunction=beaconChartReadyHandler";
	KoolChart.create("beaconChart","beaconChartHolder", beaconchartVars, "100%", "100%");
	function beaconChartReadyHandler(id) {
	    
		var client = new Keen({
			projectId: "55ae574890e4bd376c52ba71",
			writeKey: "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8",
		    readKey:"b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9", 
		    requestType: "jsonp"
		});
		//entrys
		var beaconWeek = new Keen.Query("count", {
		  eventCollection: "newBeacon",		
		  referrer: document.referrer,
		  timeframe: "this_7_days",
		  filters: [
    		{
		      "property_name": "newBeacon.companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		//exits
		var beaconMonth = new Keen.Query("count", {
		  eventCollection: "newBeacon",
		  referrer: document.referrer,
		  timeframe: "this_30_days",
		  filters: [
    		{
		      "property_name": "newBeacon.companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		// Send query
		client.run([beaconWeek,beaconMonth], function(err, response){
		
		  var resp1 = response[0].result;
		  var resp2 = response[1].result;

		  var beaconlayoutStr = '<KoolChart styleName="beaconChart" >'
	      +'<Options>'
	      +'     <Caption text="Beacons" />'
	      +'  	<SubCaption text="created over time" textAlign="center" />'
	      +'</Options>'
	      +'<Bar2DChart showDataTips="true">'
	      +'  <horizontalAxis>'
	      +'      <LinearAxis />'
	      +'  </horizontalAxis>'
	      +'  <verticalAxis>'
	      +'     <CategoryAxis categoryField="Date"/>'
	      +' </verticalAxis>'
	      +' <series>'
	      +'     <Bar2DSeries labelPosition="inside" fill="#13ACDE" xField="Amount" displayName="# of campaigns created" showValueLabels="[5,6,7]" itemRenderer="SemiCircleBarItemRenderer" >'
	      +'         <showDataEffect>'
	      +'             <SeriesInterpolate direction="right"/>'
	      +'        </showDataEffect>'
	      +'     </Bar2DSeries>'
	      +' </series>'
	      +'</Bar2DChart>'
	      //+'<Style><Style>'
	      +'</KoolChart>';

	        var beaconchartData = [{"Date":"past 7 days", "Amount":resp1},{"Date":"past 30 days", "Amount":resp2}];

			document.getElementById(id).setLayout(beaconlayoutStr);
	      	document.getElementById(id).setData(beaconchartData);
	      
	      	
		});
		
	}


	//user pie chart
	// will show the amount of gender spread between users using app
	var userPiechartVars = "KoolOnLoadCallFunction=userPieChartReadyHandler";
	KoolChart.create("chartThree","userPieChartHolder", userPiechartVars, "100%", "100%");
	function userPieChartReadyHandler(id) {
	    var keenQueryID = "<?php echo $company->_id;?>";
		var client = new Keen({
			projectId: "55ae574890e4bd376c52ba71",
			writeKey: "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8",
		    readKey:"b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9", 
		    requestType: "jsonp"
		});
		
		var Users = new Keen.Query("count", {
		  eventCollection: "enterBeaconRegion",	
		  group_by:"gender",	
		  referrer: document.referrer,
		  filters: [
    		{
		      "property_name": "companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});

		// Send query
		client.run(Users, function(err, response){
		  // if (err) handle the error
		  var genders = response['result'];
		  var female = genders[0].result;
		  var male = genders[1].result;
		 
		  var userpielayoutStr ='<KoolChart styleName="piechart1" >'
				    +'<Options>'
				        +'<Caption text="App Users"/>'
				        +'<SubCaption text="Gender split"/>'
				       //+' <Legend />'
				   +' </Options>'
				    +'<Pie2DChart innerRadius="0.4" explodable="true" showDataTips="true">'
				        +'<series>'
				            +'<Pie2DSeries nameField="Gender" field="Amount" labelPosition="inside" color="#ffffff" startAngle="90">'
				                +'<showDataEffect>'
				                    +'<SeriesInterpolate duration="1000"/>'
				                +'</showDataEffect>'
				                +'<fills>'
				                +'<SolidColor color="0x13CADE"/>'
								+'<SolidColor color="0x003661"/>'
				                +'</fills>'
				            +'</Pie2DSeries>'
				       +' </series>'
				    +'</Pie2DChart>'
				    +'<style>.KoolChart__RightTrialMark{opacity:0}</style>'
				+'</KoolChart>';

	        var chartData = [{"Gender":"Female", "Amount":female},{"Gender":"Male", "Amount":male}];

			document.getElementById(id).setLayout(userpielayoutStr);
	      	document.getElementById(id).setData(chartData);
	      	//$('.KoolChart__TrialMarkBox').each(function(){
			//	$(this).hide();
			//	$('.KoolChart__TrialMarkBox').remove();
			//});
	      	
		});
		
	}

	//campaigns pie graph
	getBeaconArray(companyID);
	function getBeaconArray(companyID){

		$.ajax({
	    	type: 'get',
			url: 'http://'+rootLocation+'/index.php/api/beacons/'+companyID,
			success: function(response) {
				var beaconArray = response;//JSON.parse(response);
				doPieGraphs(beaconArray);	
			}
		});
	}
	//sets up piegraphs and does asynchronus javascript calls first
	function doPieGraphs(beaconArray){
	
		$.ajax({
		    type: 'get',
			url: 'http://'+rootLocation+'/index.php/api/campaigns/all/'+companyID,
			success: function(response) {
				renderCampaignPieGraph(response);
				
			}
		});

	}
	//renders campaign pie graph
	function renderCampaignPieGraph(response){
		for(var hit in response){
			var date = moment(response[hit].endDate).unix();
			var Startdate = moment(response[hit].startDate).unix();
			var d = new Date();
			d = moment(d).unix();
			if(date >= d  && Startdate <= d){
				//if(Startdate < d){
					activeCount++;
				//}
				
			}else{
				inactiveCount++;
			}		
		}

		var campaignpiechartVars = "KoolOnLoadCallFunction=campaignPieChartReadyHandler";
		KoolChart.create("campaignpiechart","campaignPiechartHolder", campaignpiechartVars, "100%", "100%");
	}

	//line graph kool chart call
	function lineGraphReadyHandler(id) {
	    	var keenQueryID = "<?php echo $company->_id;?>";
			var client = new Keen({
			projectId: "55ae574890e4bd376c52ba71",
			writeKey: "d333f8496adf52dc1a4880352a5691c7aa123103416a348ff8eff0f3bbc6f7b724354c3e91f3fb6863b2cbfc08578cd7b412e10432296aafad0069d91b0ae048e4ccb1579bc3191ff707fa51daa327c5120731cce290b536f6ec8b2a93936bb8082c807114fcf808842abfc377b821a8",
		    readKey:"b10c212819208dcf47f7fa4e83718dbafa52dbd8612128a6d417aeef7faa902e33c975d1e687f0ffa19bc4f31ed2c27c9d5a6b33b9a18a382b61dffe7cd253836222a681fc94b8e2509b318fc8938efc0667b9f302e04b6a017c64e233ec3fdd260745f2f46f7de689a4055e693f0be9", 
		    requestType: "jsonp"
		});
		//entrys
		var line = new Keen.Query("count", {
		  eventCollection: "enterBeaconRegion",
		  group_by: "timestamp",
		  referrer: document.referrer,
		  //timeframe: "this_7_days",
		  filters: [
    		{
		      "property_name": "companyID",
		      "operator": "eq",
		      "property_value": keenQueryID
		    }
		  ]
		});
		
		client.run(line, function(err, response){
		  // if (err) handle the error
		  var lineData1 = response['result'];
		  console.log(lineData1);

		  var lineData = [];
		  for(var piece in lineData1){
		  		console.log(lineData1[piece].result);
		  		lineData.push({'date':lineData1[piece].timestamp,'sum':lineData1[piece].result});
		  }
		  console.log(lineData);
		  
			var layoutStr = '<KoolChart styleName="line1" cornerRadius="12" backgroundColor="0xffffff" borderStyle="none">'
    +'<Options>'
        +'<Caption text="Interaction Trend" />'
		+'<SubCaption text="interactions with beacons over time." />'
        +'<Legend defaultMouseOverAction="false" useVisibleCheck="true"/>'
    +'</Options>'
    //+'<NumberFormatter id="numFmt" precision="0"/>'
      +'<NumberFormatter id="dataTipFmt" precision="1"/>'
    +'<NumberFormatter id="numFmt" precision="0"/>'
    +'<Line2DChart showDataTips="true" dataTipDisplayMode="axis" paddingTop="0" dataTipBackgroundColorOnSeries="false">'
        +'<horizontalAxis>'
            +'<CategoryAxis categoryField="date"/>'
        +'</horizontalAxis>'
        +'<verticalAxis>'
            +'<LinearAxis interval="10" />'
        +'</verticalAxis>'
       +' <series>'
            +'<Line2DSeries labelPosition="up" yField="sum" fill="#1c8cb6" radius="5" displayName="# of beacon entrys" showValueLabels="[10,100]" itemRenderer="DiamondItemRenderer">'
                +'<lineStroke>'
					+'<Stroke color="#1c8cb6" weight="2"/>'
				+'</lineStroke>'
                +'<fills>'
					+'<SolidColor color="#1c8cb6"/>'
				+'</fills>'
                +'<stroke>'
                    +'<Stroke color="#1c8cb6" weight="2"/>'
                +'</stroke>'
                +'<showDataEffect>'
                    +'<SeriesInterpolate/>'
                +'</showDataEffect>'
            +'</Line2DSeries>'
        +'</series>'
        +'<annotationElements>'
            +'<CrossRangeZoomer zoomType="horizontal" fontSize="12" color="0xFFFFFF" horizontalLabelFormatter="{numFmt}" verticalLabelPlacement="bottom" horizontalLabelPlacement="left" enableZooming="false" enableCrossHair="true" backgroundColor="#1c8cb6" borderColor="#13CADE">'
               +' <verticalStroke>'
                +'<Stroke color="#13CADE" />'
           +' </verticalStroke>'
            +' <horizontalStroke>'
                +'<Stroke color="#13CADE" />'
           +' </horizontalStroke>'
            +'</CrossRangeZoomer>'
        +'</annotationElements>'
    +'</Line2DChart>'
     +'<Style>.KoolChart__DataTip, .KoolChart__CrossHair_Label {border:2px solid #000000 !important;} <Style>'
+'</KoolChart>';

	        
			//$('#lineHolder .KoolChart__DataTip').css({'border':'2px solid #000000'});
			document.getElementById(id).setLayout(layoutStr);
	      	document.getElementById(id).setData(lineData);
	      	
		});
	
	}
	//campaignPieChartReadyHandler
	function campaignPieChartReadyHandler(id) {
			  
			  var pielayoutStr ='<KoolChart styleName="campaignpiechart" >'
				    +'<Options>'
				        +'<Caption text="Campaigns Overview"/>'
				        //+'<SubCaption text="whats active?"/>'
				       //+' <Legend />'
				   +' </Options>'
				    +'<Pie2DChart innerRadius="0.4" explodable="true" showDataTips="true">'
				        +'<series>'
				            +'<Pie2DSeries nameField="Campaigns" field="Amount" labelPosition="inside" color="#ffffff" startAngle="90">'
				                +'<showDataEffect>'
				                    +'<SeriesInterpolate duration="1000"/>'
				                +'</showDataEffect>'
				                +'<fills>'
				                +'<SolidColor color="0x13CADE"/>'
								+'<SolidColor color="0x003661"/>'
				                +'</fills>'
				            +'</Pie2DSeries>'
				       +' </series>'
				    +'</Pie2DChart>'
				+'</KoolChart>';

		        var chartData = [{"Campaigns":"active", "Amount":activeCount},{"Campaigns":"inactive", "Amount":inactiveCount}];
				document.getElementById(id).setLayout(pielayoutStr);
		      	document.getElementById(id).setData(chartData);		
	}
</script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
<div class="row">
		<div class="col-md-3 item">
			<div class="col-md-12">
				<h1>Dashboard</h1>
			</div>
		</div>
		<div class="col-md-6 item">
			<div class="col-md-12">
				<div style="box-shadow: 1px 1px 1px 1px #dedede;">
						<div class="itemContainer">	
	      					<div id="carousel-main" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
							    <li data-target="#carousel-main" data-slide-to="0" class="active"></li>
							    <li data-target="#carousel-main" data-slide-to="1"></li>
							    <li data-target="#carousel-main" data-slide-to="2"></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
							   <div class="item active">
							   	<svg class="icon icon-arrows-01"><use xlink:href="#icon-arrows-01"></use></svg><span class="mls"></span>
							     <h2><span id="visitorCount"></span> Total Visitors</h2>
							   
						    	</div>
						    	<div class="item">
						    		<svg class="icon icon-user-06"><use xlink:href="#icon-user-06"></use></svg><span class="mls"></span>
						      		<h2><span id="todayCount"></span> Visitors Today</h2>
						 
						    	</div>
						    	<div class="item">
						    		<svg class="icon icon-location-07"><use xlink:href="#icon-location-07"></use></svg><span class="mls"></span>
						      		<h2>
	      						<span id="inCount"></span> Users are In Proximity	
	      							</h2>
						 
						    	</div>
						   	</div>
						 </div>
	      					
	      				</div>
	      				<div class="itemFooter">
	      					
	      			</div>
	      		</div>
	      	</div>
		</div>

		<div class="col-md-3 item">
			<div class="col-md-12">
				<div style="box-shadow: 1px 1px 1px 1px #dedede;">
					<div class="itemHeader">
	      					<span class="itemLabels">Activity Feed</span>
	      			</div>
					<div class="itemContainer">	
			
		      		</div>	
	      		</div>
	      	</div>
		</div>

		<div class='col-md-9 item'>
				
					<div class="col-md-4">
						<div style="box-shadow: 1px 1px 1px 1px #dedede;">
		      			<div class="itemContainer2">	
		      				<div id="carousel-campaigns" class="carousel slide" data-ride="carousel">
								  <!-- Indicators -->
								  <ol class="carousel-indicators">
								    <li data-target="#carousel-campaigns" id="campSlide0" data-slide-to="0" class="active"></li>
								    <li data-target="#carousel-campaigns" id="campSlide1" data-slide-to="1"></li>
								    <li data-target="#carousel-campaigns" id="campSlide2" data-slide-to="2"></li>
								  </ol>

								  <!-- Wrapper for slides -->
								  <div class="carousel-inner" role="listbox">
								   <div class="item active">
								      <svg class="icon icon-campaigns-05"><use xlink:href="#icon-campaigns-05"></use></svg><span class="mls"></span>
							    	</div>
							    	<div class="item">
							      		 <div id="campaignPiechartHolder" style="width:200px; height:160px;margin:auto;"></div>
							    	</div>
							    	<div class="item">
							      		<div id="chartHolder" style="width:200px; height:160px;margin:auto;"></div>
							    	</div>
							   	</div>
							 </div>
		      					
		      			</div>
		      			<div class="itemFooter2">
		      					<span class="itemLabels">Campaigns</span>

		      			</div>
		      		</div>
		      	</div>
	      		<div class="col-md-4">
	      			<div style="box-shadow: 1px 1px 1px 1px #dedede;">
	      				<div class="itemContainer2">	
	      					<div id="carousel-users" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
							    <li data-target="#carousel-users" data-slide-to="0" class="active"></li>
							    <li data-target="#carousel-users" data-slide-to="1"></li>
							    <li data-target="#carousel-users" data-slide-to="2"></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
							   <div class="item active">
							      <svg class="icon icon-users-02"><use xlink:href="#icon-users-02"></use></svg><span class="mls"></span>
							   
						    	</div>
						    	<div class="item">
						      		 <div id="userPieChartHolder" style="width: 200px; height: 160px; margin:auto;"></div>
						 
						    	</div>
						    	<div class="item">
						 			<div id="userChartHolder" style="width:200px; height:160px;margin:auto;"></div>
						    	</div>
						   	</div>
						 </div>
	      				</div>
	      				<div class="itemFooter2">
	      					<span class="itemLabels">Users</span>
	      				</div>
	      			</div>
	      		</div>

	      		<div class="col-md-4">
	      			<div style="box-shadow: 1px 1px 1px 1px #dedede;">
	      				<div class="itemContainer2">	
	      					<div id="carousel-beacons" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
							    <li data-target="#carousel-beacons" data-slide-to="0" class="active"></li>
							   <!-- <li data-target="#carousel-beacons" data-slide-to="1"></li>-->
							    <li data-target="#carousel-beacons" data-slide-to="1"></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
							   <div class="item active">
							      <svg class="icon icon-beacon-04"><use xlink:href="#icon-beacon-04"></use></svg><span class="mls"></span>
							   
						    	</div>
						    <!--	<div class="item">
						      		 <div id="beaconPiechart" style="width: 200px; height: 160px; margin:auto;"></div>
						 
						    	</div>-->
						    	<div class="item">
						      		 <div id="beaconChartHolder" style="width:200px; height:160px;margin:auto;"></div>
						 
						    	</div>
						   	</div>
						 </div>
	      					
	      				</div>
	      				<div class="itemFooter2">
	      					<span class="itemLabels">Beacons</span>
	      				</div>
	      			</div>
	      		</div>
		</div>
		<div class='col-md-3 item'>
			<div class="" id="in_outDashboard">

						<div class="col-md-12">
							<div style="box-shadow: 1px 1px 1px 1px #dedede;">
						<div class="itemHeader">
      						<span class="itemLabels">Customers In Proximity</span>
      					</div>
	      				<div id="inOutProxContainer" class="itemContainer3">	
	      					
	      					<div id="inDisplayContainer" class="ulContainer">
	      					
	      					</div>
	      				</div>
	      			</div>
	      		</div>
			</div>
		</div>

	<div class='col-md-9 item'>
		<div class="col-md-12">
			<div class="itemContainer4" style="box-shadow: 1px 1px 1px 1px #dedede;">	
				<div class="leftSide">
					<div id="mapZone">
						<div id="map-canvas"></div>
					</div>
				</div>	
				<div class="rightSide">
					<div class="itemHeader">
      					<span class="itemLabels">Locations</span>
      				</div>
					<div id="locationScroll">
						<?php
						//ECHO sizeOf($locations);
						 if(isset($locations)){?>
						<?php foreach($locations as $location){?>
			      			<div class="locationBox">
			      				<div class="locationIcon" style="width:20%;">
			      					<svg class="icon icon-location"><use xlink:href="#icon-location"></use></svg><span class="mls"></span>
			      				</div>
			      				<div class="locationTerm" style="width:80%;"><b><?php echo $location->name;?><br/></b><span><?php echo $location->address;?></span></div>
			      			</div>

			      		<?php }?>
			      	<?php }if(sizeOf($locations) <= 0 ){?>
			      	<!-- create a call to action for creating a new location-->
			      			<div class="locationBox">
			      				<div class="locationIcon" style="width:20%;">
			      					<svg class="icon icon-location"><use xlink:href="#icon-location"></use></svg><span class="mls"></span>
			      				</div>
			      				<div class="locationTerm" style="width:80%;"><span>You have not set up any Locations. <a href="{{URL::route('New Location')}}">click here</a> to create one.</span></div>
			      			</div>
			      	<?php } ?>
					</div>
				</div>		
	      	</div>
		</div>
	</div>

	<div class='col-md-3 item'>
		<div class="col-md-12">
			<div class="itemContainer4" style="box-shadow: 1px 1px 1px 1px #dedede;">	
				<div class="itemHeader">
      				<span class="itemLabels">Trends</span>
      			</div>
      			<div id="trendScroll">
      				<div id="lineHolder" style="width:100%; height:260px;"></div>
	      			<!--<p>...Loading</p>-->

				</div>
			</div>
		</div>
	</div>
 <!--start  analytics modal-->
  
</div>
</div>
</div>

</body>
</html>
