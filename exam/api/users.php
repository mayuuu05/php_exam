<?php

header("Access-Control-Allow-Methods: POST, GET");
header("Content-Type: application/json");

include("../config/database.php");

$c1 = new Config();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cusEmail = $_POST['email'];
    $phone = $_POST['phone'];

    if (!empty($name) && !empty($cusEmail) && !empty($phone)) {
        $result = $c1->addCoustomer($name, $cusEmail, $phone);
        $response['message'] = $result ? 'Customer added successfully!' : 'Failed to add Customer!';
    } else {
        $response['error'] = 'Please fill all required fields!';
    }
} elseif ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $result = $c1->fetchCustomer();
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $response = $data ? $data : ['msg' => 'No Customer found!'];
} else {
    $response['error'] = 'Only POST and GET methods are allowed!';
}

echo json_encode($response);