<?php
defined('C5_EXECUTE') or die("Access Denied.");

$subject = t("Forgot Password");
$body = t("

Dear %s,

You have requested a password reset, please login with your new password,

Your username is: %s
Your new password has been reset  %s 

You may change your password back to something more desirable after you log back in.

Thank you!
-Streets TO
", $uName, $password, $uName);

?>