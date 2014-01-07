<?php

$arr = array(); $i=1;

while (20 > count ($arr )){
	if (is_prime( $i)) 
		$arr[] = $i;
    $i++;
}

print_list($arr);

function is_prime($nmb){
	return $nmb % 2 == 0;
}

function print_list($list){
	echo '<ul>';
	
	foreach($list as $item)
		echo '<li>'.$item.'</li>';
	
	echo '</ul>';
}

?>