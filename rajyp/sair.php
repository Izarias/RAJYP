<?php
	session_start();
	$_SESSION["email"] = nil;
	session_destroy();
	header("Location: index.php");
?>