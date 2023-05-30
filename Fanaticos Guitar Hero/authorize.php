<?php
	$username='legolas';
	$password='frodo';
	if(!isset($_SERVER['PHP_AUTH_USER'])||!isset($_SERVER['PHP_AUTH_PW'])||($_SERVER['PHP_AUTH_USER']!=$username)
			||($_SERVER['PHP_AUTH_PW']!=$password)){
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="Guitar Wars"');
		exit ('<h1>Guitar Wars</h1> Ups! Debe introducir un usuario y contraseña validos');
	}
?>