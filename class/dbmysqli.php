<?php
	require_once	dirname( __FILE__ ) . '/../config.php';
	require_once	dirname( __FILE__ ) . '/../helper_debug.php';
	
	/* Database class */
	class dbmysqli {
		
		private $host;
		private $user;
		private $pass;
		private $database;
		
		public function __construct($host, $user, $pass, $database){
			$this->host		= $host;
			$this->user		= $user;
			$this->pass		= $pass;
			$this->database = $database;
		}
		
		// Connection methods
		public function get_connection(){
			$conn = new mysqli( $this->host, $this->user, $this->pass, $this->database);
			
			if ( $conn->connect_errno > 0 )
				die ( debug( "Unable to connect to the database.", 4 ) );		
			
			$conn->set_charset( 'utf8' );
			return $conn;
		}

		public function close_connection( $conn ){
			$conn->close();
		}
		
		public function execute_query( $conn, $query ){
			return $conn->query( $query );
		}
		
		public function fetch_array( $result ){
			$array 	= array();
			
			while ( $row = $result->fetch_assoc() )
				array_push( $array, $row );
			
			return $array;
		}
		
		public function escape_string( $conn, $str ){
			return $conn->escape_string( $str );
		}
		
		public function errorno( $conn ){	
			return $conn->errno;
		}
		
		public static function exists_column( $db, $conn, $column_name ){
			$result = $db->execute_query( $conn, "SHOW COLUMNS FROM itunes LIKE '" . $column_name . "'" );
	
			return $db->fetch_array( $result );
		}
	}
?>