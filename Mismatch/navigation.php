<?php
	if(isset($_SESSION['nombreUser'])){
		echo '<div class="BotonesLogIn">';
		echo '<a href="ViewProfile.php"><img class="View" src="Estilo/View_Profile.png"/></a>';
		echo '<a href="EditProfile.php"><img class="Edit" src="Estilo/Edit_Profile.png"/></a>';
		echo '<a href="MyMismatch.php"><img class="MM" src="Estilo/My_Mismatch.png"/></a>';
		echo '<a href="LogOut.php"><img class="LogOut" src="Estilo/Log_Out.png"/></a>';
		echo '<br></br>';
		echo '<div class="log"><h3>Estas Conectado Como '.$_SESSION['nombreUser'].'</h3></div>';
		echo '</div>';
	}
	if(!isset($_SESSION['nombreUser'])){
		echo '<div class="BotonesLogOut">';
		echo '<a href="LoginProfile.php"><img class="LogIn" src="Estilo/Log_In.png"/></a>';
		echo '<a href="SignUp.php"><img class="SignUp" src="Estilo/Sign_Up.png"/></a>';
		echo '</div>';
	}
?>