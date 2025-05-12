<?php
require_once('../includes/dbconnect.php');
require_once('../includes/functions.php');
error_reporting(0);
session_start();

if (!$_SESSION['loggedin']) {
    http_response_code(401); // Unauthorized
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit();
}

header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

$item_id = $input['item_id'] ?? '';
$item_price = $input['item_price'] ?? '';
$user_email = $input['user_email'] ?? '';
$razorpay_payment_id = $input['razorpay_payment_id'] ?? '';

if (!$item_id || !$item_price || !$user_email || !$razorpay_payment_id) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
    exit();
}

$order_added = add_order($item_id, $user_email, 1);
$payment_added = add_payment($item_id, $user_email, $item_price, $razorpay_payment_id);

if ($order_added && $payment_added) {
    http_response_code(200); // OK
    echo json_encode(['status' => 'success', 'message' => 'Order and payment recorded successfully.']);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'message' => 'Failed to process order or payment.']);
}
