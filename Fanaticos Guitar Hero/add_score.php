<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" type="text/css" href="Estilos.css"/>
	  <title>Guitar Hero</title>
	</head>
	<body>
		<h1>Añadir tu Puntuación</h1>
		<?php
			require_once('Variables.php');
			if (isset($_POST['Enviar'])) {
				$name=$_POST['Nombre'];
				try{
					$score=(int)$_POST['Puntuacion'];
				}catch(Exception $e){
				}
				$destino=$_FILES["Screenshot"]["name"];
				$foto=RUTA.$_FILES["Screenshot"]["name"];
				$filename=$_FILES["Screenshot"]["tmp_name"];
				$output_form=false; 
				if (empty($name) && empty($score)) { 
					echo 'Has olvidado el Nombre y la Puntuacion<br />'; 
					$output_form = true;
				}		
				if (empty($name) && (!empty($score))) { 
					echo 'Has olvidado el Nombre.<br />'; 
					$output_form = true;
				}	 
				if ((!empty($name)) && empty($score)) { 
					echo 'Has olvidado la Puntuacion.<br />'; 
					$output_form = true; 
				}	 
				if ((!empty($name)) && (!empty($score))) {
					$tipo=$_FILES["Screenshot"]["type"];
					$tamaño=$_FILES["Screenshot"]["size"];
					if($tipo=="image/gif" || $tipo=="image/jpg" || $tipo=="image/png" || $tipo=="image/pjpeg" || $tipo=="image/x-png"){
						if($tamaño<=SIZE && $tamaño>0){
							$dbc=mysqli_connect('localhost', 'root', 'pass', 'guitarhero');
							$query="INSERT INTO guitarwars (Fecha, Nombre, Puntuacion, Screenshot, Approve) VALUES (NOW(), '$name', 		                            	'$score','$foto', 0)";
							$result=mysqli_query($dbc, $query) or die ("Error en la insercion");
							mysqli_close($dbc);
							move_uploaded_file($filename, RUTA.$destino);  
							echo 'Insercion Correcta. Pulse <a href="index.php">aqui</a> para volver';
						}else{
							echo 'Insercion Incorrecta. Ha ocurrido un error con el tamaño del archivo';
						}
					}else{
						echo 'Insercion Incorrecta. El Tipo de Archivo no es Valido';
					}
				} 
			}else { 
				$output_form = true; 
			}
			if ($output_form) { 
		?> 
			<br />
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
				<label for="Nombre">Nombre:</label>
				<br /> 
				<input id="Nombre" name="Nombre" type="text" size="30" />
				<br /> 
				<label for="Puntuacion">Puntuacion:</label>
				<br /> 
				<input id="Puntuacion" name="Puntuacion" type="text" size="30" />
				<br /> 
                <br />
                <input type="hidden" name="MAX_FILES_SIZE" value="32768" />
                <input type="file" name="Screenshot" id="Screenshot" />
                <br />
				<input type="submit" name="Enviar" value="Enviar" /> 
			</form> 
		<?php 
			} 
		?>
	</body>
</html>