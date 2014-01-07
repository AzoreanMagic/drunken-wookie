<?php

$data = explode(' ', file_get_contents('http://primes.utm.edu/lists/small/1000.txt'));
$arr  = array(); $i=2;

foreach($data as $cell){
	if(is_numeric($cell) && is_prime($cell)){
		array_push($arr, $cell);
	}	
}

//echo 'count:' . count($arr) ;
print_list($arr);

/* FUNCTIONS */

function is_prime($nmb){
	for($i=2; $i*2<$nmb; $i++){
		if($nmb % $i == 0)
			return false;
	}
	return true;
}

function print_list($list){
	echo '<ul>';
	
	foreach($list as $item)
		echo '<li>'.$item.'</li>';
	
	echo '</ul>';
}

?>