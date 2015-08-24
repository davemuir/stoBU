@include("header2")
<?php
  $user = Auth::user();
  if($user->user_access == "Admin"){
  ?>  @include("nav")<?php
  }else{
  ?>  @include("guestNav2")<?php
  }
?>
<style>
.modal-content{
  background:#fff;
  height:40%;
  min-height:300px;
}
.modal-content input{
  padding:5px;
  clear:both;
  margin:auto;
  width:80%;
  float:none;
  margin:8px;
}
.inner-content{
  text-align:center;
  padding:20px;
}
.buttons{
  clear:both;
  padding:20px;
}
</style>
 <script type="text/javascript">



      $(document).ready(function(){
          $('#beaconsMonitor').DataTable( {
            paging: true,
            "order": [[0, "asc" ]]
          });

        $('#newBeacon').click(function(){
          $('#beaconModal').modal('show');
          $('#beaconModal #modalContent').html('<div class="inner-content"><h1>Add Beacon</h1><input id="alias" placeholder="Beacon Name" /> <input id="uuid" placeholder="UUID #" />   <input id="major" placeholder="major" />  <input id="minor" placeholder="minor" /></div><div class="buttons"><button class="btn-primary" id="addBeacon">Add Beacon</button></div>');
        
          $('#addBeacon').click(function(){
          
            var major = $('#major').val();
            var minor = $('#minor').val();
            var uuid = $('#uuid').val();
            var alias = $('#alias').val();
            if(uuid =='' || uuid == undefined){
                uuid = 'E2C56DB5DFFB48D2B060D0F5A71096E0';
            }
          
              var xhr = new XMLHttpRequest();
              xhr.open('GET', 'http://sto.apengage.io/index.php/beacons/create/'+uuid+'/'+major+'/'+minor+'/'+alias, false);
              xhr.send(null);
              if (xhr.status == 200) {
                console.log(xhr.response);
                 $('#beaconModal #modalContent').html('<div class="inner-content"><h1>Beacon Stored</h1></div>');
                  setTimeout(function(){  
                    location.reload();
                  }, 3000);
                }

            });
        });

      });
      </script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Beacons</h1>
      <?php if(sizeof($beacons) <= 0){?>
      <button class="btn-primary" id="newBeacon">New Beacon</button>
      <?php } ?>
      <!-- Form Wizard / Arrow navigation & Progress bar -->
      <table id="beaconMonitor" class="table table-striped">
      	<thead>
      		<tr>
      	
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
      				echo "<tr><td>".$beacon->alias."</td><td>".$beacon->uuid."</td><td>".$beacon->major."</td><td>".$beacon->minor."</td><td>null</td></tr>";
      			}
      		?>
      	</tbody>
      </table>
      <br/>
      <?php if($user->user_access == "Super"){  ?>
      <table id="beaconsMonitor" class="table table-striped">
        <thead>
          <tr>
        
          <th>Alias</th>
          <th>UUID</th>
          <th>Major</th>
          <th>Minor</th>
          <th>RSSi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
            $beaconsAll = Beacon::all();
            foreach($beaconsAll as $beacon){
              $branchName = Branch::find($beacon->branchID);
              echo "<tr><td>".$beacon->alias."</td><td>".$beacon->uuid."</td><td>".$beacon->major."</td><td>".$beacon->minor."</td><td>null</td></tr>";
            }
          
          ?>
        </tbody>
      </table>
    <?php  }
          ?>
  </div>
  <!-- // Form Wizard / Arrow navigation & Progress bar END -->
</div>
</div>
</div>

<!--modal-->
<div class="modal fade" id="beaconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="lite-modal-dialog">
      <div class="modal-content" id="modalContent">
        
      </div>
      <button type="button" class="btn btn-default closeModal regular" data-dismiss="modal">Close</button>
    </div>
</div>