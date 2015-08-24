<html>
<head>
	<script src="//code.jquery.com/jquery-1.11.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="https://cdn.firebase.com/js/client/2.2.3/firebase.js"></script>
</head>
<script>
$(document).ready(function(){
	var email = "{{$email}}";
	var userID = "{{$userID}}";
	console.log(userID);
	var nameListRef = new Firebase('https://scorching-fire-9510.firebaseIO.com/users/');
	var usersRef = nameListRef.child(userID);
	usersRef.update({
 
    active: 1
    
  });
	setTimeout(function(){ window.location = "http://www.google.com"; }, 1000);
});
</script>

<body>
	<p>thanks for registering with us - {{$email}}</p>
</body>
</html>