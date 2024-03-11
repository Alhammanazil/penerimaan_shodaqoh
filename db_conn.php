<?php 

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "my_db";

$conn = mysqli_connect($hostname, $username, $password, $db_name);

if (!$conn) {
	echo "Connection Failed!";
	exit();
}
