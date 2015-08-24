<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reset Password</title>
@include("header")
</head>
<body>

<?php if( isset($msg) ): ?>
	<h2>{{$msg}}</h2>
	{{Form::open(['route' => 'login', 'action'=>  'UserController@view', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'backForm'])}}
		{{Form::button('Back', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
	{{Form::close()}}
<?php else: ?>
	{{Form::open(['route' => 'Reset Form', 'action'=>  'UserController@doResetPassword', 'autocomplete' => 'off', "class" => "form-inline", 'id' => 'RestForm'])}}
	{{Form::hidden('user_id',$_id);}}
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-2">
				<label>name : </label>
			</div>
			<div class="col-md-4">
				{{$fName}} {{$lName}}
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label>email : </label>
			</div>
			<div class="col-md-4">
				{{$eMail}}
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label>password : </label>
			</div>
			<div class="col-md-4">
				{{Form::password('password', ["id"=>"placeLogin",'placeholder' => 'Password', 'class' => 'form-control', 'required'=>true])}}
			</div>
			<div class="col-md-2">
				{{Form::button('reset', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'signInBtn'))}}
			</div>
		</div>
	</div>
	{{Form::close()}}
<?php endif; ?>
</body>
</html>
