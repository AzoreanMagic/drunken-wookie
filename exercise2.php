<?php

$arr = array(); $i=1;

while (20 > count ($arr )){
	if (is_prime( $i)) 
		$arr[] = $i;
    $i++;
}

print_list($arr);

function is_prime($nmb){
	for($i=2; $i<$nmb; $i++){
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