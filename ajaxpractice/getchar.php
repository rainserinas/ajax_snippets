<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>


<?php


	$q = intval($_GET['test']);
	
	//connection
	
	$connection = mysqli_connect("localhost","root","");
	
	if(!$connection){
	
		die("Could not connect: " . mysqli_error($connection));
	}
	
	
	mysqli_select_db($connection,"ajaxpractice");
	
	$query = "SELECT `character`.id_char, `character`.`name`, `character`.strength, `character`.devil_fruit FROM `character` where id_char = '" . $q ."'";
		
	$result = mysqli_query($connection,$query) or die ("Error: " . mysqli_error($connection));
	
	echo "
	
		<table>
		<tr>
		<th>Character Name</th>
		<th>Strength</th>
		<th>Devil Fruit Power</th>
		</tr>";



	
				while($row = mysqli_fetch_array($result)){
				
					echo "<tr>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['strength'] . "</td>";
					echo "<td>" . $row['devil_fruit'] . "</td>";
					echo "</tr>";
				}
					
		
		
		echo "</table>";
		mysqli_close($connection);
?>

</body>
</html>




