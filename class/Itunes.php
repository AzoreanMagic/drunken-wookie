<?php

	class itunes {
                
		private $id;
		private $data;
		private static $ready = false;
                
		public function __construct( $id ){
			$this->id = $id;
			
			if( $this->data = self::grab_data( $id ) ){
				self::$ready = true;
			}
		}
                
		public function get_id(){
			return (self::$ready)  ? $this->id : false;
		}
                
		public function get_data(){
			return (self::$ready)  ? $this->data : false;
		}
                
		private static function grab_data( $id ){        
			try{
				if( !$data = file_get_contents( 'http://itunes.apple.com/lookup?id=' . $id ) ){
					throw new Exception('There was an error downloading from Apple\'s servers!');
				}
                                
				if( !$data = json_decode( $data, true ) ){
					throw new Exception('The response we got from Apple is invalid');                
				}
                                
				if( !isset( $data['results'][0] ) ){
					throw new Exception('Could not find app id ' . $id. '. ');        
				}
                                
				return $data['results'][0];
                                        
			} catch( Exception $e ){
				echo $e->getMessage();
				return false;
			}
		}
                
		public function output_to_html(){
			$table = "";
                        
			if( !is_array( $this->data ) )
				return;
                        
			foreach ( $this->data as $field => $value ){
				( is_array( $value ) ) ? $value = implode( ', ', $value ) : $value;
                                
				$table .= '<tr><td><strong>' . $field . ':</strong></td><td>' . $value . '</td></tr>';
			}
                        
			return '<table>' . $table . '</table>';
		}
		
		function insert(){
				
			$db		= new dbmysqli( 'localhost', '740351', '', '740351');
			$conn	= $db->get_connection();
		
			$result	= $db->execute_query( $conn, "SHOW tables LIKE 'itunes'" );
			
			if ( !$db->fetch_array( $result ) ){	//check if table exists, if not create it
				debug( 'Itunes table does not exist. Attempting to create table... <br />', 1 );
		
				try{
					$query = "CREATE TABLE itunes (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, kind VARCHAR (64), features TEXT, supportedDevices TEXT, 
					isGameCenterEnabled VARCHAR (32), screenshotUrls TEXT, ipadScreenshotUrls TEXT, artworkUrl60 TEXT, artworkUrl512 TEXT, artistViewUrl TEXT, artistId INT,
					artistName VARCHAR(64), price VARCHAR(32), version VARCHAR(32), description TEXT, currency VARCHAR(16), genres TEXT, genreIds TEXT,
					releaseDate VARCHAR (64), sellerName VARCHAR(64), bundleId VARCHAR(64), trackId INT, trackName VARCHAR(96), primaryGenreName TEXT,
					primaryGenreId INT, formattedPrice VARCHAR(32), wrapperType VARCHAR(32), trackCensoredName VARCHAR(64), languageCodesISO2A VARCHAR(16), fileSizeBytes BIGINT,
					contentAdvisoryRating VARCHAR(32), artworkUrl100 TEXT, trackViewUrl TEXT, trackContentRating VARCHAR(16))";
			
					if( !$db->execute_query( $conn, $query ) ){
						throw new Exception( 'Could not create table on database. Aborting.' );
					}
					debug( 'Database table itunes was successfully created. <br />', 2 );
				}
				catch(Exception $e){
					die ( debug ( $e->getMessage(), 4) );
				}
			}
	
			$query_fields = $query_values = "";
	
			foreach ( $this->data as $field => $value){
				$field	= $db->escape_string( $conn, $field );	
				
				if ( !dbmysqli::exists_column( $db, $conn, $field ) ){	//check if column exists on table, if not create it as VARCHAR type
					debug( 'Column ' . $field . ' does not exists on table. Attempting to create column' . $field .'... <br />', 1 );
					
					try{
						$query = "ALTER TABLE itunes ADD " . $field . " VARCHAR(128)";
				
						if( !$db->execute_query( $conn, $query ) ){
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
				( ! is_array( $value ) ) ? $query_values .= "'". $db->escape_string( $conn, $value ) . "', " : $query_values .= "'". $db->escape_string( $conn, implode( ', ', $value ) ) . "', ";
			}		
			$query = "INSERT INTO itunes (id, " . substr($query_fields, 0, -2) . ") VALUES (" . $this->id . ", " . substr($query_values, 0, -2) . ")";
	 
	 		try{
	 			$result = $db->execute_query( $conn, $query );
	 			
	 			if( !$result && $db->errorno( $conn ) ==1062 ){
	 				throw new Exception( 'App id ' . $this->id . ' already registered on database.' );
	 			}
	 		}
			catch( Exception $e){
				debug( $e->getMessage() );
				return false;
			}
			
	 		return $result;
		}
	}