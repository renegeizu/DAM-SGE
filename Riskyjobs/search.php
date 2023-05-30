<?php
	$titulo='Risky Jobs';
	require_once('header.php');
	require_once('variables_db.php');
	echo '<body class="search">';
	$consulta="SELECT * FROM riskyjobs WHERE title LIKE '%";
	$busqueda=$_GET['user_search'];
	$busqueda_palabras=limpiar($busqueda);
	$buqueda_final=array();
    foreach($busqueda_palabras as $palabra){
    	if(!empty($palabra)){
        	$busqueda_final[]=trim($palabra);
        }
   	}
	$palabras=implode("%' OR title LIKE '%", $busqueda_final);
	$limite=$_GET['page'];
	if(!empty($_GET['order'])){
		if($limite==1){
			$numero=$limite*3;
			$resultado=consulta($consulta.$palabras."%' ORDER BY ".$_GET['order']." LIMIT ".$numero);
		}else{
			$numero=$limite*3;
			$resultado=consulta($consulta.$palabras."%' ORDER BY ".$_GET['order']." LIMIT ".$numero.", 3");
		}
	}else{
		if($limite==1){
			$numero=$limite*3;
			$resultado=consulta($consulta.$palabras."%' ORDER BY title"." LIMIT ".$numero);
		}else{
			$numero=$limite*3;
			$resultado=consulta($consulta.$palabras."%' ORDER BY title"." LIMIT ".$numero.", 3");
		}
	}
	if(!empty($_GET['order'])){
		$pag_actual=consulta($consulta.$palabras."%' ORDER BY ".$_GET['order']);
	}else{
		$pag_actual=consulta($consulta.$palabras."%' ORDER BY title");
	}
	$cantidad=mysqli_num_rows($pag_actual);
	page_links($_GET['page'], $cantidad, $resultado);
	require_once('footer.php');
?>

<?php
	function limpiar($busqueda){
		$busqueda=str_replace(',', ' ', $busqueda);
		$busqueda=str_replace('.', ' ', $busqueda);
		$busqueda=str_replace(';', ' ', $busqueda);
		$busqueda=str_replace('/', ' ', $busqueda);
		$busqueda_palabras=explode(' ', $busqueda);
		return $busqueda_palabras;
	}

	function consulta($query){
		$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
		$resultado=mysqli_query($dbc, $query);
		mysqli_close($dbc);
		return $resultado;
	}
	
	function page_links($pag_actual, $cantidad, $resultado){
		$pag_siguiente=$pag_actual+1;
		$pag_anterior=$pag_actual-1;
		echo '<table class="Tabla" >';
		echo '<tr><th><a href = "'. $_SERVER['PHP_SELF'].'?page='.$pag_actual.'&order=title&user_search='.$_GET['user_search']
			.'">Title</a></th>';
		echo '<th><a href = "'. $_SERVER['PHP_SELF'].'?page='.$pag_actual.'&order=title&user_search='.$_GET['user_search']
			.'">Description</a></th>';
		echo '<th><a href = "'. $_SERVER['PHP_SELF'].'?page='.$pag_actual.'&order=city&user_search='.$_GET['user_search']
			.'">City</a></th>';
		echo '<th><a href="'. $_SERVER['PHP_SELF'].'?page='.$pag_actual.'&order=state&user_search='.$_GET['user_search']
			.'">State</a></th>';
		echo '<th><a href="'. $_SERVER['PHP_SELF'].'?page='.$pag_actual.'&order=zip&user_search='.$_GET['user_search']
			.'">Zip</a></th>';
		echo '<th><a href="'. $_SERVER['PHP_SELF'].'?page='.$pag_actual.'&order=company&user_search='.$_GET['user_search']
			.'">Company</a></th>';
		echo '<th><a href="'. $_SERVER['PHP_SELF'].'?page='.$pag_actual.'&order=date_posted&user_search='.$_GET['user_search']
			.'">Date Posted</a></th></tr>';
		while($row=mysqli_fetch_array($resultado)){
			echo '<tr><td>'.$row['title'].'</td>';
			echo '<td>'.$row['description'].'</td>';
			echo '<td>'.$row['city'].'</td>';
			echo '<td>'.$row['state'].'</td>';
			echo '<td>'.$row['zip'].'</td>';
			echo '<td>'.$row['company'].'</td>';
			echo '<td>'.$row['date_posted'].'</td></tr>';
		}
		echo '</table>';
		echo '<div>';
		if(isset($_GET['order'])){
			$orden=$_GET['order'];	
		}else{
			$orden='title';
		}
		if($pag_actual>1){
			echo '<a href="'. $_SERVER['PHP_SELF'].'?page='.$pag_anterior.'&order='.$orden.'&user_search='
				.$_GET['user_search'].'">Anterior</a>     ';
		}
		$cant=round($cantidad/3);
		for ($i=1; $i<=$cant; $i++){
			echo '<a href="'. $_SERVER['PHP_SELF'].'?page='.$i.'&order='.$orden.'&user_search='.$_GET['user_search']
			.'">'.$i.'</a>   ';
		}
		if($pag_actual<$cant){
			echo '<a href="'. $_SERVER['PHP_SELF'].'?page='.$pag_siguiente.'&order='.$orden.'&user_search='
				.$_GET['user_search'].'">Siguiente</a>     ';
		}
		echo '</div>';
	}
?>