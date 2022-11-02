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
    $searchText = $json_data->text;

    $sql = "SELECT DISTINCT  reciverId,senderId FROM messages
        WHERE reciverId=$userId OR senderId=$userId";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Return the number of rows in result set
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0) {
            $disdiscussions = [];
            while ($row = mysqli_fetch_assoc($result)) {
                # code...
                // echo json_encode($row);
                if ($row['reciverId'] == $userId) {
                    # code...
                    array_push($disdiscussions, $row['senderId']);
                } else {
                    array_push($disdiscussions, $row['reciverId']);
                }
            }
            // print_r($disdiscussions);
            $disdiscussions = array_unique($disdiscussions);
            // print_r($disdiscussions);

            // get user information [disdiscussions]
            $arr = implode(',', $disdiscussions);
            $getUserInfoQuery = "SELECT id,username,image FROM users WHERE ( id IN ($arr) AND username LIKE '%$searchText%' );";
            $getUserInfoResult = mysqli_query($conn, $getUserInfoQuery);
            if ($getUserInfoResult) {

                $disdiscussions = [];
                while ($row2 = mysqli_fetch_assoc($getUserInfoResult)) {
                    if ($row2['image'] != null) {
                        # code...
                        $img = "data:image/jpg;charset=utf8;base64," . base64_encode($row2['image']);
                    } else {
                        $img = 0;
                    }
                    
                    array_push($disdiscussions, [$row2['id'], $row2['username'], $img]);
                }
                echo json_encode(["status" => 1, "data" => $disdiscussions, "message" => "discussions exist"]);
            } else {
                echo "errror";
            }
        } else {
            echo json_encode(["status" => -1, "message" => "no discussions"]);
        }
    } else {
    }
} else {
    echo json_encode(["status" => 0, "message" => "no data sended"]);
}

$conn->close();
