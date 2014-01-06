<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
	</head>
	<body>
		<fieldset>
			<legend>Exercício</legend><br />
			
			<form name="form1">
				<label for="email">Email:</label>
				<input type="text" id="email" name="email" placeholder="email" required />
				
				<button id="sbmt-form" value="enviar" style="height: 30px; width: 60px;">Enviar</button>
			</form>
		</fieldset>
		<br /><br />
		<div id="md5-message"></div>
		
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script>
		$('#sbmt-form').click(function(){
			event.preventDefault();
			var email = $('input[name=email]').val();
			var form_data = { email: email };
			
			$.ajax({  
        		type: "POST",
        		url: "val.php",          	
        		data: form_data,  
        		success: function(response){  
					$('#md5-message').html(response);	
        		}, error:function(){
        			alert('Erro. Por favor tente mais tarde.');
           		}
    		});
   });
		</script>
	</body>
</html>