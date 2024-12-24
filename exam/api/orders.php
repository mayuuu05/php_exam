<?php

header("Access-Control-Allow-Methods: POST, DELETE");
header("Content-Type: application/json");

include("../config/database.php");

$c1 = new Config();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $order_id = $_POST['id'];
    $order_date = $_POST['order_date'];
    $order_status = $_POST['status'];

    if (!empty($order_id) && !empty($order_date) && !empty($order_status)) {
        $result = $c1->addOrder($order_id, $order_date, $order_status);
        $response['message'] = $result ? 'Order added successfully!' : 'Failed to add Orderd!';
    } else {
        $response['error'] = 'Please fill all required fields!';
    }
} elseif ($_SERVER["REQUEST_METHOD"] == 'DELETE') {
    $inputData = file_get_contents("php://input");
    parse_str($inputData, $parsedData);
    $order_id = $parsedData['id'];

    if (!empty($order_id)) {
        $result = $c1->deleteOrder($order_id);
        $response['message'] = $result ? 'Order deleted successfully!' : 'Failed to delete Order!';
    } else {
        $response['error'] = 'Please fill the enrollment ID!';
    }
} else {
    $response['error'] = 'Only POST and DELETE methods are allowed!';
}


echo json_encode($response);