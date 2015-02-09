<?php 

	$dbhost = "RAINEIR-PC";
	$dbuser = "";
	$dbpass = "";
	$dbname = "JT_ERP";

	$connection = mssql_connect($dbhost,$dbuser,$dbpass);

	$db_selection = mssql_select_db($dbname);

	/*
	$query = "select * from jrp_quotes";
	
	$result = mssql_query($query);

	while($row = mssql_fetch_array($result)){
		
		echo $row['product_type'];
		echo '<br>';
		
	} */
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$per_page = 5;
	$start = ($page - 1) * $per_page;
	
	//$query = mssql_query("select top $per_page * from jrp_quotes");
	
	$query = mssql_query("SELECT TOP $per_page * FROM jrp_quotes WHERE id > $start");
	
	$query1 = "select count('product_type') from jrp_quotes";
	$pages_query = mssql_query($query1);
	$array_result = mssql_fetch_array($pages_query);
	$pages = ceil(mssql_result($pages_query , 0 , $array_result['product_type']) / $per_page) ;
	// $pages = ceil(mssql_num_rows($pages_query) / $per_page) ;
	//echo $pages;
	
	while($row = mssql_fetch_assoc($query)){
		
		echo $row['product_type'];
		echo '<br>';
		
	}
	
	$prev = $page - 1;
	$next = $page + 1;
	
	if(!($page<=1)){
		echo "<a href='pagination.php?page=$prev'>Previous</a> ";
	}
	
	if($pages >= 1){
		
		
		for($x=1;$x<=$pages;$x++){
			
			//echo '<a href="?page='.$x.'">' . $x . '</a> ';
			
			echo ($x == $page) ? '<b><a href="?page='.$x.'">' . $x . '</a></b> ' : '<a href="?page='.$x.'">' . $x . '</a> ';
			
		}
		
		
	}
	
	if(!($page>= $pages)){
		echo "<a href='pagination.php?page=$next'>Next</a> ";
	}

?>