<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Beacons</title>
@include("header2")
<?php
  $user = Auth::user();
 
  ?>
 
  @include("guestNav2") 

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
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
  color:#1188a3 !important;
  background:#fff;
  border: 1px solid #cacaca;
}
.dataTables_length, .dataTables_filter {
  margin: 0 15px;
}
#beaconMonitor th, #beaconMonitor tbody td{
  border:1px solid #dddddd;
  border-left:none;
}
#beaconMonitor{
  padding-top:15px;
  font-size:14px;
}
.dataTables_wrapper .dataTables_filter input{
  float:right;
}
.buttons{
  clear:both;
  padding:20px;
}
.panel-heading{
  background:#dedede !important;
  text-align:left;
}
.campaignWrapper{
  background:#fbfbfb;
  margin-top:30px;
}
.icon-editicon-01, .icon-bin{
  width:22px;
  height:22px;
  margin:auto;
  display:block;
}

</style>

 <script type="text/javascript">



      $(document).ready(function(){
          $('#beaconMonitor').DataTable( {
            paging: true,
            "order": [[0, "asc" ]]
          });
        var rootLocation = location.hostname;
        $('#newBeacon').click(function(){
          window.location.assign('http://'+rootLocation+'/beacons/setup');
          /*$('#beaconModal').modal('show');
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
              xhr.open('GET', 'http://sto.apengage.io/index.php/beacons/create/'+uuid+'/'+major+'/'+minor+'/'+alias+'/'+locationID, false);
              xhr.send(null);
              if (xhr.status == 200) {
                console.log(xhr.response);
                 $('#beaconModal #modalContent').html('<div class="inner-content"><h1>Beacon Stored</h1></div>');
                  setTimeout(function(){  
                    location.reload();
                  }, 3000);
                }

            });*/
        });

      });
      </script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Beacons</h1>
      <!--<?php if(sizeof($beacons) <= 0){?>-->
     
      <!--<?php } ?>-->
       <button class="btn-primary" id="newBeacon">New Beacon</button>
      <!-- Form Wizard / Arrow navigation & Progress bar -->
      <div class="campaignWrapper">
      <header class="panel-heading">All Registered Beacons</header>
      <table id="beaconMonitor" class="table table-striped">
      	<thead>
      		<tr>
      	
  				<th>Alias</th>
  				<th>UUID</th>
  				<th>Major</th>
  				<th>Minor</th>
  				<th>Edit</th>
          <th>Delete</th>
      		</tr>
      	</thead>
      	<tbody>
      		<?php 
      			foreach($beacons as $beacon){
      				$branchName = Branch::find($beacon->branchID);
      				echo "<tr><td>".$beacon->alias."</td><td>".$beacon->uuid."</td><td>".$beacon->major."</td><td>".$beacon->minor."</td><td><a href='/beacons/edit/".$beacon->_id."'><svg class='icon icon-editicon-01'><use xlink:href='#icon-editicon-01'></use></svg><span class='mls'></span></a></td><td><a href='/beacons/destroy/".$beacon->_id."'><svg class='icon icon-bin'><use xlink:href='#icon-bin'></use></svg><span class='mls'></span></a></td></tr>";
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