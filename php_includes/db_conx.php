<?php
	date_default_timezone_set("Europe/Bucharest");
	
	$db_conx = mysqli_connect("localhost", "r36370lu_sergiu", "Philips93", "r36370lu_gestiune");
	// Evaluate the connection
	if (mysqli_connect_errno()) {
		echo mysqli_connect_error();
		exit();
	}
?>