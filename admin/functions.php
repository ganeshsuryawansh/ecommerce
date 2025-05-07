<?php

$conn = mysqli_connect("localhost", "root", "", "ecommerce");

function total_sales()
{
    global $conn;
    $qr = "SELECT SUM(price) AS total_sum FROM payments";

    $result = mysqli_query($conn, $qr);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total_sum = $row['total_sum'];
        echo $total_sum;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function total_product()
{
    global $conn;
    $qr = "SELECT * FROM products";
    $result = mysqli_query($conn, $qr);

    if ($result) {
        $row = mysqli_num_rows($result);
        echo ($row);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


function total_users()
{
    global $conn;
    $qr = "SELECT * FROM users";
    $result = mysqli_query($conn, $qr);

    if ($result) {
        $row = mysqli_num_rows($result);
        echo ($row);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function total_orders()
{
    global $conn;
    $qr = "SELECT * FROM myorders";
    $result = mysqli_query($conn, $qr);

    if ($result) {
        $row = mysqli_num_rows($result);
        echo ($row);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function today_order()
{
    global $conn;
    $td = date('Y-m-d');

    $qr = "SELECT * FROM myorders WHERE date2='$td'";
    $result = mysqli_query($conn, $qr);

    if ($result) {
        $row = mysqli_num_rows($result);
        echo ($row);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
