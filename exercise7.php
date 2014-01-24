<?php

require_once 'class/itunes.php';
require_once 'class/dbmysqli.php';

ini_set('max_execution_time', 3000);

?>

<html>
	<head>
		<meta charset="UTF-8">	
	</head>
	<body>
		<h2>Exercise 7</h2>
		<br />
		<?php
		
		if ( isset( $_POST['sbmt-form'] ) ){
			$itunes = new Itunes( $_POST['id'] );
			
			echo $itunes->output_to_html();
		}
		else {
			$count	= 0;
		
		for ( $i = 374525528; $i <= 374526528; $i++ ){
			$itunes = new Itunes( $i );
			if ( $itunes->get_data() ){
				if( !$itunes->insert() ){
					debug( 'Unable to register app id ' . $i . " to database. Continuing operation. <br />", 1 );
					continue;
				}
				debug( 'App id ' . $i . ' successfully registered to database.<br />', 2 );
				$count++;
			}
			else{
				debug( 'No data was found for app id ' . $i . ". Continuing operation. <br />", 1 );
			}
		}
		debug('Number of insertions on database: ' . $count );
		
		echo '<br /><hr /><br />';
		echo '<form action="" method="POST">';
		echo '<input type="text" name="id" placeholder="Insert app id" />';
		echo '<input type="submit" name="sbmt-form" />';
		echo '</form>';
		
		}
		
		?>
	</body>
</html>