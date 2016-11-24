<?php
define("DB_SERVER", "localhost"); // localhost
define("DB_USER", "root"); // c1gustaf
define("DB_PASS", "root"); // cmoYTO1C@7ww 
define("DB_NAME", "studi_new"); // c1gustaf

//1. Create a database connection

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);



// Test if caonnection succeeded
if(mysqli_connect_errno()){
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")"
	);
}
?>