<?php
require_once('../includes/dbconnect.php');
error_reporting(0);
session_start();

if (!$_SESSION['loggedin']) {
    header("location:../login.php");
}

// Remove from cart
if (isset($_GET['rid'])) {
    $sql3 = "DELETE FROM `usercart`WHERE pro_id='$_GET[rid]'";
    $result = mysqli_query($conn, $sql3);
    header("location: ../cart.php");
}
