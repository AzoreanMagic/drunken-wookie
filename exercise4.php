<?php

$data = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Ponta%20Delgada,Portugal'), TRUE);

//var_dump($data);

echo array_to_str($data);

echo '<br />';
echo 'Azores: ' . format_date(time(), 'Atlantic/Azores') . ' | Toronto: ' . format_date(time(), 'America/Toronto');

/* FUNCTIONS */

function array_to_str($arr){
	$str = "";
		
	foreach($arr as $key => $value){
		if(is_array($value))
			$str .= '<ul><li> ' . $key . ' <ul>' . array_to_str($value) . '</ul></li></ul>';
		else 
			$str .=  '<li>' . $key . ': ' . $value . '</li>';; 
	}
	return $str;
}

function format_date($date_time, $timezone, $date_format='Y-m-d H:i:s'){
	$date = new DateTime();
	$date->setTimestamp($date_time);

	$date->setTimezone(new DateTimeZone($timezone));
	return $date->format($date_format);		
}
?>