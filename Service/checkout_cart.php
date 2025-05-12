<?php
require_once('../includes/dbconnect.php');
require_once('../includes/functions.php');
error_reporting(0);
session_start();

if (!$_SESSION['loggedin']) {
    header("location:../login.php");
    exit(); // Always exit after header redirect
}

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$item_id = $input['item_id'] ?? '';
$item_price = $input['item_price'] ?? '';
$user_email = $input['user_email'] ?? '';
$razorpay_payment_id = $input['razorpay_payment_id'] ?? '';

// echo json_encode([
//     'item_id' => $item_id,
//     'item_price' => $item_price,
//     'user_email' => $user_email,
//     'razorpay_payment_id' => $razorpay_payment_id
// ]);

add_order($item_id, $user_email, 1);

add_payment($item_id, $user_email, $item_price, $razorpay_payment_id);
