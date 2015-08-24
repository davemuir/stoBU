@include("header2")
<?php
  $user = Auth::user();
  if($user->user_access == "Admin"){
  ?>  @include("nav")<?php
  }else{
  ?>  @include("guestNav2")<?php
  }
$media      = Media::where('status','=',1)->where('company','=',$user->companyID)->get();
$recycleCnt = Media::where('status','=',2)->where('company','=',$user->companyID)->count();
?>
<!-- =========================================Media Section Begins Here============================================ -->
<style>
	.uploadBtn{ /*position:fixed;top:80px;left:20px;*/ margin:10px 0 30px 0;width:80%;min-width:600px;}
	.uploadBtn #recycleBtn{ float:right;<?php if( $recycleCnt==0 ){ echo 'display:none;'; } ?> }
	.logoArea{ margin-top:50px; }
	.logoArea .logo{ margin:20px;border-radius:8px; }
	.logoArea .logo:hover{ cursor:pointer;box-shadow:0 0 20px #f00; }
	
	
	.tableArea{ width:100%;min-width:600px; }
	#tableArea{ width:100%; }
	.tableArea .dataTables_wrapper{ width:80%;min-width:600px;text-align:center; }
	.tableArea .dataTables_filter>label>input{ float:none; }
	#recycleBinArea_filter>label>input{ float:none; }
/*	.tableArea #tableArea_filter>label>input{ float:none; } */
</style>
<script src="/js/logoUpload.js"></script>
<div class="innerContent" id="mainInnerContent">
<div class="container">
<div class="row">

<div align="center" class="tableArea">
	<div align="left" class="uploadBtn">
<!--		<button class="btn btn-primary" id="logoBtn"    onclick="callLoadLogo3();">add image</button> -->
		<button class="btn btn-primary" id="logoBtn"    onclick="callLoadLogo('<?php echo $user->companyID; ?>');">add image</button>
		<button class="btn btn-primary" style="display:block;"  id="recycleBtn" onclick="callRecycleLogo();">recycle bin</button>
	</div>
<?php
/*
if(extension_loaded('imagick')) {
    echo 'Imagick Loaded';
}else{
	echo 'none';
}
*/
?>
	<table id="tableArea" align="center" class="hover">
	<thead>
		<th>Logo</th>
		<th>View</th>
		<th>File name</th>
		<th>Date</th>
		<th>Delete</th>
		<th>Rename</th>
	</thead>
	<tbody>
	<?php
		foreach( $media as $key=>$row ){
			try{
				if( file_exists("userlogo/{$row->company}/{$row->filename}") ){
					list($w , $h , $t , $a ) = getimagesize("userlogo/{$row->company}/{$row->filename}");
					?>
					<tr>
						<td>
							<img src="/userlogo/<?php echo "{$row->company}/{$row->thumbnailfilename}"; ?>"/>
						</td>
						<td>
							<button class="btn btn-info"
								onclick="callShowLogo(<?php echo "'/userlogo/{$row->company}/{$row->filename}',$w,$h,'{$row->image_name}'"; ?>);">
								view
							</button>
						</td>
						<td><?php echo $row->image_name; ?></td>
						<td><?php echo $row->created_at;/*date ("Y/m/d H:i:s.", $row->date);*/ ?></td>
						<td>
							<button class="btn btn-danger"
								onclick="callDeleteLogo(<?php echo "'/userlogo/{$row->company}/{$row->thumbnailfilename}','{$row->image_name}','{$row->_id}'"; ?>);">
								delete
							</button>
						</td>
						<td>
							<button class="btn btn-primary"
								onclick="callRenameLogo(<?php echo "'/userlogo/{$row->company}/{$row->thumbnailfilename}','{$row->image_name}','{$row->_id}'"; ?>)">
								rename
							</button>
						</td>
					</tr>
					<?php
				}else{
					?>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><?php echo $row->image_name; ?></td>
						<td>File not found</td>
						<td>
							<button class="btn btn-danger"
								onclick="callDeleteLogo(<?php echo "'/userlogo/{$row->company}/{$row->thumbnailfilename}','{$row->image_name}','{$row->_id}'"; ?>);">
								delete
							</button>
						</td>
						<td>&nbsp;</td>
					</tr>
					<?php
				}
			}catch( Exception $e ){
				?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?php echo $row->image_name; ?></td>
					<td><?php echo $e->getMessage(); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<?php
			}
		}
	?>
	</tbody>
	</table>
</div>

</div>
</div>
</div>


<div class="modal fade" id="addLogoModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add image</h4>
			</div>
			<div class="modal-body">
				<div align="center" class="logoArea"></div>
				<div class="uploadLogoArea">
					<div class="innerLR">
						<!-- Widget -->
						<div class="widget widget-heading-simple widget-body-gray">
							<!--<div class="widget-body">-->
							<!-- Plupload -->
							<form id="pluploadForm">
								<input type="hidden" name="dir" id="dir" value="<?php echo $user->companyID; ?>"  />
							</form>
							<div id="pluploadUploader">
								<!-- // Plupload END -->
								<!--</div>-->
							</div>
							<!-- // Widget END -->
						</div><!--inner LR end-->
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="closeModalBtn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="deleteLogoModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"></div>
			<div class="modal-body" style="overflow:auto;max-width:600px;max-height:600px;">
				<img src="" id="deleteLogo"/>
				<input type="hidden" id="id" />
			</div>
			<div class="modal-footer">
				<div id="showHideDeleteDIV1">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				<div style="display:none"  id="showHideDeleteDIV2">
					Are you sure?
					<button type="button" class="btn btn-danger" onclick="doDeleteLogo()">Yes</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
				<div style="display:none"  id="showHideDeleteDIV3">
					<i style="float:left">rename to: <input type="text" style="float:right;margin-left:5px;padding:2px 5px;" maxlength="50" id="newLogoName" /></i>
					<button type="button" class="btn btn-danger" onclick="doRenameLogo()">Submit</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="recycleBinModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content" >
			<div class="modal-header">
				<button class="btn btn-danger" id="deleteAllBtn" style="float:right" onclick="callDeleteAllRLogo()">empty recycle bin</button>
				<h4 class="modal-title">Recycle bin</h4>
			</div>
			<div class="modal-body">
				<div class="innerLR">
					<div class="widget widget-heading-simple widget-body-gray">
						<?php $recycleBin = Media::where('status','=',2)->where('company','=',$user->companyID)->get(); ?>
						<table id="recycleBinArea" align="center" class="hover" width="100%">
						<thead>
							<th>Logo</th>
							<th>File name</th>
							<th>Create at</th>
							<th>Last modify</th>
							
							<th>Delete</th>
							<th>Restore</th>
						</thead>
						<tbody>
						<?php
							foreach( $recycleBin as $key=>$row ){
								$srcThumbnail="/userlogo/{$row->company}/{$row->thumbnailfilename}";
								try{
									if( file_exists("userlogo/{$row->company}/{$row->filename}")){
										list($w , $h , $t , $a ) = getimagesize("userlogo/{$row->company}/{$row->filename}");
										?>
										<tr>
											<td>
												<img src="/userlogo/<?php echo "{$row->company}/{$row->thumbnailfilename}"; ?>"/>
											</td>
											<td><?php echo $row->image_name; ?></td>
											<td><?php echo $row->created_at;/*date ("Y/m/d H:i:s.", $row->date);*/ ?></td>
											<td><?php echo $row->updated_at;/*date ("Y/m/d H:i:s.", $row->date);*/ ?></td>
											<td>
												<button class="btn btn-danger"
													onclick="callDeleteRLogo(<?php echo "'{$srcThumbnail}','{$row->image_name}','{$row->_id}'"; ?>);">delete</button>
											</td>
											<td>
												<button class="btn btn-primary"
													onclick="callRestoreLogo(<?php echo "'{$srcThumbnail}','{$row->image_name}','{$row->_id}'"; ?>)">restore</button>
											</td>
										</tr>
										<?php
									}else{
										?>
										<tr>
											<td>&nbsp;</td>
											<td><?php echo $row->image_name; ?></td>
											<td>File not found</td>
											<td>&nbsp;</td>
											<td>
												<button class="btn btn-danger"
													onclick="callDeleteRLogo(<?php echo "'{$srcThumbnail}','{$row->image_name}','{$row->_id}'"; ?>);">delete</button>
											</td>
											<td>&nbsp;</td>
										</tr>
										<?php
									}
								}catch(Exception $e) {
									?>
									<tr>
										<td>&nbsp;</td>
										<td><?php echo $row->image_name; ?></td>
										<td><?php echo $e->getMessage(); ?></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<?php
								}
							}
						?>
						</tbody>
						</table>



					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="recycleBinChildModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"></div>
			<div class="modal-body" style="overflow:auto;max-width:600px;max-height:600px;">
				<?php  // <img src="" id="recycleBinChildLogo"/>  ?>
				Warning
				<input type="hidden" id="id" />
			</div>
			<div class="modal-footer">
				<div id="showHideRecycleBinChildDIV1">
					Are you sure ( <i><b style="font-size:12px">Warning: files will be deleted permanently</b></i> ) ?&nbsp;
					<button type="button" class="btn btn-danger" onclick="doRecycleBinActionLogo('deleteARlogo')">Yes</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
				<div style="display:none"  id="showHideRecycleBinChildDIV2">
					Are you sure ( <i><b style="font-size:12px">Warning: files will be deleted permanently</b></i> ) ?&nbsp;
					<button type="button" class="btn btn-danger" onclick="doRecycleBinActionLogo('deleteRlogo')">Yes</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
				<div style="display:none"  id="showHideRecycleBinChildDIV3">
					Are you sure?
					<button type="button" class="btn btn-danger" onclick="doRecycleBinActionLogo('restoreLogo')">Yes</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){


	
	var $tableArea=$('#tableArea').DataTable({
		//"jQueryUI": true
		"order": [ 3, 'desc' ],
//		"order": [ 2, 'asc' ],
		"columnDefs": [
			{ "orderable": false, "searchable": false, "targets": 0 },
			{ "orderable": false, "searchable": false, "targets": 1 },
			{ "orderable": true , "searchable": true , "targets": 2 },
			{ "orderable": true , "searchable": true , "targets": 3 },
			{ "orderable": false, "searchable": false, "targets": 4 },
			{ "orderable": false, "searchable": false, "targets": 5 }
		]
	});

	var $recycleBinArea=$('#recycleBinArea').DataTable({
		//"jQueryUI": true
//		"scrollY": "400px",
//		"scrollX": "800px",
//        "scrollCollapse": true,
//        "paging": false,
		"order": [ 2, 'desc' ],
//		"order": [ 2, 'asc' ],
		"lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
		"columnDefs": [
			{ "orderable": false, "searchable": false, "targets": 0 },
			{ "orderable": true , "searchable": true , "targets": 1 },
			{ "orderable": true , "searchable": true , "targets": 2 },
			{ "orderable": true , "searchable": true , "targets": 3 },
			{ "orderable": false, "searchable": false, "targets": 4 },
			{ "orderable": false, "searchable": false, "targets": 5 }
		]
	});

	$('#newLogoName').keypress(function(e){
		var keynum;
		if(window.event){ // IE					
			keynum = e.keyCode;
		}else{
			if(e.which){ // Netscape/Firefox/Opera					
				keynum = e.which;
			}
		}
		var txt = String.fromCharCode(keynum);
		if(!txt.match(/[A-Za-z0-9_]/)){ return false; }
    });
});
function callBackUploadComplete(files,company){
	for(var i=0 ; i<files.length ; i++ ){
		if( files[i].status==5){
			var last=(i==(files.length-1))?1:0;
			var posting = $.post( "Uploader", { name: files[i].name, realName: files[i].target_name , last:last} );
			posting.done(function( data ){
				if(data.last==1) window.location.reload();
				//data = JSON.parse(data)
			});
		}
	}
}
</script>


