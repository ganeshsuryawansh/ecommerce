<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
// include 'razorpay-php/Razorpay.php';
include 'includes/functions.php';

error_reporting(0);

$email =  $_SESSION['email'];

if (!$email) {
    header("location:login.php");
}

if ($_GET['did']) {

    $did = $_GET['did'];
    $tk = $did . "_" . $email;

    $qr = "DELETE FROM myorders WHERE token= '$tk'";

    mysqli_query($conn, $qr);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCart - MyOrders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <h4>MyOrders</h4>
                <table class="table table-responsive border">
                    <thead>
                        <tr>
                            <th class="border" scope="col">#</th>
                            <th class="border" scope="col-3">Product Name</th>
                            <th class="border" scope="col">Product Image</th>
                            <th class="border" scope="col">Order Date</th>
                            <th class="border" scope="col">Receved Date</th>
                            <th class="border" scope="col">Payment Status</th>
                            <th class="border" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $qr = "SELECT * FROM myorders WHERE email_id='$email'";
                        $res = mysqli_query($conn, $qr);

                        while ($row = mysqli_fetch_assoc($res)) {
                            $pid = $row['productid'];
                            $qr1 = "SELECT * FROM products WHERE pid=$pid";
                            $result = mysqli_query($conn, $qr1);
                            // $count = 0;
                            while ($row2 = mysqli_fetch_assoc($result)) {

                                if (count($row2) > 0) {
                                    // print_r($row2);
                        ?>
                                    <tr>
                                        <th scope="row "><?= ++$count ?></th>
                                        <td class="border col-3">
                                            <?= $row2['pname'] ?>
                                        </td>
                                        <td class="border">
                                            <img src="images/product/<?= $row2['pimg'] ? $row2['pimg'] : $row2['p2img'] ?>" height="100px" width="100px">
                                        </td>
                                        <td class="border"><?= $row['date2'] ?></td>
                                        <td class="border">
                                            <?= date_more_5_day($row['date2']) ?>
                                        </td>
                                        <td>
                                            Completed!
                                            <hr>
                                            <p style="font-size: 12px;">Paid Rs. <?= $row2['pprice'] ?></p>
                                        </td>
                                        <td class="border">
                                            <a href="myorders.php?did=<?= $pid ?>" class="btn btn-danger">Cancel Order</a>
                                            <br>
                                            <br>
                                            <button class="btn btn-success">Change Date</button>
                                        </td>
                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                        <th scope="row ">No Order Available</th>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>