<?php

header("content-type: application/json");

$request = $_SERVER['REQUEST_METHOD'];

switch ($request) {
	case 'GET':
		getmethod();
		break;

	case 'PUT':
		$data = json_decode(file_get_contents("php://input"), true);

		putmethod($data);
		break;

	case 'POST':
		$data = json_decode(file_get_contents("php://input"), true);

		postmethod($data);
		break;

	case 'DELETE':
		$data = json_decode(file_get_contents("php://input"), true);

		deletemethod($data);

		break;
	
	default:
		echo '{"name" : "data not found"}';
		break;
}


// Data get/fetch here
function getmethod() {

	require_once 'db.php';

	$query = "SELECT * FROM info";
	$result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result) > 0) {
		$rows = [];
		while($r = mysqli_fetch_assoc($result)) {
			$rows['result'][] = $r;
		}
		echo json_encode($rows);
	}
	else {
		echo '{"name": "No data found"}';
	}
}

// Data insert here
function postmethod($data) {

	require_once 'db.php';

	$name = $data['name'];
	$email = $data['email'];

	$query = "INSERT INTO info(name, email, created_at) VALUES('$name', '$email', NOW())";

	if(mysqli_query($conn, $query)) {
		echo '{"result" : "Data inserted"}';
	}
	else {
		echo '{"result" : "Data not inserted"}';
	}
}

// Data edit/update here
function putmethod($data) {

	require_once 'db.php';

	$id = $data["id"];
	$name = $data["name"];
	$email = $data["email"];

	$query = "UPDATE info SET name = '$name', email = '$email' WHERE id = '$id' ";

	if(mysqli_query($conn, $query)) {
		echo '{"result" : "Data updated successfully"}';
	}
	else {
		echo '{"result" : "Data updated failed"}';
	}
}

// Data delete here
function deletemethod($data) {

	require_once 'db.php';

	$id = $data["id"];

	$query = "DELETE FROM info WHERE id = '$id' ";

	if(mysqli_query($conn, $query)) {
		echo '{"result" : "Data deleted successfully"}';
	}
	else {
		echo '{"result" : "Data delete failed"}';
	}

}

?>