<?php

require_once 'config.php';
require_once 'class/itunes.php';
require_once 'helper_debug.php';
require_once 'class/helper_mysqli.php';

?>

<html>
	<head>
		<meta charset="UTF-8">	
	</head>
	<body>
		<h2>Exercise 7</h2>
		
		<?php
		$mysqli = new helper_mysqli(HOST, USER, PASS, DATABASE);
		$mysqli->get_connection();
		
		echo file_get_contents( dirname( __FILE__ ) . '/view/search-appid.html' );
		
		if ( isset( $_POST['sbmt-form'] ) ){
			$itunes = new Itunes( $_POST['id'] );
			
			echo $itunes->output_to_html();
		}
		else {
			$count	= 0;
		
			for ( $i = 374525528; $i <= 374526528; $i++ ){
				$itunes = new Itunes( $i );
				if ( $data = $itunes->get_data() ){
					if( !insert( $i, $data ) ){
						debug( 'Unable to register app id ' . $i . "to database. Continuing operation. <br />", 1 );
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
		}
		
		?>
	</body>
</html>

<?php

function insert( $id, $data ){
				
	$mysqli = new helper_mysqli(HOST, USER, PASS, DATABASE);
	$mysqli->get_connection();
		
	$result	= $mysqli->execute_query( "SHOW tables LIKE 'itunes'" );
			
	if ( !$mysqli->fetch_array( $result ) ){	//check if table exists, if not create it
		debug( 'Itunes table does not exist. Attempting to create table... <br />', 1 );
		
		try{
			if( !$query = file_get_contents( 'itunes.sql' ) )
				throw new Exception( 'Unable to load sql for table creation' );
			
			if( !$mysqli->execute_query( $query ) )
				throw new Exception( 'Could not create table on database. Aborting.' );
			
			debug( 'Database table itunes was successfully created. <br />', 2 );
		}
		catch(Exception $e){
			die ( debug ( $e->getMessage(), 4) );
		}
	}
	
	$query_fields = $query_values = "";
	
	foreach ( $data as $field => $value){
		$field	= $mysqli->escape_string( $field );	
				
		if ( !$mysqli->exists_column( $field ) ){	//check if column exists on table, if not create it as VARCHAR type
			debug( 'Column ' . $field . ' does not exists on table. Attempting to create column' . $field .'... <br />', 1 );
					
			try{
				$query = "ALTER TABLE itunes ADD " . $field . " VARCHAR(128)";
				
				if( !$mysqli->execute_query( $query ) ){
					throw new Exception( 'Column' . $field . 'could not be created on database.<br />' );
				}
				debug( 'Column ' . $field .' successfully created.<br />', 2 );
			}
			catch(Exception $e){
				debug( $e->getMessage(), 6 );
				return false;
			}
		}
		
		$query_fields .= $field . ", ";
		
		( ! is_array( $value ) ) ? $query_values .= "'". $mysqli->escape_string( $value ) . "', " : $query_values .= "'". $mysqli->escape_string( implode( ', ', $value ) ) . "', ";
	}		
	$query = "INSERT INTO itunes (id, " . substr($query_fields, 0, -2) . ") VALUES (" . $id . ", " . substr($query_values, 0, -2) . ")";
	
	try{
	 	$result = $mysqli->execute_query( $query );

	 	if( !$result && $mysqli->error_number() == 1062 ){
	 		throw new Exception( 'App id ' . $id . ' already registered on database.' );
	 	}
	}
	catch( Exception $e){
		debug( $e->getMessage() );
		return false;
	}
	
	$mysqli->close_connection();
	
	return $result;
}

?>