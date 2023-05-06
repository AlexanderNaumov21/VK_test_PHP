<?php

function add_event($connect, $data, $serv){

    $eventName = $data['event_name'];
    $userStatus = $data['user_status'];
    $eventDate = date('Y-m-d');
    $ip = $serv['REMOTE_ADDR'];


    if ($userStatus != 0 and $userStatus != 1 ) {
        http_response_code(400);
        $res = [
            "status" => false,
            "message" => "Bad request"
        ];
        echo json_encode($res);
        exit();
    }

    mysqli_query($connect, "INSERT INTO `Event` (`id`, `event_name`, `user_status`, `id_user`, `event_date`)
                                    VALUES (NULL, '$eventName', '$userStatus', '$ip', '$eventDate')");

    http_response_code(201);
    $res = [
    "status" => true,
    "event_id" => mysqli_insert_id($connect)
    ];
    echo json_encode($res);
}

?>