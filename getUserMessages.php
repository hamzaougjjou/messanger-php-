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
    $reciverId = $json_data->reciverId;
    // check if user exist 
    $query = "SELECT * FROM users WHERE id=$reciverId";
    $r = mysqli_query($conn, $query);
    $rowcount = mysqli_num_rows($r);
    if ($rowcount > 0 && ($reciverId!=$userId) ) {
        # code...
        $sql = "SELECT * FROM messages WHERE 
                               (reciverId=$userId AND senderId=$reciverId) 
                            OR (reciverId=$reciverId AND senderId=$userId)";
                            
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Return the number of rows in result set
            $row = mysqli_fetch_all($result);

            $sql2 = "SELECT id,username,image FROM users WHERE id=$reciverId";
            $result2 = mysqli_query($conn, $sql2);

            if ($result2) {

                $row2 = mysqli_fetch_assoc($result2);
                if ($row2['image'] != null) {
                    # code...
                    $img = "data:image/jpg;charset=utf8;base64," . base64_encode($row2['image']);
                } else {
                    $img = 0;
                }

                $data = [
                    "messages" => $row,
                    "user" =>  [$row2['id'], $row2['username'], $img]
                ];
                echo json_encode(["status" => 1, "data" => $data, "message" => "discussions exist"]);
            }
        } else {
            echo json_encode(["status" => -1, "message" => "no discussions"]);
        }
    } else {
        echo json_encode(["status" => -2, "message" => "user not exists"]);
    }
} else {
    echo json_encode(["status" => 0, "message" => "no data sended"]);
}

$conn->close();
