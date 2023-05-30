<html>
<html xmlns="http://www.w3.org/1999/xhtml">
	 	<?php 
			$titulo='Risky Jobs';
			require_once('header.php'); 
			echo '<body class="index">';
		?>
    	<h1>Risky Jobs</h1>
        <img class="imagen" src="Imagenes/logo.png" />
        <div class="buscador">
            <form class="formulario" action="search.php" enctype="multipart/form-data" method="get" >
            	<input type="hidden" name="page" value="1"/>
                Search <input id="user_search" name="user_search" type="text" size="50" required />
                <div class="botonImagen">
                	<input id="Buscar" type="image" name="Buscar" src="Imagenes/boton_search.png" value="Buscar" />
                </div>
            </form>
        </div>
         <?php
			require_once('footer.php');
		?>
	</body>
</html>
