
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

    $message = $json_data->message;
    $senderId = $json_data->senderId;
    $reciverId = $json_data->reciverId;

    if (strlen(ltrim($message)) != 0) {
        $sql = "INSERT INTO messages (content, reciverId, senderId)
                        VALUES ('$message', '$reciverId', '$senderId')";
                        
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo json_encode(["status" => 1, "message" => "message send"]);
        } else {
            echo json_encode(["status" => 0, "message" => "somthing was wrong"]);
        }
    } else {
        echo json_encode(["status" => -2, "message" => "message in empty"]);
    }

} else {
    echo json_encode(["status" => 0, "message" => "no data sended"]);
}

$conn->close();
