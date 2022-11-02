<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include_once './../../api/createToken.php';
include 'config.php';

$data = file_get_contents("php://input");

if ($data) {
	$json_data = json_decode($data);

	$email = $json_data->email;
	$password = $json_data->password;

	if (strlen($email) == 0) {
		echo json_encode([
			"status" => 0,
			"message" => "email is empty"
		]);
		return 0;
	}
	if (strlen($password) < 6) {
		echo json_encode([
			"status" => 0,
			"message" => "Password shoud be more than 6 characters"
		]);
		return 0;
	}

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		// Return the number of rows in result set
		$rowcount = mysqli_num_rows($result);

		if ($rowcount > 0) {
			$row = mysqli_fetch_assoc($result);
			$id = $row['id'];

			echo json_encode([
				"status" => 1,
				"message" => "login successfully",
				"id" => $id
			]);
		} else {
			echo json_encode([
				"status" => 0,
				"message" => "Email or Password is Wrong"
			]);
		}
	} else {
		echo json_encode([
			"status" => 0,
			"message" => "Somthing Was Wrong"
		]);
	}
} else {
	echo json_encode(["status" => 0, "message" => "no data sended"]);
}
$conn->close();
