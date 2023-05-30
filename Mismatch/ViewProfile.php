<?php
	require_once('startsession.php');
?>
<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<?php 
			$titulo='Mismatch - View Profile';
			require_once('header.php'); 
		?>
    	<h1>Visualice su Cuenta</h1>
    	<?php
			require_once('navigation.php');
			require_once('Variables_DB.php');
			$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
			if(empty($_GET['usuario'])){
				$query="SELECT * FROM mismatch_user WHERE user='".$_SESSION['nombreUser']."'";
			}else{
				$query="SELECT * FROM mismatch_user WHERE user='".$_GET['usuario']."'";
			}
			$result=mysqli_query($dbc, $query);
			$row=mysqli_fetch_array($result);
			echo '<div class="ViewProf" >';
			echo '<div class="ImgViewProf">';
				echo '<img class="Imagen" src="'.$row['picture'].'" />';
			echo '</div>';
				echo "<p>Nombre: ".$row['first_name']."</p>";
				echo "<p>Apellidos: ".$row['last_name']."</p>";
				echo "<p>F. Nacimiento: ".$row['birthday']."</p>";
				echo "<p>Estado: ".$row['state']."</p>";
			echo '</div>';
			require_once('footer.php');
			mysqli_close($dbc);
		?>
	</body>
</html>