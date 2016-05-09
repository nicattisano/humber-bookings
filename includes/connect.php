<?php 

    session_start();
	$host 		= "localhost";
	$username 	= "root";
	$password 	= "root";
	$database 	= "humber";
	
	$connect	= mysqli_connect($host, $username, $password, $database) or die(mysqli_error($connect));