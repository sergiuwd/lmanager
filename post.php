<?php
	$time="";
	$date="NULL";
	if(isset($_POST['orainceput'])){$time=$_POST['orainceput']}
	if(isset($_POST['notaprez'])){$time=$_POST['notaprez']}

	echo $time."<br>";
	echo $date;
?>