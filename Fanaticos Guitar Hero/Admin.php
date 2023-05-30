<?php
	require_once('authorize.php');
?>
<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <link rel="stylesheet" type="text/css" href="Admin.css"/>
		<title>GuitarWars</title>
	</head>
	<body>
    	<?php
			require_once('DB.php');
            $dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
            $query='SELECT * FROM guitarwars ORDER BY Puntuacion DESC';
            $result=mysqli_query($dbc, $query);
			echo '<h1>Panel de Administración</h1>';
			echo '<div>';
				echo '<table border="5">';
					echo '<tr class="Titulos">';
						echo '<td>Puntuación</td>';
						echo '<td>Nombre</td>';
						echo '<td>Fecha</td>';
						echo '<td>Foto</td>';
						echo '<td>¿Borrar?</td>';
						echo '<td>Aprobar</td>';
					echo '</tr>';
					while($row=mysqli_fetch_array($result)){
						echo '<tr>';
							echo '<td>'.$row['Puntuacion'].'</td>';
							echo '<td>'.$row['Nombre'].'</td>';
							echo '<td>'.$row['Fecha'].'</td>';
							echo '<td><img src="'.$row['Screenshot'].'" /></td>';
							echo '<td><a href="removeScore.php?Id='.$row['Id'].'&Nombre='.$row['Nombre'].
								'&Fecha='.$row['Fecha'].'&Puntuacion='.$row['Puntuacion'].
								'&Imagen='.$row['Screenshot'].'">Borrar</a></td>';
							echo '<td>';
							if($row['Approve']==0){
								echo '<a href="approveScore.php?Id='.$row['Id'].'&Nombre='.$row['Nombre'].
								'&Fecha='.$row['Fecha'].'&Puntuacion='.$row['Puntuacion'].
								'&Imagen='.$row['Screenshot'].'">Aprobar</a>';
							}else{
								echo 'Aprobado';
							}
							echo'</td>';
						echo '</tr>';
					}
				echo '</table>';
			echo '</div>';
		?>
	</body>
</html>