<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Networking</title>
@include("header2")

<?php
	$user = Auth::user();
?>
	 @include("guestNav2")
<?php
	$crmUsers = CRMUsers::where(1)->get();
?>
<style>
  #crmTabContent{
    min-height: 300px;
  }
  #crmUsersTable_wrapper{
    margin-top:15px;
  }
  #crmTab {
    float:right;
    margin-top: -65px;
  }
  #crmTab .icon{
    fill:#1c8cb6;
  }
  #tabsarea{
  	background:#fbfbfb;
  	/*text-shadow: 0 1px 0 rgba(0, 0, 0, .5);*/
  	  margin-top: 30px;
  }
  #crmTab li a{
  	box-shadow: inset 1px 1px 1px rgba(255, 255, 255, .2), inset -1px -1px 1px rgba(0, 0, 0, 0);
  	-moz-box-shadow: inset 1px 1px 1px rgba(255, 255, 255, .2), inset -1px -1px 1px rgba(0, 0, 0, 0);
  	-webkit-box-shadow: inset 1px 1px 1px rgba(255, 255, 255, .2), inset -1px -1px 1px rgba(0, 0, 0, 0);
  	 border:none !important;
  }
  .tableArea{
    width: 100%;
    min-width:600px;
    margin-right: auto;
    margin-left: auto;
  }
  #crmUsersTable{
    margin: 15px 0;
  }
  #crmUsersTable_filter label input {
    float: right;
  }
  #addNewUser {
    clear:both;
    float:left;
    margin-top:10px;
  }
  #body{ 
  	width:550px;
  	height:250px; 
  }
  .innerForm input{
  	float:left;
  	width:50%;
  }
  .innerForm{
  	padding:15px;
  }
  .nav.nav-tabs a{
  	background:rgba(0,0,0,0) !important;
  }

  #crmUsersTable th, #crmUsersTable tbody td{
  border:1px solid #dddddd;
  border-left:none;
  
}
#crmUsersTable tbody td:last-child,#crmUsersTable tbody td:nth-last-child(2) {
	text-align: center;
}

#crmUsersTable{
  padding-top:15px;
  font-size:14px;
}
.dataTables_wrapper .dataTables_filter input{
  float:right;
}
#crmUsersTable th:first-child{
border-left:1px solid #dddddd;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
  color:#1188a3 !important;
  background:#fff;
  border: 1px solid #cacaca;
}
.bottomWrapper{
	background:#fbfbfb;
	  margin-top: 20px;
}
.dataTables_info{
	text-align:center;
	/*float:none !important;
	clear:none;*/
	width: 100%;
}
.dataTables_length,.dataTables_filter{
	margin:0 15px;
}
.dataTables_paginate{
	margin-top:-30px;
}
.panel-heading{
	background:#dedede !important;
	text-align:left;
}
.icon-adduser-02, .icon-upload, .icon-bin, .icon-editicon-01{
  width:22px;
  height:22px;
  margin:auto;
  display:block;
}
.icon-adduser-02,
.icon-upload{
width:32px;
height:32px;
}
.networkingAction{
	width: 50%;
	position: absolute;
	height: 50px;
	margin-top: -34px;
}
</style>
<div class="innerContent" id="mainInnerContent">
<div class="container">
  <div class="row">  
  	
  	<div class="col-md-12">
  		<h1>Networking</h1>
	<div class="tableArea">
		 <ul class="nav nav-tabs" id="crmTab">
	    <li><a href="#addUser" data-toggle="tab"><svg class="icon icon-adduser-02"><use xlink:href="#icon-adduser-02"></use></svg><span class="mls"></span></a></li>
	    <li><a href="#importUsers" data-toggle="tab"><svg class="icon icon-upload"><use xlink:href="#icon-upload"></use></svg><span class="mls"></span></a></li>
    </ul>
  	<div id="tabsarea">
   
    <div style="clear:both;"></div>
    <div class="tab-content" id="crmTabContent" align="center">
	    <div class="tab-pane fade in active" id="addUser">
	    	<header class="panel-heading">Add Account to Network </header>
		    <div class="innerForm">
			    {{Form::open(['route'=>'addCRMuser', 'action'=>'CRMController@add', 'autocomplete'=>'off', "class"=>"form-inline", 'id'=>'addUserForm', 'method'=>'post'])}}
    
				    {{ Form::label("first_name", "first name") }}
				    {{Form::text("first_name", Input::get("first_name"), ["class"=>"form-control", "id"=>"first_name", 'placeholder'=>'first name', 'required'=>true]) }}
    
				    {{ Form::label("last_name", "last name") }}
				    {{Form::text("last_name", Input::get("last_name"), ["class" => "form-control", "id" => "last_name", 'placeholder' => 'last name', 'required'=>true]) }}
    
				    {{ Form::label("email", "email") }}
				    {{Form::email("email", Input::get("email"), ["class" => "form-control", "id" => "email", 'placeholder' => 'email', 'required'=>true]) }}
    
				    {{Form::button('Add', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'addNewUser', 'style' => 'display:block;background-color:#107D9A !important;color:#fff;'))}}
			    {{Form::close()}}
		    </div>
	    </div>
	    <div class="tab-pane fade" id="importUsers">
	    	<header class="panel-heading">Upload CSV to Network </header>
			<div>
				<div class="innerForm">
				{{Form::open(['route'=>'uploadCRMCSV', 'action'=>'CRMController@uploadCsv', 'autocomplete'=>'off', "class"=>"form-inline", 'id'=>'uploadCSVForm', 
						'files'=>true, 'method'=>'post'])}}
<!--					<form id="loadCSVForm" action="crm/csvUpload" enctype="application/x-www-form-urlencoded" method="post"> -->
						<input type="file" id="selectedCSVFile" name="selectedCSVFile" style="display: none;" />
						<input type="button" value="Choose File" onclick="callSelectAndUploadCSV()" style="max-width:200px;display:block;background-color:#107D9A !important;color:#fff;"; class="btn btn-small" />
<!--					</form> -->
				{{Form::close()}}
				</div>
			</div>
			<div>
				<?php 
				if( isset($csvFileRows) ){ 
					
				}
				if( isset($csvFileRows) && is_array( $csvFileRows ) && count($csvFileRows)!=0 ){
					?>
					{{Form::open(['route'=>'loadCRMCSV', 'action'=>'CRMController@uploadCsv', 'autocomplete'=>'off', "class"=>"form-inline", 'id'=>'loadCSVForm', 
							'files'=>true, 'method'=>'post'])}}
						<table border="1">
						<?php
							$i=0;
							$isShow = false;
							if(is_array( $csvFileRows[0] ) && count( $csvFileRows[0] )>=3 ){
								foreach( $csvFileRows[0] as $firstRow ){
									?>
									<tr>
										<td><?php echo $firstRow; ?></td>
										<td>
											<select id="select_csv_<?=$i;?>" name="select_csv_<?=$i++;?>" onchange="changeCSVFields(this)" class="select_csv_field">
												<option value="">Select . . .</option>
												<option value="first_name">First name</option>
												<option value="last_name">Last name</option>
												<option value="email">Email</option>
											</select>
										</td>
									</tr>
									<?php
									$isShow = true;
								}
							}
						?>
						</table>
						<?php
						if( $isShow ){ ?>
							<br />
							{{Form::button('Import CSV', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'addCSVFile' ,'style' => 'display:block;background-color:#107D9A !important;color:#fff;'))}}
						<?php } ?>
					{{Form::close()}}
					<?php
				}
				?>
			</div>
		</div>
    </div>
  </div>
  <div>
  </div>
  
  	 <div class="bottomWrapper">
  	 <header class="panel-heading"> Network </header>
	  <table id="crmUsersTable" class="display" cellspacing="0">
		  <thead>
			  <th style="width:10px;">&nbsp;</th>
			  <th>first name</th>
			  <th>last name</th>
			  <th>email</th>
			  <th>edit</th>
			  <th>delete</th>
		  </thead>
		  <tbody>
			<?php
				foreach( $crmUsers as $itm){
					?>
					<tr>
						<td><input type="checkbox" onclick="clickOnchBox(this,'<?=$itm->id;?>','<?=$itm->email;?>')" /></td>
						<td><?=$itm->first_name;?></td>
						<td><?=$itm->last_name;?></td>
						<td><?=$itm->email;?></td>
						<td>
							<a href="javascript:void(0)" 
								onclick="editCRMUser('<?=$itm->id;?>','<?=$itm->first_name;?>','<?=$itm->last_name;?>','<?=$itm->email;?>')"><svg class="icon icon-editicon-01"><use xlink:href="#icon-editicon-01"></use></svg><span class="mls"></span></a>
						</td>
						<td>
							<a href="javascript:void(0)" 
								onclick="deleteCRMUser('<?=$itm->id;?>','<?=$itm->first_name;?>','<?=$itm->last_name;?>','<?=$itm->email;?>')"><svg class="icon icon-bin"><use xlink:href="#icon-bin"></use></svg><span class="mls"></span></a>
						</td> 
					</tr>
					<?php
				}
			?>
		  </tbody>
	  </table>
	    <div class="networkingAction">
	  	{{ Form::label("action", "action") }}
	  	{{Form::select("action", ['s' => 'send email'], 's') }}
	  <button class="btn btn-small" id="go" onclick="sendEmailDialog()" style="background-color:#107D9A !important;color:#fff;";>Go</button>
  </div>
  </div>
</div>



</div>
</div>
</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="crmUserSendModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><h2>Send email</h2><span id="sendEmail2MailList"></span></div>
			
		    {{Form::open(['route'=>'emailCRMuser','action'=>'CRMController@email','autocomplete'=>'off',"class"=>"form-inline",'id'=>'mailUserForm','method'=>'post'])}}
			<div class="modal-body" style="overflow:auto;max-width:600px;max-height:600px;">
				{{Form::hidden("ids", '', ["class"=>"form-control", "id"=>"ids", 'required'=>true]) }}
    
				{{Form::label("subject", "Subject") }}
				{{Form::text("subject", '', ["class"=>"form-control", "id"=>"subject", 'placeholder'=>'subject', 'required'=>true]) }}

				{{Form::label("body", "Body") }}
				{{Form::textarea("body", '', ["class" => "form-control", "id" => "body", 'placeholder' => 'body']) }}
			</div>
			<div class="modal-footer">
				<div>
				    <!--{{Form::button('Send', array('type' => 'submit', 'class' => 'btn btn-primary' ))}}-->
					<button type="button" class="btn btn-primary" onclick="callSendEmail()">Send</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		    {{Form::close()}}
		</div>
	</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="crmUserEditModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><h1>Edit</h1></div>
		    {{Form::open(['route'=>'editCRMuser','action'=>'CRMController@edit','autocomplete'=>'off',"class"=>"form-inline",'id'=>'editUserForm','method'=>'post'])}}
			<div class="modal-body" style="overflow:auto;max-width:600px;max-height:600px;">
				{{Form::hidden("eid", '', ["class"=>"form-control", "id"=>"eid", 'placeholder'=>'id', 'required'=>true]) }}
    
				{{Form::label("efirst_name", "first name") }}
				{{Form::text("efirst_name", '', ["class"=>"form-control", "id"=>"efirst_name", 'placeholder'=>'first name', 'required'=>true]) }}

				{{Form::label("elast_name", "last name") }}
				{{Form::text("elast_name", '', ["class" => "form-control", "id" => "elast_name", 'placeholder' => 'last name', 'required'=>true]) }}

				{{Form::label("eemail", "email") }}
				{{Form::email("eemail", '', ["class" => "form-control", "id" => "eemail", 'placeholder' => 'email', 'required'=>true]) }}
			</div>
			<div class="modal-footer">
				<div>
				    {{Form::button('Edit', array('type' => 'submit', 'class' => 'btn btn-primary' ))}}
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		    {{Form::close()}}
		</div>
	</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="crmUserDeleteModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"><h1>Delete</h1></div>
		    {{Form::open(['route'=>'deleteCRMuser','action'=>'CRMController@delete','autocomplete'=>'off',"class"=>"form-inline",'id'=>'editUserForm','method'=>'post'])}}
			<div class="modal-body" style="overflow:auto;max-width:600px;max-height:600px;">
				{{Form::hidden("did", '', ["class"=>"form-control", "id"=>"did", 'placeholder'=>'id', 'required'=>true]) }}
    
				{{Form::label("dfirst_name", "first name") }}
				{{Form::text("dfirst_name", '', ["class"=>"form-control", "id"=>"dfirst_name", 'disabled'=>true]) }}

				{{Form::label("dlast_name", "last name") }}
				{{Form::text("dlast_name", '', ["class"=>"form-control", "id"=>"dlast_name", 'disabled'=>true]) }}

				{{Form::label("demail", "email") }}
				{{Form::text("demail", '', ["class"=>"form-control", "id"=>"demail", 'disabled'=>true]) }}
			</div>
			<div class="modal-footer">
				<div>
					Are you sure?
				    {{Form::button('Yes', array('type' => 'submit', 'class' => 'btn btn-danger' ))}}
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
			</div>
		    {{Form::close()}}
		</div>
	</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript" src="/js/plugins/nicEdit.js"></script>
<script type="text/javascript">
	var my_nicEditor;
//------------------------------------
	bkLib.onDomLoaded(function(){ 
		my_nicEditor = new nicEditor().panelInstance('body');
	});
//------------------------------------
$(function(){
	//--------------------------------
	<?php if( isset($csvFileRows) && is_array( $csvFileRows ) && count($csvFileRows)!=0 ): ?>
	$('#crmTab a[href="#importUsers"]').tab('show');
//	document.getElementById('uploadCSVForm').reset();
	<?php else: ?>
	$('#crmTab a:first').tab('show');
	<?php endif; $in_csvFile=''; ?>
	//--------------------------------
	$('#crmUsersTable').dataTable({
		"columnDefs": [
			{ "orderable": false,  "searchable": false,  "targets": [ 0 ] },
			{ "orderable": false,  "searchable": false,  "targets": [ 4 ] },
			{ "orderable": false,  "searchable": false,  "targets": [ 5 ] }
		],
		"order": [[ 2, "asc" ]]
	});
	//--------------------------------
	document.getElementById('selectedCSVFile').addEventListener("change",function(e){
		var file = $("#selectedCSVFile").val();
		if( file!="" ){
			callProccessFileCSV(file);
		}
	});
	//--------------------------------
	$("#loadCSVForm").submit(function(){
		var cnt=0;
		$(".select_csv_field").each(function(){
			if( $(this).val()!='' ){ cnt++; }
		});
		if(cnt!=3){
			alert('Please assign all the values to continue...');
			return false;
		}
	});
	//--------------------------------
/*
	$("#mailUserForm").submit(function(){
		alert( my_nicEditor.getContent() );
		return false;
	});
*/
});
function callSendEmail(){
	var bodyVal = my_nicEditor.instanceById('body').getContent();
	if( bodyVal.trim()=="<br>" ){
		alert( "please fill body value" );
		return false;
	}else{
		$("#body").html(bodyVal);
		$("#mailUserForm").submit();
	}
}
//------------------------------------
function editCRMUser( id, fName, lName, eMail ){
	$("#editUserForm #eid"        ).val( id    );
	$("#editUserForm #efirst_name").val( fName );
	$("#editUserForm #elast_name" ).val( lName );
	$("#editUserForm #eemail"     ).val( eMail );
	$("#crmUserEditModal").modal({'show':true});
}
//------------------------------------
function deleteCRMUser( id, fName, lName, eMail ){
	$("#crmUserDeleteModal #did"        ).val( id    );
	$("#crmUserDeleteModal #dfirst_name").val( fName );
	$("#crmUserDeleteModal #dlast_name" ).val( lName );
	$("#crmUserDeleteModal #demail"     ).val( eMail );
	$("#crmUserDeleteModal").modal({'show':true});
}
//------------------------------------
var send2CRMusers = [];
var send2CRMemail = [];
function clickOnchBox(obj, id, mail){
	if( $(obj).is(':checked') ){
		send2CRMusers.push( id );
		send2CRMemail.push( mail );
	}else{
		var i = send2CRMusers.indexOf( id );
		if( i>-1 ){ send2CRMusers.splice(i, 1); }
		
		var j = send2CRMemail.indexOf( mail );
		if( j>-1 ){ send2CRMusers.splice(i, 1); }
	}
}
//------------------------------------
function sendEmailDialog(){
	if( send2CRMusers.length !=0 ){
		var ids="";
		for( var i=0 ; i<send2CRMusers.length ; i++ ){ ids+=( send2CRMusers[i]+";"); }

		$("#ids"    ).val(ids);
		$("#subject").val(   );
		$("#body"   ).val(   );
		var send2CRMusersStr="";
		for( var j=0 ; j<send2CRMemail.length ; j++ ){
			send2CRMusersStr += (send2CRMemail[j]+" ; ");
		}
		$("#crmUserSendModal").modal({'show':true});
		$("#sendEmail2MailList").html( send2CRMusersStr );
	}else{
		alert("Select user first.");
	}
}
//------------------------------------
function callSelectAndUploadCSV(){
	document.getElementById('selectedCSVFile').click();
}
//------------------------------------
function callProccessFileCSV(file){
	var ext = file.substr(-4).toUpperCase();
	if( ext!=".CSV" ){
		alert("Please Select CSV file");
	}else{
		document.getElementById('uploadCSVForm').submit();
	}
	
}
//------------------------------------
function changeCSVFields(obj){
//select_csv_
	if($(obj).val()!=''){
		$(".select_csv_field").each(function(){
			if( this!=obj && $(this).val()==$(obj).val() ){
				$(this).val('');
			}
		});
	}
}
//------------------------------------
</script>