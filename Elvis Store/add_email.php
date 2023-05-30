<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <title>Make Me Elvis</title>
	</head>
	<body>
	<?php
		if(empty($_POST['first_name'])&&empty($_POST['last_name'])&&empty($_POST['email'])){
			echo "<p>Hay campos en blanco</p>";
		}else{
			$nombre=$_POST['first_name'];
			$apellidos=$_POST['last_name'];
			$email=$_POST['email'];
			$dbc=mysqli_connect('localhost', 'root', 'pass', 'elvis_store') or die('Error en la conexion');
			$busqueda="SELECT email FROM email_list WHERE email='$email';";
			$busqueda2=mysqli_query($dbc, $busqueda) or die('Error en la  primera sentencia');
			if(empty(mysqli_fetch_array($busqueda2))){
				$query="INSERT INTO email_list (first_name, last_name, email) VALUES ('$nombre', '$apellidos', '$email');";
				$sentencia=mysqli_query($dbc, $query) or die ('Error en la segunda sentencia');
				mysqli_close($dbc);
				if ($sentencia) {
					echo "La consulta ha sido enviada correctamente";
				} else {
					echo "Se ha producido un error";
				}
			}else{
				echo "<p>El email ya existe</p>";
			}
		}
	?>
	</body>
</html>