<?php
	/* Itunes class */
	class Itunes {
		
		private $id;
		private $data;		
		
		public function __construct( $id ){
		
			$this->id 	= $id;
			$this->data	= self::grab_data();;
		}
		
		public function get_id(){
			return $this->id;
		}
		
		public function get_data(){
			return $this->data;
		}
		
		private static function grab_data(){
			$data = json_decode( file_get_contents( 'http://itunes.apple.com/lookup?id=655589425' ), TRUE );
			
			return	$data['results'][0];
		}
		
		public function output_to_html(){
			$table = "";
			
			foreach ( $this->data as $field => $value ){
				( is_array( $value ) ) ? $value = implode( ', ', $value ) : $value;
				
				$table .= '<tr><td><strong>' . $field . ':</strong></td><td>' . $value . '</td></tr>';
			}
			
			return '<table>' . $table . '</table>';
		}
	}
?>