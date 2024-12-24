<?php

header("Access-Control-Allow-Methods: POST, PATCH");
header("Content-Type: application/json");

include("../config/database.php");

$c1 = new Config();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $product_id = $_POST['id'];
    $p_name = $_POST['product_name'];
    $product_price = $_POST['price'];

    if (!empty($product_id) && !empty($p_name) && !empty($product_price)) {
        $result = $c1->addProduct($product_id, $p_name, $product_price);
        $response['message'] = $result ? 'Product added successfully!' : 'Failed to add Product!';
    } else {
        $response['error'] = 'Please fill all required fields!';
    }
} elseif ($_SERVER["REQUEST_METHOD"] == 'PATCH') {
    $inputData = file_get_contents("php://input");
    parse_str($inputData, $parsedData);
    $product_id = $parsedData['id'];
    $p_name = $parsedData['product_name'];
    $product_price = $parsedData['price'];

    if (!empty($product_id) && !empty($p_name) && !empty($product_price)) {
        $result = $c1->updateProduct($product_id, $p_name, $product_price);
        $response['message'] = $result ? 'Product updated successfully!' : 'Failed to update Product!';
    } else {
        $response['error'] = 'Please fill all required fields!';
    }
} else {
    $response['error'] = 'Only POST and PATCH methods are allowed!';
}

echo json_encode($response);