<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Error</title>
@include("header")
</head>
<body>
	<h1><?php echo $error; ?></h1>
	{{Form::open([ 
			'route'        => 'login', 
			'action'       => 'UserController@view', 
			'autocomplete' => 'off', 
			"class"        => "form-inline", 
			'id'           => 'back2login'])
	}}
<!--	<p><a href="{{URL::to('login')}}">Go to Login Page</a></p> -->
	<div class="col-md-4">
		{{Form::button('Go to Login Page', array('type' => 'submit', 'class' => 'btn btn-small', 'id' => 'backBtn'))}}
	</div>
	{{Form::close()}}
</body>
</html>
