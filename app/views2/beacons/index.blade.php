@include("header")
<?php
  $user = Auth::user();
  if($user->user_access == "Admin"){
  ?>  @include("nav")<?php
  }else{
  ?>  @include("guestNav")<?php
  }
?>
 <script type="text/javascript">
      $(document).ready(function(){
     
        $('#sendBeam').click(function(){

          if(!$('#beamTitle').val() ){
            alert('Please provide your beam with a title.');
            return false;
          }
          var confirmed =  confirm('Are you Sure?');
          if(confirmed == false){
              return false;
          }else{

          }
        });
      });
      </script>
<div class="innerContent">

  <div class="row">
    <div class="col-md-12">
      <h1>Beacons</h1>
      <!-- Form Wizard / Arrow navigation & Progress bar -->

      <table id="beaconMonitor" class="table table-striped">
      	<thead>
      		<tr>
      			<th>Owner</th>
  				<th>Alias</th>
  				<th>UUID</th>
  				<th>Major</th>
  				<th>Minor</th>
  				<th>RSSi</th>
      		</tr>
      	</thead>
      	<tbody>
      		<?php 
      			foreach($beacons as $beacon){
      				$branchName = Branch::find($beacon->branchID);
      				//$branchTitle = $branchName['title'];
      				echo "<tr><td>".$beacon->locationName." - ".$beacon->branchID."</td><td>".$beacon->alias."</td><td>".$beacon->proximity_uuid."</td><td>".$beacon->major."</td><td>".$beacon->minor."</td><td>null</td></tr>";
      			}
      		?>
      	</tbody>
      </table>
  </div>
  <!-- // Form Wizard / Arrow navigation & Progress bar END -->
</div>
</div>
@include('footer')