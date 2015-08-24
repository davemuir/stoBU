<?php
$subject = t("User Registration");
$body = t("

Dear ".$uName.",

You are registered as a New User for the Streets T.O App %

Your Login is:".$uName." 
Your Password is :".$password." 

* If you registered with facebook, we have created your password as a temporary password which you can choose to reset once you have logged in.
You can always continue logging in with the facebook button on our app, or if you have registered with the same email as your facebook and did not initially create your account through the facebook button,
you may login with the facebook button to use your account.

Download the app and sign in here - http://playstorelink

",$uName,$password);

?>