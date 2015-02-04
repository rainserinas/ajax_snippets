<?php 

	$what_id = $_GET['id'];


	$connection = mysqli_connect("localhost","root","");
	
	if(!$connection){
	
		die("Could not connect: " . mysqli_error($connection));
	}
	
	
	mysqli_select_db($connection,"ajaxpractice");
	
	$query = "SELECT `character`.id_char, `character`.`name`, `character`.strength, `character`.devil_fruit FROM `character` where `character`.id_char='" . $what_id . "'";
		
	$result = mysqli_query($connection,$query) or die ("Error: " . mysqli_error($connection));
	
	

			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
				
					echo 'Name: ' . $row['name'] . 'strength ' . $row['strength'] .  'Devil fruit ' . $row['devil_fruit'];
					echo '<br>';
				}
					
			}else{
			
				echo '0 result';
			
			}
		

		mysqli_close($connection);









?>