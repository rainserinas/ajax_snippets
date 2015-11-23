<?php

	include("dat/dat.php");

	$dat = new dat();

	$query = "SELECT TOP 100 * FROM alarm_ROI";

	$result = $dat->getData($query);


	foreach ($result as $value) {
		$data = (object)$value;

		echo $data->Account . "<br />";

	}

