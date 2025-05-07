<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Something went Wrong!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>

<?php


require_once('../includes/dbconnect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // echo 'hhhhhhhhhhhhhhhhhhhhhh';
    // echo '<pre>';
    // print_r($_POST);
    // exit;

    $username = $_POST["username"];
    $state = $_POST["state"];
    $district = $_POST["district"];
    $subdistrict = $_POST["subdistrict"];
    $city = $_POST["city"];
    $zipcode = $_POST["zipcode"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO `users` (`username`, `state`, `district`, `subdistrict`, `city`, `zipcode`, `phone`, `email`, `password`, `dt`) VALUES ('$username', '$state', '$district', '$subdistrict', '$city', '$zipcode',  '$phone', '$email', '$password', current_timestamp())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: ../login.php");
    } else {
        echo '
        <div class="container p-5 my-5">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> Something went wrong. Please try again later.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>
        ';
        // header("location: ../signup.php");
        // echo '<script>window.history.back();</script>';

        echo "<div class='container p-5 my-5'><a href='../signup.php' class='btn btn-primary'>Go Back</a>";
    }
}
?>