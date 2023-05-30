<?php
	require_once('startsession.php');
?>
<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<?php 
			$titulo='Mismatch - Edit Profile';
			require_once('header.php'); 
		?>
    	<h1>Edite su Cuenta</h1>
			<?php
				require_once('navigation.php');
				require_once('Variables_DB.php');
				$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
				$query="SELECT * FROM mismatch_user WHERE user='".$_SESSION['nombreUser']."'";
				$result=mysqli_query($dbc, $query);
				$row=mysqli_fetch_array($result);
				echo '<div class="ImgEditProf">';
				if(!empty($row['picture'])){
					echo '<img class="Imagen" src="'.$row['picture'].'" />';
				}
				echo '</div>';
				if (isset($_POST['Confirmar'])) {
					$nombre=$_POST['Nombre'];
					$apellidos=$_POST['Apellidos'];
					$genero=$_POST['Genero'];
					$ciudad=$_POST['City'];
					$estado=$_POST['State'];
					$fnac=$_POST['FNac'];
					if(!empty($_FILES["Screenshot"]["type"])){
						$tipo=$_FILES["Screenshot"]["type"];
						$tamaño=$_FILES["Screenshot"]["size"];
						if($tipo=="image/gif" || $tipo=="image/jpg" || $tipo=="image/png" || $tipo=="image/pjpeg" || 
							$tipo=="image/x-png"){
							if($tamaño<=SIZE && $tamaño>0){
								$ruta='Profiles/'.$_FILES["Screenshot"]["name"];
								move_uploaded_file($_FILES["Screen"]["tmp_name"], $ruta);  
							}
						}
					}else{
						if(!empty($row['picture'])){
							$ruta=$row['picture'];	
						}
					}
					$query="UPDATE $mismatch_user SET first_name='$nombre', last_name='$apellidos', gender='$genero',
					 		birthday='$fnac', city='$ciudad', state='$estado', picture='$ruta' 
							WHERE user='".$_COOKIE['nombreUser']."'";
					$result=mysqli_query($dbc, $query);
					mysqli_close($dbc);
				}else{
            ?>
            <form class="formEdit" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
            	<label for="Nombre">Nombre:</label>
                <input id="Nombre" name="Nombre" value="<?php echo $row['first_name']; ?>" type="text" size="20" />
                <br /> <br /> 
                <label for="Apellidos">Apellidos:</label>
                <input id="Apellidos" name="Apellidos" value="<?php echo $row['last_name']; ?>" type="text" size="30" />
                <br /> <br /> 
                <label for="Genero">Genero:</label>
                <?php
					if($row['gender']=='F'){
						echo '<input id="Genero" name="Masculino" type="checkbox" />Masculino';
						echo '<input id="Genero" name="Femenino" type="checkbox" checked />Femenino';
					}else{
						if($row['gender']=='M'){
							echo '<input id="Genero" name="Masculino" type="checkbox" checked />Masculino';
							echo '<input id="Genero" name="Femenino" type="checkbox" />Femenino';
						}else{
							echo '<input id="Genero" name="Masculino" type="checkbox" />Masculino';
							echo '<input id="Genero" name="Femenino" type="checkbox" />Femenino';
						}
					}
				?>
                <br /> <br /> 
                <label for="FNac">Fecha de Nacimiento:</label>
                <input id="FNac" name="Fnac" value="<?php echo $row['birthday']; ?>" type="datetime" size="20" />
                <br /> <br /> 
                <label for="City">Ciudad:</label>
                <input id="City" name="City" value="<?php echo $row['city']; ?>" type="text" size="20" />
                <label for="State">Estado:</label>
                <input id="State" name="State" value="<?php echo $row['state']; ?>" type="text" size="10" />
                <br /> <br /> 
                <input type="hidden" name="MAX_FILES_SIZE" value="32768" />
                <input type="file" name="Screen" id="Screen" />
                <br /> <br /> 
                <input type="submit" name="Confirmar" value="Confirmar" /> 
          	</form>
		<?php
            }
			require_once('footer.php');
			mysqli_close($dbc);
        ?>
	</body>
</html>