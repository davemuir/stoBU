<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ApEngage Platform</title>
@include("header2")
@include("guestNav")
</head>
<style>
.row-register{
	width:50%;
	margin:auto;

}
.row-register input{
	border-top-right-radius:5px;
	border-bottom-right-radius: 5px; 
	padding: 11px;
	height: 100%;
}
.row-register button{
	
	border-radius:5px;
	width:100%;
	background:#172436;
	color:#fff;
	padding:10px;
}
.input-group {
  position: relative;
  display: table;
  border-collapse: separate;
  	

}
.row-register .col-md-12{
	/*max-width:600px;*/
	margin:auto;
}
.input-group span{

	border-top-left-radius:5px !important; 
	border-bottom-left-radius:5px !important; 
}
.icon{
	 width: 14px;
  height: 14px;
  margin-top: 3px;
  fill:#1188a3;
}
#check-section{
	margin-top:10px;
}
#check-section a{
	  margin-top: -24px;
	  font-size: 13px;
	  color:#333 !important;
	  float:right;
}
a:hover,button:hover,button:visited{
	color:#dedede !important;
}
h4{
	margin-bottom:38px;
	color:#172436;
	font-size:28px;
}
label{
  margin-top: -16px;
  margin-left: 19px;
}
.navbar{
	max-height: 60px;
  height: 60px;
  min-height: 60px !important;
}


</style>
<body>
<?php if(isset($data)){
	print_r($data);
}
?>
<div class="row" id="loginHeader">
			
	<div class="col-md-12">
		<div class="row-register">
			<div class="col-md-12">	
				<h4 style="text-align:center;">Login to access your account</h4>
				<div class="input-group">
  					<span class="input-group-addon" id="basic-addon1"><svg class="icon icon-user-06"><use xlink:href="#icon-user-06"></use></svg><span class="mls"></span></span>    
						<!--Login Form-->{{Form::open(['route' => 'login form', 'action'=>  'UserController@loginForm', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'loginForm'])}}

					{{Form::text('email', '', ["id"=>"placeLogin",'placeholder' => 'E-mail','type'=> 'email','class' => 'form-control', 'required'=>true])}}
				</div>
			</div>
			<div class="col-md-12">  
				<div class="input-group">
  					<span class="input-group-addon" id="basic-addon1"><svg class="icon icon-key"><use xlink:href="#icon-key"></use></svg><span class="mls"></span></span>    
					{{Form::password('password', ["id"=>"placeLogin",'placeholder' => 'Password', 'class' => 'form-control', 'required' => true])}}
				</div>
			</div>                 
			<div class="col-md-12">
				{{Form::button('Sign In', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
				 {{Form::close()}}
			</div>
			<div class="col-md-12">
				<a id="registerBtn" href="{{URL::route('Register')}}"><button class="btn btn-small signupBtn">Sign Up</button></a>
			</div>
			<div class="col-md-12">  
				<div id="check-section">
					<!--<input type="checkbox" name="persistent" value="yes" id="check-section-checkbox" />
					<label for="check-section-checkbox">Remember Me</label>-->
					<a href="#" class="btn btn-small" data-toggle="modal" data-target="#basicModal">Forgot my Password</a>
				</div>
				
			</div>
			
				
			
		</div>
	</div>  
	<!--Register Form-->

	
</div>
<!--------------------------------- Modals start here ---------------------------------------->
<!--------------------------------- forgotPassword    ---------------------------------------->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Forgotten Password</h4>
			</div>
			<div class="modal-body">
				{{Form::open(['route' => 'Forgot Password', 'action'=>  'UserController@forgotPassword', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'forgotPassword'])}}
				<div class="col-md-4">	    
					{{Form::text('email', '', ["id"=>"placeLogin",'placeholder' => 'E-mail', 'class' => 'form-control', 'required'=>true ])}}
				</div>
				<div class="col-md-4">
					{{Form::button('Submit', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
				</div>
				{{Form::close()}}
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--------------------------------- loginMesage       ---------------------------------------->
<?php if(isset($ttl)): ?>
<div class="modal fade" id="loginMesageModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myMsgLabel"><?php echo $ttl; ?></h4>
			</div>
			<div class="modal-body">
			<?php if( isset($msg) ): ?>
				<h3>email address: <?php echo $mail; ?></h3>
				<br/>
				<?php echo $msg; ?>.
			<?php else: ?>
				<h3>Thank you <?php echo $user['fname']; ?></h3>
				<br/>
				An email was sent to <?php echo $user['email']; ?>, please check your inbox to reset your password.
			<?php endif; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#loginMesageModal").modal({show:true});//show();
	$("#forgotPassword")[0].reset();

	$("#registerBtn").click(function(event){
		//event.preventDefault();
		alert('er');
	});
});
</script>
<?php endif; ?>
</body>
</html>
