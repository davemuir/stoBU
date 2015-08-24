<?php
	echo @unlink("../{$_REQUEST['file' ]}");
	echo @unlink("../{$_REQUEST['thumb']}");
?>
