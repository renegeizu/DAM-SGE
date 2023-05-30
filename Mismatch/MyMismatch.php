<?php
	require_once('startsession.php');
	require_once('Cabeceras.php');
?>
<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php 
		require_once('Variables_DB.php');
		$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB);
		$id=$_SESSION['nombreUser'];
		$query="SELECT user_id FROM mismatch_user WHERE user='$id'";
        $result=mysqli_query($dbc, $query);
		$row=mysqli_fetch_array($result);
		$id=$row['user_id'];
		$query="SELECT * FROM response WHERE user_id='$id' AND response DISTINCT 0";
        $result=mysqli_query($dbc, $query);
		if(!empty($result)){
			require_once('Response.php');
		}else{
			$titulo='Mismatch - My Mismatch';
			require_once('header.php'); 
			echo '<h1>Perfiles a Fines al Tuyo</h1>';
			require_once('navigation.php');
			require_once('Variables_DB.php');
			$query = "SELECT * FROM mismatch_user WHERE user = '".$_SESSION['nombreUser']."'";
   			$result=mysqli_query($dbc, $query);
    		$row=mysqli_fetch_array($result);
			$idUser=$row['user_id'];
			$query = "SELECT mr.response_id, mr.topics_id, mr.response, mt.name AS topic_name FROM response AS mr INNER JOIN ".
					"topics AS mt USING (topics_id) WHERE mr.user_id = ".$idUser;
   			$data = mysqli_query($dbc, $query);
    		$user_responses = array();
    		while ($row=mysqli_fetch_array($data)) {
      			array_push($user_responses, $row);
    		}
			$mismatch_score = 0;
    		$mismatch_user_id = -1;
    		$mismatch_topics = array();
			$query = "SELECT user_id FROM mismatch_user WHERE user_id!=".$idUser;
   			$data = mysqli_query($dbc, $query);
    		while ($row = mysqli_fetch_array($data)) {
      			$query2 = "SELECT response_id, topics_id, response FROM response WHERE user_id = '".$row['user_id']."'";
      			$data2=mysqli_query($dbc, $query2);
      			$mismatch_responses = array();
     			while ($row2=mysqli_fetch_array($data2)) {
        			array_push($mismatch_responses, $row2);
      			}
				$score = 0;
      			$topics = array();
      			for ($i = 0; $i < count($user_responses); $i++) {
        			if ($user_responses[$i]['response'] + $mismatch_responses[$i]['response'] == 3) {
          				$score += 1;
          				array_push($topics, $user_responses[$i]['topic_name']);
        			}
      			}
				if ($score > $mismatch_score) {
        			$mismatch_score = $score;
       		 		$mismatch_user_id = $row['user_id'];
        			$mismatch_topics = array_slice($topics, 0);
      			}
			}
			if ($mismatch_user_id != -1) {
      			$query = "SELECT user, first_name, last_name, city, state, picture FROM mismatch_user WHERE".
						" user_id = '$mismatch_user_id'";
      			$data = mysqli_query($dbc, $query);
      			if (mysqli_num_rows($data) == 1) {
        			$row = mysqli_fetch_array($data);
        			echo '<table class="Tabla"><tr><td class="label">';
        			if (!empty($row['first_name']) && !empty($row['last_name'])) {
          				echo $row['first_name'] . ' ' . $row['last_name'] . '<br />';
        			}
					if (!empty($row['city']) && !empty($row['state'])) {
					  echo $row['city'] . ', ' . $row['state'] . '<br />';
					}
        			echo '</td><td>';
					if (!empty($row['picture'])) {
					  echo '<img class="Imagenes" src="'.$row['picture'].'" alt="Profile Picture" /><br />';
					}
					echo '</td></tr></table>';
					/*echo '<h4>You are mismatched on the following ' . count($mismatch_topics) . ' topics:</h4>';
        			foreach ($mismatch_topics as $topic) {
          				echo $topic . '<br />';
        			}*/
					$query = "SELECT * FROM mismatch_user WHERE user_id=".$mismatch_user_id;
      				$data = mysqli_query($dbc, $query);
					$row=mysqli_fetch_array($data);
        			echo '<h4 class="Correspondencia">View <a href=viewprofile.php?usuario='.$row['user'].'>'.$row['first_name'] . 
							'\'s Profile</a></h4>';
      			}
    		}
		}
  		mysqli_close($dbc);
		require_once('footer.php');
	?>
	</body>
</html>