<?php

// Config for debug mode
$debug       					= true;          // Wether or not this script will run in debug mode
$verbose     					= true;          // Wether or not this script will output debug text to

// Database configuration
if ( !defined( 'HOST' ) )		define( 'HOST', 	'localhost' );
if ( !defined( 'USER' ) )		define( 'USER', 	'usrphpex' );
if ( !defined( 'PASS' ) )		define( 'PASS', 	'pwdusrphpex' );
if ( !defined( 'DATABASE' ) )	define( 'DATABASE', 'phpex' );

// Server settings
ini_set( 'max_execution_time', 3000 );

?>