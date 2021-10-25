<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "demoapi";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if($conn->connect_error) {
	die("Db connect failed " . $conn->connect_error);
}

echo "Db connect successfull";