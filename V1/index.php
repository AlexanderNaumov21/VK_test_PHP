<?php

header('Content-type: json/application');
require 'connect.php';
require 'post_request.php';
require 'get_request.php';


$method = $_SERVER['REQUEST_METHOD'];
$q = $_GET['q'];
$params = explode('/', $q);
$api = $params[0];
if ($api === 'api') {
    if ($method === 'GET') {
        #print_r($_GET);
        get_counter($_GET['counter_type'],$_GET['counter_value'],$_GET['sort_type'] , $_GET['sort_direction'], $connect);

    } elseif ($method === 'POST') {
        add_event($connect, $_POST, $_SERVER);
    }
}

?>
