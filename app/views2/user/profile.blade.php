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
$media = Media::where('status','=',1)->where('company','=',$user->companyID)->get();
?>
<style>
.desc{
	height:30%;
	min-height:100px;
	padding:10px !important;

}
</style>
<script>
$(document).ready(function(){
	$('#update').click(function(e){
		if($('#oldpassword').val() == ''){
			alert('please provide your old password');
			return false;
		}
		if($('#password').val() == ''){
			alert('please provide your new password');
			return false;
		}
		if($('#password2').val() == ''){
			alert('please provide your new confirmed password');
			return false;
		}
		if($('#password2').val().length <= 7){
			alert('please ensure your password is at least 8 characters long');
			return false;
		}
		if($('#password').val().length <= 7){
			alert('please ensure your password is at least 8 characters long');
			return false;
		}
		if($('#password').val() != $('#password2').val()){
			alert("Your new passwords don't match");
			return false;
		}
		var confirmed =  confirm('Are you Sure?');
	    if(confirmed == false){
	        return false;
	    }else{

	    }
	});

	$('#updateCompany').click(function(e){
		var path = $('.showSelectedLogo img').attr('src');
		$('#mediaImg').val(path);
		var confirmed =  confirm('Are you Sure?');
	    if(confirmed == false){
	        return false;
	    }else{

	    }
	});
});
</script>
<div class="innerContent">

	<?php if($user->user_access != "Admin"){ ?>
	<div class="row">
		<h1>Update Profile</h1>	
	<div class="col-md-12">	
	<h3>Company logo</h3>	
		{{Form::open(['route' => 'update company', 'action'=>  'UserController@updateCompany', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
		    	
			<div style="float:left;" class="showSelectedLogo"><?php if(isset($company->setImage)){ 
					echo "<img src='".$company->setImage."'>";
	    	 } ?></div>	   
	</div>
	</div> 
	<div class="row">
	<div class="col-md-12">		
		 <button class="btn-primary btn" style="clear: both;float: left;" id="logoBtn" onclick="callLoadLogo('<?php echo $company->_id;?>');return false;">Add Company Logo</button>
		{{ Form::text("image", Input::get("image"), ["class" =>"form-hidden", "id" => "mediaImg"]) }}
			{{Form::button('Update Company Logo', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'updateCompany'))}}
		{{Form::close()}}
	</div>
</div>
<?php } ?>
  <div class="row">
    <div class="col-md-6">
    	<h3>Account</h3>
    	{{Form::open(['route' => 'update profile', 'action'=>  'UserController@updateProfile', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
			    
			    {{Form::password('oldpassword', ["id"=>"oldpassword",'placeholder' => 'Old Password', 'class' => 'form-control'])}}
				
				{{Form::password('password', ["id"=>"password",'placeholder' => 'New Password', 'class' => 'form-control'])}}

				{{Form::password('password2', ["id"=>"password2",'placeholder' => 'Confirm New Password', 'class' => 'form-control'])}}

			    {{Form::button('update profile', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'update'))}}
		{{Form::close()}}
    </div>
   </div>   
<?php if($user->user_access != "Admin"){  ?>
<div class="row">
	<div class="col-md-12">
		<h3>Update Location</h3>
	</div>
	<div class="col-md-6">
		
		 {{Form::open(['route' => 'update location', 'action'=>  'UserController@updateLocation', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}
		 	{{ Form::label("beamtitle", "Phone Number") }}
	    	{{Form::text('phone',$location->phone , ['placeholder' => 'phone', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "Website (url)") }}
	    	{{Form::text('website',$location->website , ['placeholder' => 'website url', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "Tags") }}
	    	{{Form::text('tag',$location->name , ['placeholder' => 'tags', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "Image") }}
	    	{{Form::text('image',$location->img , ['placeholder' => 'img url', 'class' => 'form-control'])}}
	    	<?php $des = json_decode($location->description);?>
	    	{{ Form::label("beamtitle", "Description") }}
	    	{{Form::textarea('description',$des , ['placeholder' => 'descrption', 'class' => 'form-control desc'])}}
	    
	</div>
	<div class="col-md-6">
			{{ Form::label("beamtitle", "Hours") }}
			{{Form::text('hours',$location->hours , ['placeholder' => 'Hours', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "Province") }}
	    	{{Form::text('province',$location->address_province , ['placeholder' => 'province', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "Postal code") }}
	    	{{Form::text('postal',$location->address_postal , ['placeholder' => 'postal code', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "City") }}
	    	{{Form::text('city',$location->address_city , ['placeholder' => 'city', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "District") }}
	    	{{Form::text('district',$location->district , ['placeholder' => 'district', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "Country") }}
	    	{{Form::text('country',$location->address_country , ['placeholder' => 'country', 'class' => 'form-control'])}}

	    	{{ Form::label("beamtitle", "Address") }}
	    	{{Form::text('address',$location->address , ['placeholder' => 'Confirm New Password', 'class' => 'form-control'])}}

	<div>
		
</div>

<div class="row">
	<div class="col-md-12">
			{{Form::button('update location',array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'updateLocation'))}}
			{{Form::close()}}
		</div>
</div>

<?php } ?>
</div>
<!--------------------------------- addLogo Dialog ---------------------------------------->
<style>
	#addLogoModal .logoArea{ max-height:250px;overflow:auto; }
	#addLogoModal .logoArea .logo{ margin:10px;border-radius:8px; }
	#addLogoModal .logoArea .logo:hover{ cursor:pointer;box-shadow:0 0 10px #000; }
</style>
<div class="modal fade" id="addLogoModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add logo</h4>
				<h6>If you intend to use an image as logo, it must be a square, equal to or larger than 64x64 pixels.</h6>
			</div>
			<div class="modal-body">
				<div align="center" class="logoArea">
					<?php
						$columnCounter=1;
						foreach( $media as $key=>$row ){
							list($w , $h , $t , $a ) = getimagesize("userlogo/{$row->company}/{$row->filename}");
							?><img class="logo" src="/userlogo/<?php echo "{$row->company}/{$row->thumbnailfilename}"; ?>" 
									onclick="getLogoUrl(this,'/userlogo/<?php echo "{$row->company}/{$row->filename}"; ?>')" /><?php
							if( $columnCounter==5 ){
								$columnCounter=0;
								echo "<br/>";
							}
							$columnCounter++;
						}
					?>
				</div>
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


<script src="/js/logoUpload.js"></script>