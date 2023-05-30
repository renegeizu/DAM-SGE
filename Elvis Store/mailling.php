<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <title>Make Me Elvis</title>
	</head>
	<body>
		<h2>MakeMeElvis.com</h2>  
		<p><b>PRIVADO:</b> Solo para usuarios de Elmer</p>
		<p>Escribe y manda un email a la lista de contactos</p>
		<?php
			if (isset($_POST['enviar'])) {
				$de='elmer@makemeelvis.com';
				$asunto=$_POST['asunto'];
				$cuerpo=$_POST['cuerpo'];
				$output_form=false;
				if (empty($asunto) && empty($cuerpo)) { 
					echo 'Has olvidado el asunto y el cuerpo del mensaje.<br />'; 
					$output_form = true;
				}		
				if (empty($asunto) && (!empty($cuerpo))) { 
					echo 'Has olvidado el asunto.<br />'; 
					$output_form = true;
				}	 
				if ((!empty($asunto)) && empty($cuerpo)) { 
					echo 'Has olvidado el cuerpo.<br />'; 
					$output_form = true; 
				}	 
				if ((!empty($asunto)) && (!empty($cuerpo))) { 
					$query="SELECT * FROM email_list;";
					$dbc=mysqli_connect('localhost', 'root', 'pass', 'elvis_store');
					$result=mysqli_query($dbc, $query);
					while ($row = mysqli_fetch_array($result)) { 
						$to=$row['email'];
						$nombre=$row['first_name'];
						mail($to, 'Hola '.$nombre.','.$asunto, $cuerpo);
						echo 'Has enviado un email a '.$to.'&nbsp;';
					}
					mysqli_close($dbc);
				} 
			}else { 
				$output_form = true; 
			}
			if ($output_form) { 
		?> 
			<br />
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
				<label for="asunto">Asunto del Email:</label>
				<br /> 
				<input id="asunto" name="asunto" type="text" size="30" />
				<br /> 
				<label for="cuerpo">Cuerpo del Email:</label>
				<br /> 
				<textarea id="cuerpo" name="cuerpo" rows="8" cols="40"></textarea>
				<br /> 
				<input type="submit" name="enviar" value="enviar" /> 
			</form> 
		<?php 
			} 
		?>
	</body>
</html>