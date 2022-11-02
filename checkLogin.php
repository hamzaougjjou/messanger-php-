
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include 'config.php';

$data = file_get_contents("php://input");

if ($data) {

    $json_data = json_decode($data);
    $userId = $json_data->id;

    $sql = "SELECT * FROM users WHERE id='$userId';";
    $result = mysqli_query($conn, $sql);
    // $rowcount = mysqli_num_rows($result);
    if ( $result -> num_rows > 0) {
        echo json_encode(["status" => 1, "message" => "user is loged in"]);
    } else {
        echo json_encode(["status" => -1, "message" => "user is not loged in"]);
    }
} else {
    echo json_encode(["status" => 0, "message" => "no data send"]);
}
