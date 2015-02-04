<html>

<head>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>


	<script>
	
		$(document).ready(function(){
		
			$('#button1').click(function(){
		
				 id_name=$("#input").val();
		
			$.get(
	
			'part_three.php',
			{id: id_name},
			function(myresult){
			
				$('#div1').html(myresult);
			
			});
			
		
			});
		});
	
	
	</script>


</head>

<body>

	<input type="number" id="input" />

	
	<button id="button1">Click Me</button>
	
	<br>
	<div id="div1"></div>

</body>



</html>