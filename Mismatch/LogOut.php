<?php
	session_start();
	if(!empty($_COOKIE['nombreUser'])){
		setcookie('nombreUser', "", time()-3600);	
	}
	if(!empty($_COOKIE[session_name()])){
		setcookie(session_name(), "", time()-3600);
	}
	$_SESSION=array();
	session_destroy();
	header('Location: index.php');
?>