<?php

require_once 'class/Database.php';
date_default_timezone_set( 'Europe/Lisbon' );

if ( isset( $_POST['sbmt'] ) ){
	
	$bus_route	= Database::escape_string( $_POST['bus_route'] );
	$stop_id	= Database::escape_string( $_POST['stop_id'] );
	
	if ( $row = Database::fetch_array( "SELECT stop_time FROM buses WHERE stop_time > '" . date('H:i:s') . "' AND bus_route = '" . $bus_route . "' AND stop_id = '" . $stop_id . "'" ) ){
		$time_diff 	= time_diference_now( $row[0]['stop_time'] ) ;	
		$msg 		= sprintf( "Your next bus is at %s, in %d hour(s) and %d minutes(s) .", substr( $row[0]['stop_time'], 0, -3 ), $time_diff->h, $time_diff->i);
	}
	else 
		$msg 		= "No results were found.";
}

?>

<html>
	<head>
		<meta charset="UTF-8">	
	</head>
	<body>
		<h2>Exercise 5</h2>
		<br />
		<?php
		
		if ( isset( $msg ) ){
			echo '<p>' . $msg . '</p>';
		}
		else {
			?>
			<form method="POST" enctype="multipart/form-data">
				<label for="stop_id">Stop ID:</label>
				<input type="text" name="stop_id" required /><br />
				
				<label for="paragens">Bus route:</label>
				<select id="paragens" name="bus_route">
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
				</select>
				<input type="submit" name="sbmt" value="search" />
			</form>
			<?php	
		}
		?>
	</body>
</html>

<?php

function time_diference_now($time){
	$now = new DateTime(date('H:i'));
	
	return $now->diff(new DateTime($time)); 
}

?>