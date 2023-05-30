<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="Estilos.css"/>
		<title>Remove Score</title>
	</head>
	<body>
    	<h1>Remove Score</h1>
        <?php
			if(isset($_POST['Enviar'])){
				if($_POST['Confirmacion']=='Si'){
					require_once('DB.php');
					$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
					$query="DELETE FROM guitarwars WHERE Id=".$_POST['Id']." LIMIT 1";
					$result=mysqli_query($dbc, $query) or die ("Error en el Borrado");
					if($result){
						@unlink($_POST['Imagen']);
						echo '<p>El borrado ha sido completado con exito</p>';
						echo '<p><a href="javascript:window.history.back();">Volver a la Administracion</a></p>';
					}
				}else{
					echo '<p><a href="javascript:window.history.back();">Volver a la Administracion</a></p>';
				}
			}else{
				if(isset($_GET['Id'])&&isset($_GET['Nombre'])&&isset($_GET['Puntuacion'])
					&&isset($_GET['Fecha'])&&isset($_GET['Imagen'])){
		?>
        	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
            	<img src="<?php echo $_GET['Imagen']; ?>" />
                <br />
                <input type="hidden" name="Imagen" value="<?php echo $_GET['Imagen']; ?>" />
                <label>Nombre: <?php echo $_GET['Nombre']; ?></label> 
                <input type="hidden" name="Nombre" value="<?php echo $_GET['Nombre']; ?>" />
                <br /> 
                <label>Puntuacion: <?php echo $_GET['Puntuacion']; ?></label> 
                <input type="hidden" name="Puntuacion" value="<?php echo $_GET['Puntuacion']; ?>" />
                <br /> 
                <label>Fecha: <?php echo $_GET['Fecha']; ?></label> 
                <input type="hidden" name="Fecha" value="<?php echo $_GET['Fecha']; ?>" />
                <br />  
                <label>Confirma el Borrado: <?php echo $_GET['Fecha']; ?></label>
                <br/>  
                <input type="radio" name="Confirmacion" value="Si" checked="checked"/>Si
                <input type="radio" name="Confirmacion" value="No" />No
                <br />
                <input type="hidden" name="Nombre" value="<?php echo $_GET['Nombre']; ?>" />
                <input type="hidden" name="Puntuacion" value="<?php echo $_GET['Puntuacion']; ?>" />
                <input type="hidden" name="Fecha" value="<?php echo $_GET['Fecha']; ?>" />
                <input type="hidden" name="Imagen" value="<?php echo $_GET['Imagen']; ?>" />
                <input type="hidden" name="Id" value="<?php echo $_GET['Id']; ?>" />
                <br /> 
                <input type="submit" name="Enviar" value="Enviar" />
        	</form>
        <?php
				}else{
					echo 'Fallo en la Generacion de la URL';	
				}
			}
		?>
	</body>
</html>