<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <!-- Crear primero un ID para la tabla email_list -->
	  <!-- ALTER TABLE email_list ADD Id INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (Id) -->
	  <title>Borrar Clientes</title>
	</head>
	<body>
		<h2>Selecciona los Email a borrar</h2>
		<br/>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<?php
				/* Conectamos con la base de datos */
				$dbc=mysqli_connect('localhost', 'root', 'pass', 'elvis_store');
				/* Comprobamos si se ha pulsado el boton submit*/
				if (isset($_POST['enviar'])) {
					/* Por cada checkbox marcado, habra un id en el array borrar[] */
					/* Con el foreach, obtengo el id de cada checkbox marcado y lo nombro como ID para tratarlo */
					foreach ($_POST['borrar'] as $Id){
						/* Se manda una consulta para borrar a la persona con ese id */
						$queryBorrar="DELETE FROM email_list WHERE id=".$Id;
						$resultBorrar=mysqli_query($dbc, $queryBorrar);
					}
					/* Aviso de que los campos han sido borrado. */
					echo 'Los campos seleccionados han sido borrados'.'<br/>';
				}
				/* Se halla pulsado o no el boton submit, creara un formulario con tantos checkbox como personas en la db */
				/* El formulario se crea siempre */
				$query="SELECT * FROM email_list;";
				$result=mysqli_query($dbc, $query);
				while ($row = mysqli_fetch_array($result)) { 
					/* En name se le pone el nombre del array que recoge los id */
					/* Lo id se los da el atributo value que extrae el id de la persona que se ha cogido con el fetch */
					/* Junto al check box sacamos el nombre y apellidos de cada persona */
					echo '<input type="checkbox" value="' . $row['Id'] . '" name="borrar[]"/>' . ' ' . $row['first_name'] 
						. ' ' . $row['last_name'].'<br/>';
				}
				/* Se cierra la conexion a la DB */
				mysqli_close($dbc);
			?>
			<br/>
			<!-- Se crea el boton submit -->
			<input type="submit" name="enviar" value="enviar"/>
		</form>
	</body>
</html>