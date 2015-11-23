<?php
class dat {

	private $DBHost = 'MARK-WEB2';
	private $DBUser = 'sa';
	private $DBPass = 'str0ngp@ssw0rd';
	private $DBName = 'Mark_Fast';

	function __construct(){
		$this->getConnection($this->DBHost,$this->DBUser,$this->DBPass,$this->DBName);
	}


	private function getConnection($host,$user,$password,$dbname){

		$dbHandle = mssql_connect($host,$user,$password) or die("Failed to connect host:$host");
		$selected = mssql_select_db($dbname,$dbHandle)or die("Failed to connect to Database: $dbname");

	}//End method

	public function execute($query){


		$result = mssql_query($query);

		return $result;
		mssql_close();

	}//End method

	public function getData($query){

		$result = mssql_query($query);
		while($row = mssql_fetch_array($result)){
			$data[] = $row;
		}

		return $data;
		mssql_close();

	}//End method


}//End Class