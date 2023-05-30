<html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <title>Make Me Elvis</title>
	</head>
	<body>
	<?php
		$de='elmer@makemeelvis.com';
		if(empty($_POST['asunto'])){
			if(empty($_POST['cuerpo'])){
				echo "<p>Hay campos vacios</p>";
			}
		}else{
			if(empty($_POST['cuerpo'])){
				echo "<p>Hay campos vacios</p>";
			}else{
				$asunto=$_POST['asunto'];
				$cuerpo=$_POST['cuerpo'];
				$query="SELECT * FROM email_list";
				$dbc=mysqli_connect('localhost', 'root', 'pass', 'elvis_store');
				$result=mysqli_query($dbc, $query);
				while ($row = mysqli_fetch_array($result)) { 
						$to=$row['email'];
						mail($to, $asunto, $cuerpo);
						echo 'Has enviado un email a '.$to;
				}
				//echo $result;
				mysqli_close($dbc);
			}
		}
	?>
	</body>
</html>