<?php
	require_once('startsession.php');
	require_once('Cabeceras.php');
?>
<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<?php 
			$titulo='Mismatch - Login';
			require_once('header.php'); 
		?>
    <h1>Logueate con tu cuenta</h1>
		<?php
			require_once('navigation.php');
			require_once('Variables_DB.php');
			if (isset($_POST['Enviar'])) {
				$name=$_POST['Nombre'];
				$pass=$_POST['Contraseña'];
				$output_form = false;	 
				if (!empty($name) && !empty($pass)) {
					$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
					$query="SELECT * FROM mismatch_user WHERE user='$name' AND password=SHA('$pass')";
					$resultado=mysqli_query($dbc, $query);
					if(!empty($resultado)){
						$row=mysqli_fetch_array($result);
						$_SESSION['nombreUser']=$name;
						$_SESSION['nombreApellidos']=$row['first_name']." ".$row['last_name'];
						$_SESSION['IP']=$_SERVER['REMOTE_ADDR'];
						$_SESSION['Agent']=$_SERVER['HTTP_USER_AGENT'];
						setcookie('nombreUser', $name, time()+1296000);
						setcookie('nombreApellidos', $row['first_name']." ".$row['last_name'], time()+1296000);
						setcookie('IP', $_SERVER['REMOTE_ADDR'], time()+1296000);
						setcookie('Agent',$_SERVER['HTTP_USER_AGENT'], time()+1296000);
						header('Location: index.php');
					}else{
						echo 'El nombre de usuario o contraseña no son validos';
						$output_form=true;
					}
					mysqli_close($dbc);
				} 
			}else { 
				$output_form = true; 
			}
			if ($output_form) { 
		?> 
			<br />
            <div class="formLog">
			<form class="formulario_sign" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
				<label for="Nombre">Usuario:</label>
				<br /> 
				<input id="Nombre" name="Nombre" type="text" size="30" required />
				<br /> 
				<label for="Contraseña">Contraseña:</label>
				<br /> 
				<input id="Contraseña" name="Contraseña" type="password" size="30" required />
                <br />
				<input type="submit" name="Enviar" value="Enviar" /> 
			</form> 
            </div>
		<?php 
			}
			require_once('footer.php');
		?>
	</body>
</html>