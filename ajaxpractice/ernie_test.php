<?php 

	$connection = mysqli_connect('localhost','root','','ajaxpractice');

	
	if(!$connection){
	
		die('Connection failed');
		
	}
	
	$query = "SELECT * FROM ernie_test";

	$result = mysqli_query($connection , $query);



	?>

<!DOCTYPE html>

<html>

<head>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<title>Practice Ajax Table</title>

		<script>
		
		
		$(document).ready(function(){
		
			$('#click').click(function(){
		
				var name = $('#name').val();
				var from = $('#from').val();
				var to = $('#to').val();
		
					$.get(
			
					'ernie_response.php',
					{name: name , from: from , to: to},
					function(ernie_result){
					
						$('#table').html(ernie_result);
			
				});
			});
		});
	
		
		
		</script>
	

</head>


<body>

	<label>Name:</label>&nbsp<input id="name" type="text" />&nbsp
	<label>From:</label>&nbsp<input id="from" type="text" /><label>To:</label><input id="to" type="text" />
	<button id="click">Search</button>

	<br>
	<br>
	
	
	
	
	
	
	<center><table border="1" style="width: 80%" id="table">
	
		<tr>
		
			<th>ID</th>
			<th>Name</th>
			<th>Date</th>
		
		</tr>
		
		
		
		<?php
			

	
		if(mysqli_num_rows($result) > 0){
	
				while($row = mysqli_fetch_array($result)){
		
					echo '<tr>';
					
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['name'] . '</td>';
					echo '<td>' . $row['date'] . '</td>';
					
					echo '</tr>';
		
				}
	
	
		}
	
				
		?>
			
			
			
			
			
		
	
	
	</table></center>

</body>





</html>