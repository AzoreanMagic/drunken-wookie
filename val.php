<?php

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	if ( isset( $_POST['email'] ) && filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ){
		echo 'md5: '. md5( $_POST['email'] );
	}
	else{
		echo 'O email inserido não é válido';
	}
}

?>