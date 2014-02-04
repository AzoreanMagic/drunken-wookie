<?php
	/* helper mysqli class */
	class helper_mysqli {
		
		private $host;
		private $user;
		private $pass;
		private $database;
		private static $conn;
		private static $ready = false;
		
		public function __construct($host, $user, $pass, $database){
			$this->host		= $host;
			$this->user		= $user;
			$this->pass		= $pass;
			$this->database = $database;
		}
		
		public function get_connection(){
			try{
				if ( !self::$conn = new mysqli( $this->host, $this->user, $this->pass, $this->database ) )
					throw new Exception ( 'Unable to connect to database!' );
				
				self::$ready = true;
			}
			catch(Exception $e){
				echo $e;
				die();
			}
			self::$conn->set_charset( 'utf8' );
			
			return true;
		}

		public function close_connection( ){
			if( self::$ready ){
				self::$conn->close();
				self::$ready = false;
			}	
		}
		
		public function execute_query( $query ){
			if( self::$ready ){
				if ( !$result = self::$conn->query( $query ) ){
					//echo self::$conn->error;
				}
				return $result;	
			}
			return false;
		}
		
		public function fetch_array( $result ){
			if( self::$ready ){
				$array 	= array();
			
				while ( $row = $result->fetch_assoc() )
					array_push( $array, $row );
			
				return $array;	
			}	
		}
		
		public function escape_string( $str ){
			if( self::$ready )	
				return self::$conn->escape_string( $str );
		}
		
		public function error_number(){
			return self::$conn->errno;
		}
		
		public function create_column( $table_name, $column_name ){
			$query = "ALTER TABLE " . $table_name . " ADD " . $column_name . " VARCHAR(128)";
			
			return self::$conn->query( $query );
		}
		
		public function exists_column( $table_name, $column_name ){
			$result = self::$conn->query( "SHOW COLUMNS FROM " . $table_name . " LIKE '" . $column_name . "'" );
	
			return $result->fetch_assoc();
		}
	}
?>