<?php

	$debug_out		= '';			// Where the debug code will be put and then outputted to a log file.
	$debug_unixtime = time( );		// Get the current time in Unix
	
	if ( $debug && $verbose ) { echo '<pre>'; }	// I like using the <pre> tag. It makes things look prettier and easier to read IMHO.
	
	// Debug modes :
	define ( 'DEBUG_MESSAGE'	, 0 );		// Regular message (No special formating )
	define ( 'DEBUG_WARNING'	, 1 );		// Warning
	define ( 'DEBUG_SUCCESS'	, 2 );		// Successful operation
	define ( 'DEBUG_SQL'		, 3 );		// SQL Query
	define ( 'DEBUG_FATAL'		, 4 );		// Fatal error
	define ( 'DEBUG_NETIO'		, 5 );		// Network Input/Output
	define ( 'DEBUG_ERROR'		, 6 );		// Error
	define ( 'DEBUG_CMD'		, 7 );		// Linux Console Command

			
	// Usage  : Shows a debug message following the variables on top
	// Params :
	//
	//	@Text : Text to show
	//	@mode : What kind of message it is, or what mode this text will be shown, please see the defines on top of this file for examples. Defaults to message
	//
	function debug( $text, $mode = DEBUG_MESSAGE ){
	
		global $debug, $verbose, $debug_out;
		
		if ( false == $debug ) { return; } // If debug mode is off, don't do a thing.
	
		$message = "";
		$data = array (
			0 => '<b style="color : #000000;">Message :</b> ',
			1 => '<b style="color : #CCAA00;">Warning :</b> ',
			2 => '<b style="color : #00CC00;">Success :</b> ',
			3 => '<b style="color : #0000CC;">SQL I/O :</b> ',
			4 => '<b style="color : #CC0000;">FATAL   :</b> ',
			5 => '<b style="color : #CC00CC;">NET I/O :</b> ',
			6 => '<b style="color : #FF0000;">ERROR   :</b> ',
			7 => '<b style="color : #FF8888;">COMMAND :</b> ',
		);
	
		$message = $data[$mode] . $text;
		
		if ( true == $verbose ) {
		
			echo $message . "<br>";
			
		} else {
		
			$debug_out .= $message;
		
		}	
		
		flush();
		ob_flush();
	}
	
	
	