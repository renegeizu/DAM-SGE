<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <title>Make Me Elvis</title>
	</head>
	<body>
	<?php
		$email=$_POST['baja'];
		$dbc=mysqli_connect('localhost', 'root', 'pass', 'elvis_store') or die('Error en la conexion');
		$query="DELETE FROM email_list WHERE email='$email';";
		$sentencia=mysqli_query($dbc, $query) or die('Error en la sentencia');
		mysqli_close($dbc);
		if ($sentencia) {
			echo "La consulta ha sido enviada correctamente";
		} else {
			echo "Se ha producido un error";
		}
	?>
	</body>
</html>