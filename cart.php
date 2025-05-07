<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
error_reporting(0);
session_start();
$email = $_SESSION['email'];

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        .img {
            height: 200px;
            width: 200px;
        }

        .procrd {
            width: 550px;
            border: 1px solid black;
        }

        .maincol {
            width: 50%;
        }

        body {
            background-color: #6f42c1;
        }
    </style>
</head>

<body>

    <div class="container text-center my-5">
        <div class="row">
            <div class="col-8">
                <div>
                    <?php

                    $qr = "SELECT products.*, usercart.*
                    FROM usercart
                    INNER JOIN products ON usercart.pro_id = products.pid
                    WHERE usercart.emailid = '$email'";

                    $query = mysqli_query($conn, $qr);

                    $rw = mysqli_num_rows($query);

                    if ($rw > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            $tamt;
                            $name = $row['pname'];
                            $price = $row['pprice'];
                            $img = $row['pimg'];
                            $img2 = $row['p2img'];
                            $info = $row['pdesc'];
                            $tamt = $tamt + $price;
                            $id = $row['pid'];
                    ?>

                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/product/<?= $img ? $img : $img2; ?>" class="img-fluid rounded-start" height="200" width="150">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-start text-black"> <a style="text-decoration: none; color:black;" href="product.php?product=<?= $id ?>"><?= $name; ?></a></h5>
                                            <p class="text-start">RS. <?= $price ?></p>
                                            <p class="text-start">
                                                <a href="Service/remove_cart.php?rid=<?= $id ?>" class="btn btn-warning">Remove From Cart</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    } else {
                        echo "<h4 class='text-center text-light'>No items in cart!</h4>";
                    }
                    ?>
                </div>
            </div>

            <div class="col-4">
                <div class="card border-warning mb-3 procrd bg-$pink" style="max-width: 18rem;">
                    <div class="card-header ">PRICE DETAILS</div>
                    <div class="card-body">
                        <h5 class="card-title">Price(all items)</h5>
                        <hr>
                        <h5>Delivery Charges: ₹ 00</h5>
                        <hr>
                        <h5><b>
                                Total Amount: ₹ <?php echo ($tamt); ?>
                            </b></h5>
                        <a href="cart_pay.php" class="btn btn-warning">PLACE ORDER</a>

                        <?php
                        $_SESSION["totalcartamt"] = $tamt;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>