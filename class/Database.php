<?php
	/* Database class */
	class Database {
		
		private static $host 		= "localhost";
		private static $user 		= "usrphpex";
		private static $pass 		= "pwdusrphpex";
		private static $database 	= "phpex";

		// Connection methods
		public static function get_connection(){
			$conn = new mysqli( self::$host, self::$user, self::$pass, self::$database);
			
			if ( $conn->connect_errno > 0 )
				die ( "Unable to connect: " );		
			
			$conn->set_charset( 'utf8' );
			return $conn;
		}

		public static function close_connection( $conn ){
			$conn->close();
		}
		
		public static function execute_query( $query ){
			$conn 	= self::get_connection();
			
			if ( !$result = $conn->query( $query ) )
				die ( 'Unable to process request' );
			
			return $result;
		}
		
		public static function fetch_array( $query ){
			$conn 	= self::get_connection();
			$result = self::execute_query( $query );
			$array 	= array();
			
			while ( $row = $result->fetch_assoc() )
				array_push( $array, $row );
			
			return $array;
		}
		
		public static function escape_string($str){
			$conn 	= self::get_connection();
			
			return $conn->escape_string($str);
		}
	}
?>