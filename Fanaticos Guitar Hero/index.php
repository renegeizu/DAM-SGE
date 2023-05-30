<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" type="text/css" href="Estilos.css"/>
	  <title>Guitar Hero</title>
	</head>
	<body>
    	<h1>Guitar Hero</h1>
            <p>Bienvenido a Guitar Hero, si quiere añadir su puntuación, <a href="add_score.php">pulse aquí</a>.</p>
            <h2>Máximas Puntuaciones</h2>
            <div class="Principal">
				<?php
					require_once('DB.php');
                    $dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
                    $query='SELECT * FROM guitarwars ORDER BY Puntuacion DESC, Fecha ASC;';
                    $result=mysqli_query($dbc, $query);
					$Puesto=1;
                    while($row=mysqli_fetch_array($result)){
						if($row['Approve']==1){
							echo '<div class="Secundario">';
								echo '<h3>'.$row['Puntuacion'].'</h3>'.
									 '<p class="parrafo">'.$row['Fecha'].'</p>'.
									 '<p class="parrafo">'.$row['Nombre'].'</p>'.
									 '<br/><hr/>';
							echo '</div>';
								echo '<div class="Terciario">';
								echo  '<p>'.$Puesto.'º Puesto'.'</p>';
								echo '<img src="'.$row['Screenshot'].'" />';
							echo '</div>';
							echo '<div class="Separador"></div>';
							$Puesto++;
						}
                    }					
                ?>
            </div>
	</body>
</html>