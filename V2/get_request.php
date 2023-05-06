<?php
function get_counter($counter_type, $sort_direction, $connect){
    if (($counter_type === 'event' or $counter_type === 'ip' or $counter_type === 'status') and ($sort_direction == 'ASC' or $sort_direction == 'DESC' or $sort_direction == 'none' )) {

        if ($counter_type === 'event') {
            $counter_type = 'event_name';
        }elseif ($counter_type === 'ip')  {
            $counter_type = 'id_user';
        } elseif ($counter_type === 'status') {
            $counter_type = 'user_status';
        }

        if ($sort_direction == 'ASC') {
            $sel = mysqli_query($connect, "SELECT COUNT(`$counter_type`) AS 'quantity',`$counter_type`FROM `Event` GROUP BY `$counter_type` ORDER BY `$counter_type`  ASC");
        } elseif ($sort_direction == 'DESC') {
            $sel = mysqli_query($connect, "SELECT COUNT(`$counter_type`) AS 'quantity',`$counter_type`FROM `Event` GROUP BY `$counter_type` ORDER BY `$counter_type`  DESC");
        } else {
            $sel = mysqli_query($connect, "SELECT COUNT(`$counter_type`) AS 'quantity',`$counter_type`FROM `Event` GROUP BY `$counter_type` ");
        }

        if (mysqli_num_rows($sel) === 0) {
            Element_not_found();
        } else {
            $sel_list = [];
            while ($se = mysqli_fetch_assoc($sel)) {
                $sel_list[] = $se;
            }
            http_response_code(200);
            $res = [
                "status" => true,
                "result" => $sel_list
            ];
            echo json_encode($res);
        }

} else {
        bad_request();
  }
}

function bad_request(){
    http_response_code(400);
    $res = [
        "status" => false,
        "message" => "Bad request"
    ];
    echo json_encode($res);
}
function Element_not_found(){
    http_response_code(404);
    $res = [
        "status" => false,
        "message" => "Element not found"
    ];
    echo json_encode($res);
}
?>
