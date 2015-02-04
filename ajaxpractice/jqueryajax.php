<!DOCTYPE html>
<html>
<head>

	<title>Jquery Ajax</title>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
	<script>
	
	
		$(document).ready(function(){
		
			$('button').click(function(){
				
				var data = 'city=italy&date=2012';
				
				$.get('getchar.php' , data);
		});
	});
	</script>
	
	
	
</head>

<body>

	<div id="try">This will be changed</div>

	<button>Press It</button>


</body>


</html>