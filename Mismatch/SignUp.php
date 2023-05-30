<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<?php
			$titulo='Mismatch - SignUp';
			require_once('header.php');
		?>
    <h1>Crear una Nueva Cuenta</h1>
		<?php
			require_once('navigation.php');
			require_once('Variables_DB.php');
			if (isset($_POST['Enviar'])) {
				$name=$_POST['Nombre'];
				$pass=$_POST['Contraseña'];
				$reppass=$_POST['RepContraseña'];
				$fechaUnion=time();
				$output_form = false;	 
				if (!empty($name) && !empty($pass) && !empty($reppass)) {
					$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
					$query="SELECT user FROM mismatch_user WHERE user='$name'";
					$result=mysqli_query($dbc, $query);
					if(empty($result)){
						if($pass==$reppass){
							$query="INSERT INTO mismatch_user (join_date, user, password) VALUES ($fechaUnion, $name, SHA('$pass'))";
							$result=mysqli_query($dbc, $query) or die ("Error en la insercion");
							$query="SELECT user_id FROM mismatch_user WHERE user='$name'";
							$result=mysqli_query($dbc, $query);
							$row=mysqli_fetch_array($result);
							$id=$row['user_id'];
							$query = "SELECT * FROM response WHERE user_id = '".$id."'";
  							$result=mysqli_query($dbc, $query);
  							if (mysqli_num_rows($result)==0) {
    							$query="SELECT topic_id FROM topic ORDER BY category_id, topic_id";
    							$result=mysqli_query($dbc, $query);
    							$topicIDs=array();
    							while ($row=mysqli_fetch_array($result)) {
      								array_push($topicIDs, $row['topic_id']);
    							}
    							foreach ($topicIDs as $topic_id) {
      								$query = "INSERT INTO response (user_id, topic_id) VALUES ('".$id."',		                                            	'$topic_id')";
      								mysqli_query($dbc, $query);
    							}
  							}
							/*$query="SELECT * FROM topics";
                			$result=mysqli_query($dbc, $query);
							while($row=mysqli_fetch_array($result)){
								$topic=$row['topics_id'];
								$query="INSERT INTO response (user_id, topics_id) VALUES ('$id', '$topic')";
                				$result=mysqli_query($dbc, $query);	
							}
							mysqli_close($dbc);*/
						}else{
							echo 'Las contraseñas no coinciden';
							$output_form=true;
						}
					}else{
						echo 'El nombre de usuario ya existe';
						$output_form=true;
					}
				} 
			}else { 
				$output_form = true; 
			}
			if ($output_form) { 
		?> 
			<br />
            <div class="formSign">
			<form class="formulario_sign" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
				<label for="Nombre">Nombre de Usuario:</label>
				<br /> 
				<input id="Nombre" name="Nombre" type="text" size="30" required />
				<br /> 
				<label for="Contraseña">Contraseña:</label>
				<br /> 
				<input id="Contraseña" name="Contraseña" type="password" size="30" required />
				<br /> 
                <label for="RepContraseña">Repetir Contraseña:</label>
				<br /> 
				<input id="RepContraseña" name="RepContraseña" type="password" size="30" required />
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