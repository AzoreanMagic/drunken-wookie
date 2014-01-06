<<<<<<< Updated upstream
$current_page=4;  //página actual
$total_pages=10;  //total de páginas
$boundaries=0;  //quantas páginas queremos linkar no início e no fim (ou seja, quantas a partir da página 1 e quantas antes da última página - inclusivé)
$around=2;  //quantas páginas queremos linkar antes e depois da página actual
		
for($i=1, $skip_left = $skip_right = false; $i <= $total_pages; $i++){
	if($i <= $boundaries || $i > $total_pages-$boundaries || ($i >= $current_page - $around && $i <= $current_page + $around)){	//print page if number is within boundaries, is around current page or is current page
		if($i == $current_page){
			echo '<a href="?pagina=' . $i . '"><strong>' . $i . ' </strong></a> ';
			continue;	
		}		
		echo '<a href="?pagina=' . $i . '">' . $i . ' </a> ';
	}
  	else{
		switch($i){
			case $i < $current_page && !$skip_left: {	//check if page is left of current page and '...' has not yet been printed
				echo '... ';
				$skip_left = true;
						
				break;
			}
			case $i > $current_page && !$skip_right: {	//check if page is right of current page and '...' has not yet been printed
				echo '... ';
				$skip_right = true;
						
				break;
			}
		} //end switch
	}  //end else
}  //end for
=======
<!DOCTYPE html>
<html>
	<head>
		<title>Exercício PHP</title>
		<meta charset="utf-8">
		
		<style>
			h2 {
				font-family:Helvetica;
				color: #777;
			}
			
			a, a:hover {
				font-family:Helvetica;
				text-decoration: none;
				color: #777;
			}
		</style>
	</head>
	<body>
		<h2>Exercício PHP</h1><hr /><br />
		
		<footer>
		<?php
		$current_page=4;  //página actual
		$total_pages=10;  //total de páginas
		$boundaries=0;  //quantas páginas queremos linkar no início e no fim (ou seja, quantas a partir da página 1 e quantas antes da última página - inclusivé)
		$around=2;  //quantas páginas queremos linkar antes e depois da página actual
		
		for($i=1, $skip_left = $skip_right = false; $i <= $total_pages; $i++){
			if($i <= $boundaries || $i > $total_pages-$boundaries || ($i >= $current_page - $around && $i <= $current_page + $around)){	//print page if number is within boundaries, is around current page or is current page
				if($i == $current_page){
					echo '<a href="?pagina=' . $i . '"><strong>' . $i . ' </strong></a> ';
					continue;	
				}		
				echo '<a href="?pagina=' . $i . '">' . $i . ' </a> ';
			}
			else{
				switch($i){
					case $i < $current_page && !$skip_left: {	//check if page is left of current page and '...' has not yet been printed
						echo '... ';
						$skip_left = true;
						
						break;
					}
					case $i > $current_page && !$skip_right: {	//check if page is right of current page and '...' has not yet been printed
						echo '... ';
						$skip_right = true;
						
						break;
					}
				} //end switch
			}  //end else
		}  //end for
	
		?>
		</footer>
	</body>
</html>
>>>>>>> Stashed changes
