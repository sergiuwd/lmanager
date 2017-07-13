<?php
	date_default_timezone_set("Europe/Bucharest");

	$db_conx = mysqli_connect("localhost", "root", "", "disertatie");
	// Evaluate the connection
	if (mysqli_connect_errno()) {
		echo mysqli_connect_error();
		exit();
	}
?>
