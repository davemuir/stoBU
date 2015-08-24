@include("header")
<?php
  $user = Auth::user();
  if($user->user_access == "Admin"){
  ?>  @include("nav")<?php
  }else{
  ?>  @include("guestNav")<?php
  }
?>
<?php 
if(isset($_GET['errors'])){
?>
<script>
$(document).ready(function(){
	var msg = <?php echo $_GET['errors'];?>;
	$('#modalContent').html("<p>"+msg+"</p>");
	$('#errorModal').modal('show');
});
</script>
<?php
}
?>
<script>
$(document).ready(function(){
	
	$("[name='my-checkbox']").bootstrapSwitch();
	//handles siwtching active perks
	$(".bootstrap-switch").click(function(){
		var perkID = $(this).next().attr("data_req");
		
		if($(this).hasClass('bootstrap-switch-off')){
		
			var xhr = new XMLHttpRequest();
          	xhr.open('GET', 'http://sto.apengage.io/index.php/beacons/state/inactive/'+perkID, false);
          	xhr.send(null);
            if (xhr.status == 200) {
              console.log(xhr.response);
            }
		}else{
			
			var xhr = new XMLHttpRequest();
          	xhr.open('GET', 'http://sto.apengage.io/index.php/beacons/state/active/'+perkID, false);
          	xhr.send(null);
            if (xhr.status == 200) {
              console.log(xhr.response);
            }
		}
	});
	

    	$('.orderSelect').focus(function(){
        var oldValue = $(this).children('option:selected').val();
        $(this).attr('oldOrder',oldValue);
	    console.log(oldValue);
    	}).blur(function(){
     	
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
<div class="innerContent">
<div class="container">
<h1 style="float:left;" >Perks</h1>
<a style="float:right;margin-top:6px;" href="{{URL::route('new perk')}}"><button class="btn btn-primary">New Perk</button></a>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Date</th>
			<th>Title</th>
			<th>State</th>
			<th>Order</th>
			<th>edit</th>
			<th>delete</th>
		</tr>
	</thead>
	<body>
		 <?php 
			foreach($perks as $perk){
				if($perk->state == 1){$check = "checked";}else{$check = " ";}
				echo "<tr><td>".$perk->updated_at."</td><td>".$perk->title."</td>";
				echo '<td><input data_req="'.$perk->_id.'" type="checkbox" name="my-checkbox" '.$check.'><input type="hidden" class="nextPerk" data_req="'.$perk->_id.'"></input></td>';
				echo '<td><select id="'.$perk->_id.'" class="orderSelect"><option value="0" data_req="'.$perk->_id.'"> - </option><option data_req="'.$perk->_id.'">1</option><option data_req="'.$perk->_id.'">2</option><option data_req="'.$perk->_id.'">3</option><option data_req="'.$perk->_id.'">4</option></select></td>';
				echo "<td><a href='/index.php/perks/edit/".$perk->_id."'>Edit</a></td><td><a href='/index.php/perks/remove/".$perk->_id."'>delete</a></td></tr>";
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