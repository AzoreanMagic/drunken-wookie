<?php

$data = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Ponta%20Delgada,Portugal&units=metric'), TRUE);

echo sprintf("The temperature for today is %d, and it is %s.", get_key_value($data, 'temp'), get_key_value($data, 'description'));

echo '<br/>Azores: ' . format_date(time(), 'Atlantic/Azores') . ' | Toronto: ' . format_date(time(), 'America/Toronto');

/* FUNCTIONS */

function get_key_value($arr, $nkey){
	$val="";	
	foreach($arr as $key => $value){
		if($key == $nkey && !is_array($value)){
			return $value;
		}
		elseif(is_array($value)){
			$val = get_key_value($value, $nkey);
			if(!empty($val))
				break;
		}
	}
	return $val;
}

function format_date($date_time, $timezone, $date_format='Y-m-d H:i:s'){
	$date = new DateTime();
	$date->setTimestamp($date_time);

	$date->setTimezone(new DateTimeZone($timezone));
	return $date->format($date_format);		
}

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
?>