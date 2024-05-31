<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
include 'includes/functions.php';
error_reporting(0);

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCart-Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row py-5">
            <div class="col">
                <?php
                $qr = "SELECT * FROM users WHERE email='$email'";
                $result = mysqli_query($conn, $qr);

                while ($row = mysqli_fetch_array($result)) {
                    // print_r($row);
                ?>
                    <div class="card p-2">
                        <p><b>Name: </b> <?= $row['username'] ?></p>
                        <p><b>Email: </b> <?= $row['email'] ?></p>
                        <p><b>Phone: </b> <?= $row['phone'] . " / " . $row['alphone'] ?></p>
                        <p><b>Address: </b> <?= $row['city'] . ", " . $row['subdistrict'] . ", " . $row['district'] . ", " . $row['state'] . "." ?></p>
                        <p><b>Zipcode: </b> <?= $row['zipcode'] ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col">
                <a href="myorders.php" class="btn btn-primary">MyOrders</a>
            </div>
        </div>
    </div>

</body>

</html>