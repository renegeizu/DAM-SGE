<?php
	require_once('startsession.php');
?>
<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <?php 
			$titulo='Mismatch - Inicio';
			require_once('header.php'); 
		?>
        <h1>Mismatch</h1>
		<?php
            require_once('navigation.php'); 
        ?>
        <h2>Last Members</h2>
        <div class="lastmembers">
        	<?php
				require_once('Variables_DB.php');
                $dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
                $query='SELECT * FROM mismatch_user ORDER BY join_date DESC';
                $result=mysqli_query($dbc, $query);
				$cont=1;
                while($row=mysqli_fetch_array($result)){
					if($cont<=5){
						if(isset($_SESSION['nombreUser'])){
							echo '<a href="ViewProfile.php?usuario='.$row['user'].'">';
						}
						echo '<div class="Secundario">';
							echo '<img class="Imagen" src="'.$row['picture'].'"/>';
						echo '</div>';
						echo '<div class="Terciario">';
							echo '<p>'.$row['first_name'].' '.$row['last_name'].'</p>';
							echo '<p>'.$row['birthday'].' '.$row['city'].'</p>';
						echo '</div>';
						if(isset($_SESSION['nombreUser'])){
							echo '</a>';
						}
						echo '<div class="Separador"><hr/></div>';
						$cont++;
					}
				}
				mysqli_close($dbc);
            ?>
        </div>
         <?php
			require_once('footer.php');
		?>
	</body>
</html>