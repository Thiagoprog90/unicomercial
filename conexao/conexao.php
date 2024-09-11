<?php 


$hostname_1 = "localhost";
$username_1 = "root";
$password_1 = "";
$database_1 = "unisystem";

$link = mysqli_connect($hostname_1, $username_1, $password_1, $database_1);
mysqli_set_charset( $link, 'utf8mb4');
// utf8mb4_unicode_520_ci

if (!$link) 
{
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

