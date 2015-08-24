<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>

@include("header")
</head>
<body>

<?php
	$user = Auth::user();
	

	if($user->user_access == "Admin"){
	?>	@include("nav")<?php
	}else{
	?>	@include("guestNav")<?php
	}
?>
<style>
.item {
  width:20%;
  margin-top:4%;
  height: auto;
  float:left;
  border-radius:5px;
  border: 1px solid #dedede;
  background: #fff;
  min-width:300px;
}
.item-2 {
  width:28%;
  height: auto;
  float:left;
  border-radius:5px;
  border: 1px solid #dedede;
  background: #fff;
  margin-top:4%;
  min-width:390px;
}
.masonImg{
	width:50px;
	margin-right:20px;
}
.itemContainer{
	padding:20px;
	min-height:130px;
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
.itemFooter{
	background:#fff;
	padding:0px 20px;
	height:20px;
	border-radius:0px 0px 5px 5px;
}
.itemFooter a{
	float:right;
	padding:5px 0px;
}
.item:first-child .itemContainer{
background:#337ab7;
border-radius:5px 5px 0px 0px;
}
.item:nth-last-child(4) .itemContainer{
background:#5cb85c;
border-radius:5px 5px 0px 0px;
}
.item:nth-last-child(6) .itemContainer{
background:#f0ad4e;
border-radius:5px 5px 0px 0px;
}
.item:nth-last-child(5) .itemContainer{
background:#d9534f;
border-radius:5px 5px 0px 0px;
}
.vizPre{
	min-width:300px;
}
#masonryContainer{
	
}
</style>
<script src="https://cdn.firebase.com/js/client/2.2.4/firebase.js"></script>
<script>
$(document).ready( function() {
	var viz, workbook, activeSheet, sheetChoice, handleID;
  var company = $('#companyNameText').text();
  company = company.replace(/\s+/g, '');
  var container = document.querySelector('#masonryContainer');
  var msnry = new Masonry( container, {
    columnWidth: 100
  });
  	$('.analyticsButton').click(function(){
		$('#analyticsModal').modal('show');
	});
	
	  	function initializeViz() {

	  	for(var i = 1; i <= 3; i++){

		  var placeholderDiv = document.getElementById("tableauViz"+i);
		  var placeholder = document.getElementById("viz"+i);
		  var url = "https://public.tableausoftware.com/views/Ap1SalesDemo/ap1Demo"+i;
		  var options = {
		    width: 350,
		    height: 350,
		    hideTabs: true,
		    hideToolbar: true,
		    onFirstInteractive: function () {
		      workbook = viz.getWorkbook();
		      activeSheet = workbook.getActiveSheet();
		    }
		  };

		  viz = new tableauSoftware.Viz(placeholderDiv, url, options);
		
		} 
	}
	initializeViz();

	
	//handle in/out firebase
	var ref = new Firebase("https://salesdemo.firebaseio.com");
	var beaconID = "<?php if(isset($beacons[0])){echo $beacons[0]->_id;}else{echo '0';}?>";
	var bref = ref.child(beaconID);
		//alert(beaconID);
	var inCount = 0;
	ref.on("value", function(snapshot) {

		var newPost = snapshot.val();
		var object = newPost[beaconID];
		//var keys = Object.keys(snapshot.val());
		//var len = object.length;
		console.log(object);
	  	for(var rec in object){
	  		//console.log(rec);
	  		//console.log(object[rec]);
	  		if(object[rec] == "in"){
	  			inCount++;
	  		}
	  	}
	  	console.log(inCount);
	  	$('#inCount').text(inCount);
	  	inCount = 0;
	 
	});
	

});



</script>
<div class="innerContent">
<div class="container">
<div class="row">

		<div class='col-md-12'>
			
			<h1>Dashboard</h1>
			<div id="masonryContainer" class="beaconMasonry">
				<div class="item">
					<div class="itemContainer">
							<img class="masonImg"  src="/img/user.grey.png" style="float:left;">
	      					<ul>
	      						<li id="companyNameText"><b><?php if(isset($company)){echo $company->name;}?></b></li>
	      						<li>Hello {{$user->fname}}</li>
	      					</ul>
	      			</div>
	      			<div class="itemFooter">
	      				<a href="#">View</a>
	      			</div>
	      		</div>
				
				<div class="item">
	      			<div class="itemContainer">
	      				<img class="masonImg" src="/img/addbeams.grey.png" style="float:left;">
	      					<ul>
	      						<li><?php if(isset($company)){ echo count($beacons);}?> Beacons Configured</li>
	      						
	      					</ul>
	      			</div>
	      			<div class="itemFooter">
	      				<a href="#">View</a>
	      			</div>
	      		</div>

	      		<div class="item">
	      			<div class="itemContainer">	
	      				<img class="masonImg" src="/img/livebeams.grey.png" style="float:left;">
	      				<ul>
	      						<li><?php if(isset($company)){ echo count($perks);}?> Active Beams</li>		
	      				</ul>
	      			</div>	
	      			<div class="itemFooter">
	      				<a href="#">View</a>
	      			</div>
	      		</div>

	      		<div class="item">
	      				<div class="itemContainer">	
	      					<img class="masonImg" src="/img/data.grey.png" style="float:left;">
	      					<div class="ulContainer">
	      					<ul>
	      						<li><span id="inCount"></span> Users are In Proximity</li>		
	      					</ul>
	      					</div>
	      				</div>
	      				<div class="itemFooter">
	      					<a href="#">View</a>
	      				</div>
	      		</div>
			    
			     <div class="item-2">
	      						<div id="viz1" class="itemContainer-2">	
	      						<div class="vizPre" id="tableauViz1">
								</div>
	      				</div>
	      				<div class="itemFooter">
	      					<a href="#">View</a>
	      				</div>
	      		</div>
				 <div class="item-2">
	      						<div id="viz2" class="itemContainer-2">	
	      						<div class="vizPre" id="tableauViz2">
								</div>
	      				</div>
	      				<div class="itemFooter">
	      					<a href="#">View</a>
	      				</div>
	      		</div>
				<div class="item-2">
	      				<div id="viz3" class="itemContainer-2">	
	      						<div class="vizPre" id="tableauViz3">
								</div>
	      				</div>
	      				<div class="itemFooter">
	      					<a href="#">View</a>
	      				</div>
	      		</div>
			 </div>	
		</div>
		
 <!--start  analytics modal-->
  
<!--end Modals-->

</div>
</div>
</div>

<!--@include("footer")-->


<div class="modal fade" id="analyticsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="lite-modal-dialog">
      <div class="modal-content" id="modalContent">
        	<h1>analytics</h1>
        	<button type="button" class="btn btn-default closeModal regular" data-dismiss="modal">Close</button>
      </div>
    </div>
         
  </div>
</body>
</html>
