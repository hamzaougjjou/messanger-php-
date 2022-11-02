<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include 'config.php';
// data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); 
$data = file_get_contents("php://input");

if ($data) {
    $json_data = json_decode($data);
    $userId = $json_data->id;
    // $userId = 27;
    // check if user exist 
    $sql = "SELECT id,username,email,image FROM users WHERE id=$userId";
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount > 0) {
        # code...
        // $row = mysqli_fetch_all($result);
        $user = [];
        $row2 = mysqli_fetch_assoc($result);
        if ($row2['image'] != null) {
            # code...
            $img = "data:image/jpg;charset=utf8;base64," . base64_encode($row2['image']);
        } else {
            $img = 0;
        }
        array_push($user, $row2['id']);
        array_push($user, $row2['username']);
        array_push($user, $row2['email']);
        array_push($user, $img);

        // print_r($users);
        echo json_encode(["status" => 1, "data" => $user, "message" => "users exist"]);
    } else {
        echo json_encode(["status" => -1, "message" => "user not exists"]);
    }
} else {
    echo json_encode(["status" => 0, "message" => "no data sended"]);
}

$conn->close();
