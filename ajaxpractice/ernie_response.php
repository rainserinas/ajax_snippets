<?php 

	$name = $_GET['name'];
	$from = $_GET['from'];
	$to = $_GET['to'];


	$connection = mysqli_connect('localhost','root','','ajaxpractice');

	
	if(!$connection){
	
		die('Connection failed');
		
	}
	
	if(empty($name) && empty($from) && empty($to)){
	
			$query = "SELECT * FROM ernie_test";

			$result = mysqli_query($connection , $query);
	
			if(mysqli_num_rows($result) > 0){
	
			echo '<center><table border="1" style="width: 80%" id="table">';
			echo '<tr>';
			
			echo '<th>ID</th>';
			echo '<th>Name</th>';
			echo '<th>Date</th>';
			
			
			echo '<tr>';
	
	
				while($row = mysqli_fetch_array($result)){
		
					echo '<tr>';
					
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['name'] . '</td>';
					echo '<td>' . $row['date'] . '</td>';
					
					echo '</tr>';
		
				}
	
			echo '</table></center>';
	
		}
	
	}
	
	
	if(!empty($name) && empty($from) && empty($to)){
	
		$query = "select * from ernie_test where name='" . $name . "'";
	
		$result = mysqli_query($connection , $query);
		
		if(mysqli_num_rows($result) > 0){
		
			echo '<center><table border="1" style="width: 80%" id="table">';
			echo '<tr>';
			
			echo '<th>ID</th>';
			echo '<th>Name</th>';
			echo '<th>Date</th>';
			
			
			echo '<tr>';
		
		
		
		
			while($row = mysqli_fetch_array($result)){
			
				echo '<tr>';
					
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['name'] . '</td>';
					echo '<td>' . $row['date'] . '</td>';
					
					echo '</tr>';
			
			}
		
			echo '</table></center>';
			
		}
	
		
	
	}
	
	if(!empty($from) && !empty($to) && empty($name)){
	
		$query = "select * from ernie_test where date between " . "'" .$from . "'" . " and " . "'" .$to . "'" . " order by date DESC" ;
		
		$result = mysqli_query($connection , $query);
		
		if(mysqli_num_rows($result) > 0){
		
			echo '<center><table border="1" style="width: 80%" id="table">';
			echo '<tr>';
			
			echo '<th>ID</th>';
			echo '<th>Name</th>';
			echo '<th>Date</th>';
			
			
			echo '<tr>';
		
			while($row = mysqli_fetch_array($result)){
			
				echo '<tr>';
					
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['name'] . '</td>';
					echo '<td>' . $row['date'] . '</td>';
					
					echo '</tr>';
			
			}
			
			echo '</table></center>';
		
		}
		
	
	}
	
	
	if(!empty($name) && !empty($from) && !empty($to)){
	
	
		$query = "select * from ernie_test where name='" . $name . "'" . " between " . "'" . $from . "'" . " and " . "'" . $to . "'";
		

		$result = mysqli_query($connection , $query);
		
		if(mysqli_num_rows($result) > 0){
		
			echo '<center><table border="1" style="width: 80%" id="table">';
			echo '<tr>';
			
			echo '<th>ID</th>';
			echo '<th>Name</th>';
			echo '<th>Date</th>';
		
			while($row = mysqli_fetch_array($result)){
			
				echo '<tr>';
					
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['name'] . '</td>';
					echo '<td>' . $row['date'] . '</td>';
					
					echo '</tr>';
			
			}
			
			echo '</table></center>';
		
		}
		
	
	}

	





?>