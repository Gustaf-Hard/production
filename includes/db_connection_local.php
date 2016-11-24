<?php

	define("DB_USER", “root”);
	define("DB_PASS", “root”);
	define("DB_NAME", "studi_production");
	define(“DB_SERVER”, “localhost”);

	//1. Create a database connection
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, 8889);

	// Test if caonnection succeeded
	if(mysqli_connect_errno()){
			die("Database connection failed: " .
			mysqli_connect_error() .
				" (" . mysqli_connect_errno() . ")"
			);
		}
?>