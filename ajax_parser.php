<?php
// ajax_parser.php -  Tue Mar 12 12:35:11 CDT 2024
// 
require_once "functions.php";

// preset major parameters in case something weird happens
$id = 'something wrong';
$data = [];
$response = 'Nothing happened';

if(empty($_POST)){
    echo json_encode("No POST data");
    die;
} else {
    
    $action = $_POST['action'];
    if( array_key_exists('data', $_POST) ){
        $data = (array)json_decode($_POST['data']);
    }
    
}

switch ($action) {
    case 'get_random_text':
        $response = get_random_text();
        break;
    case 'set_quote';
        $response = set_quote($data);
        break;
}

echo json_encode($response);
die;

