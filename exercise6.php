<?php

require_once 'class/Itunes.php';

?>

<html>
	<head>
		<meta charset="UTF-8">	
	</head>
	<body>
		<h2>Exercise 6</h2>
		<br />
		<?php
		$itunes = new Itunes(1);
		print $itunes->output_to_html();
		?>
	</body>
</html>