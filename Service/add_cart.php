<?php
require_once('../includes/dbconnect.php');
error_reporting(0);
session_start();

if (!$_SESSION['loggedin']) {
    header("location:../login.php");
}

$id = $_GET['id'];
$email = $_SESSION['email'];
$token = $_GET['id'] . $_SESSION['email'];

// Add to cart
if (isset($id)) {

    // check if product already exists in cart
    $sql1 = "SELECT * FROM `usercart` WHERE pro_id='$id' AND emailid='$email'"; 

    $result1 = mysqli_query($conn, $sql1);
    $num = mysqli_num_rows($result1);   

    if ($num > 0) {
        header("location: ../cart.php");
    } else {
        // insert into cart
        $sql2 = "INSERT INTO `usercart` (`pro_id`,`emailid`,`token`) VALUES ('$id','$email','$token')";
        $result = mysqli_query($conn, $sql2);
    }

    if($result) {
        header("location: ../cart.php");
    } else {
        header("location: ../cart.php");
    }
}

