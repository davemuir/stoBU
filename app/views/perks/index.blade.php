<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Content</title>
@include("header2")
<?php
  $user = Auth::user();
  ?> 
   @include("guestNav2")
<?php 
if(isset($_GET['errors'])){
?>
<script>
$(document).ready(function(){
	var msg = <?php echo $_GET['errors'];?>;
	if( isNAN(msg) ){
		$('#modalContent').html("<p>"+msg+"</p>");
		$('#errorModal').modal('show');
	}
});
</script>
<?php
}
?>
<style>
.switch {
    width: 108px;
    height: 30px;
    position: relative;
    top:-8px;
}
.switch label {
    display: block;
    width: 100%;
    height: 100%;
    position: relative;
    background: #a5a39d;
    border-radius: 40px;
    box-shadow:
        inset 0 3px 8px 1px rgba(0,0,0,0.2),
        0 1px 0 rgba(255,255,255,0.5);
}
.switch label:after {
    content: "";
    position: absolute;
    z-index: -1;
    top: -2px; right: -2px; bottom: -2px; left: -2px;
    border-radius: inherit;
    background: #ccc; /* Fallback */
    background: linear-gradient(#f2f2f2, #ababab);
    box-shadow: 0 0 10px rgba(0,0,0,0.3),
        0 1px 1px rgba(0,0,0,0.25);
}
.switch label:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: -25px; right: -18px; bottom: -18px; left: -18px;
    border-radius: inherit;
    background: #eee; /* Fallback */
    background: linear-gradient(#e5e7e6, #eee);
    box-shadow: 0 1px 0 rgba(255,255,255,0.5);
    -webkit-filter: blur(1px); /* Smooth trick */
    filter: blur(1px); /* Future-proof */
}
.switch label i {
    display: block;
    height: 100%;
    width: 60%;
    position: absolute;
    left: 0;
    top: 0;
    z-index: 2;
    border-radius: inherit;
    background: #b2ac9e; /* Fallback */
    background: linear-gradient(#f7f2f6, #b2ac9e);
    box-shadow:
        inset 0 1px 0 white,
        0 0 8px rgba(0,0,0,0.3),
        0 5px 5px rgba(0,0,0,0.2);
}
.switch label i:after {
    content: "";
    position: absolute;
    left: 15%;
    top: 25%;
    width: 70%;
    height: 50%;
    background: #d2cbc3; /* Fallback */
    background: linear-gradient(#cbc7bc, #d2cbc3);
    border-radius: inherit;
}
.switch label i:before {
    content: "off";
    position: absolute;
    top: 50%;
    right: -50%;
    margin-top: -5px;
    color: #666; /* Fallback */
    color: rgba(0,0,0,0.4);
    font-style: normal;
    font-weight: bold;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 12px;
    text-transform: uppercase;
    text-shadow: 0 1px 0 #bcb8ae, 0 -1px 0 #97958e;
}
.switch input:checked ~ label { /* Background */
    background: #9abb82;
}

.switch input:checked ~ label i { /* Toggle */
    left: auto;
    right: -1%;
}

.switch input:checked ~ label i:before { /* On/off */
    content: "on";
    right: 115%;
    color: #82a06a;
    text-shadow: 0 1px 0 #afcb9b, 0 -1px 0 #6b8659;
}
.switch input {
top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  opacity: 0;
  z-index: 100;
  position: absolute;
  width: 100%;
  height: 100%;
  cursor: pointer;
 }
 .panel-heading{
  background:#dedede !important;
  text-align:left;
}
.campaignWrapper{
  background:#fbfbfb;
  margin-top:30px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
  color:#2780c7 !important;
  background:#fff;
  border: 1px solid #cacaca;
}
.dataTables_wrapper{
  margin-top:10px;
}
.dataTables_length, .dataTables_filter {
  margin: 0 15px;
}
#perkTable th, #perkTable tbody td{
  border:1px solid #dddddd;
  border-left:none;
}
#perkTable{
  padding-top:15px;
  font-size:14px;
}
.dataTables_wrapper .dataTables_filter input{
  float:right;
}
#perkTable th:first-child{
border-left:1px solid #dddddd;
}
.icon-camera, .icon-plus{
  fill:#1188a3;
}
.icon-plus{
    width: 23px;
  height: 23px;
  margin-top: 4px;
  margin-left: 15px;
}
.icon-editicon-01, .icon-bin{
  width:22px;
  height:22px;
  margin:auto;
  display:block;
}
h4{
  font-weight:300;
}
</style>
  
<script>
$(document).ready(function(){
	
	$('#perkTable').DataTable( {
    	paging: true,
    	"order": [[0, "asc" ]]
  	});
		$(".msgSwitch").click(function(){
			var perkID = $(this).attr("data_req");
			if($(this).prop('checked')){
				
				//$(this).removeAttr('checked');
				//$(this).removeAttr('checked');
				
				var xhr = new XMLHttpRequest();
	          	
	          	xhr.open('GET', 'http://sto.apengage.io/index.php/beacons/state/active/'+perkID, false);
	          	xhr.send(null);
	            if (xhr.status == 200) {
	              console.log(xhr.response);
	            }
	           	// $(this).removeAttr('checked');
			}else{
				
				
				var xhr = new XMLHttpRequest();
				xhr.open('GET', 'http://sto.apengage.io/index.php/beacons/state/inactive/'+perkID, false);
	          	
	          	xhr.send(null);
	            if (xhr.status == 200) {
	              console.log(xhr.response);
	            }
	           //$(this).prop('checked', true);
			}
		});
		
    	$('.orderSelect').focus(function(){
        var oldValue = $(this).children('option:selected').val();
        $(this).attr('oldOrder',oldValue);
	    console.log(oldValue);
    	}).blur(function(){
     	
    	});


  $('.remove').click(function(){
    var c = confirm("Are you Sure?");
    if (c == true) {
  
    } else {
    return false;
    }
  });
	$(".orderSelect").change(function(e,oldValue) {
			
			var par = $(this);
			var oldVal = $(this).attr("oldOrder");
			console.log(oldVal);
			var perk = e.target.id;
			var order = $(this).val();
			var check = false;
			$("option:selected").each(function(oldValue){	
				
				if($(this).val() == order && perk != $(this).attr("data_req")){
					if(order > 0){
						alert("the order is already taken"+oldVal);
						par.val(oldVal);
						check = true;
						return false;
					}
				}		
				
			});
			if(check == false){
				var xhr = new XMLHttpRequest();
		      	xhr.open("GET", "http://sto.apengage.io/index.php/beacons/order/"+perk+"/"+order, false);
		      	xhr.send(null);
		        if (xhr.status == 200) {
		          console.log(xhr.response);
		        }
		    }
	  	
	});

});
</script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
  <h1 style="float:left;">Content</h1><a style="float:left;margin-top:6px;" id="newPerk" href="{{URL::route('new perk')}}"><svg class="icon icon-plus"><use xlink:href="#icon-plus"></use></svg><span class="mls"></span></a>
  <a style="float:right;margin-top:6px;margin-left:10px;" href="{{URL::route('Media')}}"><svg class="icon icon-camera"><use xlink:href="#icon-camera"></use></svg><span class="mls"></span></a>
<h4 style="clear:both;" >Beam Manager</h4>




<div  class="campaignWrapper">
<header class="panel-heading">All Beams</header>
<table id="perkTable" class="table table-striped">
	<thead>
		<tr>
			<th>Date</th>
			<th>Title</th>
			<!--<th>State</th>
			<th>Order</th>-->
			<th>edit</th>
			<th>delete</th>
		</tr>
	</thead>
	<body>
		 <?php 
		 	$perkCount = count($perks);
			foreach($perks as $perk){
				if($perk->state == 1){$check = "checked";}else{$check = " ";}
				echo "<tr><td>".$perk->updated_at."</td><td>".$perk->title."</td>";
				echo "<td><a href='/index.php/beams/edit/".$perk->_id."'><svg class='icon icon-editicon-01'><use xlink:href='#icon-editicon-01'></use></svg><span class='mls'></span></a></td><td><a class='remove' href='/index.php/beams/remove/".$perk->_id."'><svg class='icon icon-bin'><use xlink:href='#icon-bin'></use></svg><span class='mls'></span></a></td></tr>";
				if($perk->order > 0){
				echo '<script>
					$("#'.$perk->_id.' option").each(function(){
						
						if($(this).val() == '.$perk->order.'){
							$(this).attr("selected","selected");
						}
					});
					
				</script>';
				}
			}
		?>
	</body>
</table>
</div>
</div>
</div>
</div>
<!--@include("footer")-->
<!--modal-->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="lite-modal-dialog">
      <div class="modal-content" id="modalContent">
        	
        	
      </div>
    <button type="button" class="btn btn-default closeModal regular" data-dismiss="modal">Close</button>
    </div>

  </div>

</body>
</html>