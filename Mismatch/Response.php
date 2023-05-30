<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php
		require_once('startsession.php');
		require_once('Cabeceras.php');
		if (isset($_POST['Enviar'])) {
			require_once('Variables_DB.php');
			$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
			$usuario=$_SESSION['nombreUser'];
			$query="SELECT r.response_id, r.user_id, r.topics_id FROM response r 
					INNER JOIN mismatch_user m ON r.user_id=m.user_id WHERE m.user='$usuario'";
			$result=mysqli_query($dbc, $query);
			while($row=mysqli_fetch_array($result)){
				$repuesta=$_POST[$row['topics_id']];
				$id=$row['response_id'];
				$query="UPDATE response r SET r.response='$respuesta' WHERE r.response_id='$id'";
				$result=mysqli_query($dbc, $query);
			}
			header('Location: index.php');
		}else{
			$titulo='Mismatch - Formulario';
			require_once('header.php'); 
			echo '<h1>Rellene el Cuestionario</h1>';
			require_once('navigation.php');
			require_once('Variables_DB.php');
			$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
			$query='SELECT t.topics_id "id_topic", t.name "name_topic", c.name "name_category" FROM topics t 
					INNER JOIN category c ON t.category = c.category_id';
			$result=mysqli_query($dbc, $query);
			echo '<div class="formulario" >';
	?>
    	 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <?php
			while($row=mysqli_fetch_array($result)){
				echo '<div class="formulario_interno" ><p>'.$row['name_category'].': '.$row['name_topic'].'</p>';
				echo '<input type="radio" name="'.$row['id_topic'].'" value="1" />Me Gusta<br>
					  <input type="radio" name="'.$row['id_topic'].'" value="2" />No Me Gusta<br></div>';
			}
			echo '</div><br/><input class="boton_formulario" type="submit" name="Enviar" value="Enviar" />';
	?>
    	</form>
  	<?php
		}
	?>
	</body>
</html>