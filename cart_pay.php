<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
include 'razorpay-php/Razorpay.php';
include 'includes/functions.php';
error_reporting(0);
$price = 0;
$email =  $_SESSION['email'];
$pid =  $_SESSION['pid'];



if ($_GET['addorder'] && $_GET['trnid']) {
    // print_r($_GET);

    $tamt = 0;
    $queryproid = mysqli_query($conn, "SELECT * FROM usercart WHERE emailid='$email'");
    while ($row = mysqli_fetch_array($queryproid)) {
        $fid = $row['pro_id'];

        $query = mysqli_query($conn, "SELECT * FROM products WHERE pid='$fid'");
        while ($row2 = mysqli_fetch_array($query)) {
            $name = $row2['pname'];
            $price = $row2['pprice'];
            $img = $row2['pimg'];
            $img2 = $row2['p2img'];
            $info = $row2['pdesc'];
            $tamt = $tamt + $price;
            $pid = $row2['pid'];

            add_order($pid, $email, 1);
            $trnid = $_GET['trnid'];
            add_payment($pid, $email, $price, $trnid);
        }
    }
    // header("location:myorders.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>MyCart-Payment</title>

    <style>
        .pimg {
            height: 250px;
            width: 286px;
        }

        .text {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">

                <table class="table border">
                    <thead>
                        <tr>
                            <th scope="col" class="border">#</th>
                            <th scope="col" class="border">Product Name</th>
                            <th scope="col" class="border">Image</th>
                            <th scope="col" class="border">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tamt = 0;
                        $queryproid = mysqli_query($conn, "SELECT * FROM usercart WHERE emailid='$email'");
                        while ($row = mysqli_fetch_array($queryproid)) {
                            $fid = $row['pro_id'];

                            $query = mysqli_query($conn, "SELECT * FROM products WHERE pid='$fid'");
                            while ($row2 = mysqli_fetch_array($query)) {
                                $name = $row2['pname'];
                                $price = $row2['pprice'];
                                $img = $row2['pimg'];
                                $img2 = $row2['p2img'];
                                $info = $row2['pdesc'];
                                $tamt = $tamt + $price;
                                $pid = $row2['pid'];
                        ?>

                                <tr>
                                    <th class="border" scope="row"><?= ++$i ?></th>
                                    <td class="border"><?= $row2['pname'] ?></td>
                                    <td class="border"><img src="images/product/<?= $row2['pimg'] ? $row2['pimg'] : $row2['p2img'] ?>" height="100px" width="100px" alt=""></td>
                                    <td class="border">Rs. <?= $row2['pprice'] ?></td>
                                </tr>
                        <?php

                            }
                        }
                        // echo $tamt;
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="border">Total Amount: <?= number_format($tamt) ?></td>
                        </tr>

                        <input type="hidden" id="price" value="<?= $tamt ?>">
                    </tbody>
                </table>
            </div>
            <div class="col">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
                while ($row = mysqli_fetch_array($query)) {
                    $usern = $row['username'];
                    $state = $row['state'];
                    $district = $row['district'];
                    $subdistrict = $row['subdistrict'];
                    $city = $row['city'];
                    $zipcode = $row['zipcode'];
                    $phone = $row['phone'];
                    $alterphone = $row['alphone'];
                ?>
                    <div class="card p-2">
                        <h4>Payer Details</h4>
                        <hr>
                        <p><b>Name: </b><?= $usern ?></p>
                        <p><b>Email: </b><?= $email ?></p>
                        <p><b>Phone No: </b> <?= $phone . " / " . $alterphone ?></p>
                        <p><b>Address: </b> <?= $city . " " . $subdistrict . " " . $district . " " . $state ?></p>
                        <p><b>ZipCode: </b><?= $zipcode ?></p>
                        <button class="btn btn-primary" onclick="pay()">Pay Now</button>

                        <input type="hidden" id="name" value="<?= $usern ?>">
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>










    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function pay() {
            let name = document.getElementById('name').value;
            let price = document.getElementById('price').value;

            // console.log(name);
            // console.log(price);

            razorpaySubmit(price, price, name);
        }

        function razorpaySubmit(totfees, amount, desc) {
            var options = {
                key: "rzp_test_ahDT9fgyaUATpk",
                amount: amount * 100,
                currency: "INR",
                name: "MyCart",
                description: desc,
                // image: "",
                handler: function(response) {
                    // alert("Payment successful: " + response.razorpay_payment_id);
                    window.location.href = 'http://localhost:8080/ecommerce/cart_pay.php?addorder=1&trnid=' + response.razorpay_payment_id;
                },
                prefill: {
                    name: desc,
                    email: "<?= $email ?>",
                    contact: "<?= $phone ?>"
                }
            };
            var razorpay_instance = new Razorpay(options);
            razorpay_instance.open();
        }
    </script>
    <?= $this->include('./includes/footer.php') ?>
</body>

</html>