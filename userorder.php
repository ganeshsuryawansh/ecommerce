<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$id = $_GET['product'];
$amount = $_SESSION['totalcartamt'];
//echo($amount);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .values{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container text-left my-5">
        <div class="row">
            <div class="col-sm-8">
                <div class="container text-left">
                    <?php
                    // user details address, email
                    $email = $_SESSION["email"];
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
                        //echo ($username);
                    ?>
                        <?php
                        //product details
                        $query = mysqli_query($conn, "SELECT * FROM products WHERE pid='$id'");
                        if ($row = mysqli_fetch_array($query)) {
                            $name = $row['pname'];
                            $price = $row['pprice'];
                            $info = $row['pdesc'];
                            $img = $row['pimg'];
                            $subcat = $row['psubcat'];
                            $_SESSION['pprice'] = $price;
                            //echo($price);
                        } else {
                            echo ("error");
                        }
                        //echo ($name);
                        ?>
                        <div class="row">
                            <div class="col card border-success userdata">
                                <div class="card-header bg-transparent border-success">
                                    <h5>DELIVERY ADDRESS</h5>
                                </div>
                                <h5><?php echo ($usern); ?>&nbsp;&nbsp;&nbsp;<?php echo ($phone); ?></h5>
                                <p><?php echo ($city); ?>.<?php echo ($subdistrict); ?>,<?php echo ($district); ?>.&nbsp;&nbsp; <?php echo ($state); ?>-<?php echo ($zipcode); ?> </p>
                                <hr>
                                <h5>PAYMENT OPTIONS</h5>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        UPI
                                                    </label>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                Choose an option
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                        PhonePe
                                                                    </label>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <button class="btn btn-warning mx-2 my-2">CONTINUE TO PHONE PAY</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                        Your UPI ID
                                                                    </label>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <input type="text" placeholder="UPI ID">
                                                                <button class="btn btn-warning mx-2 my-2">PAY <?php echo($amount); ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Credit / Debit / ATM card
                                                    </label>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <input type="text" placeholder="Enter card number">
                                                <input type="text" placeholder="CVV">
                                                <button class="btn btn-warning mx-2 my-2">PAY <?php echo($amount); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Cash on Delivery
                                                    </label>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p>OTP will send in registered Email OR Phone. <a href="#">RESEND OTP</a></p>
                                                <input type="text" placeholder="Enter OTP">
                                                <button class="btn btn-warning mx-2 my-2">CONFIRM ORDER</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col userdata my-5">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // price detail card
            //$price = $_GET['product'];
            //echo($price);
            ?>
            <div class="col-sm-4 userdata">
                <div class="card border-success mb-3" style="max-width: 18rem;">
                    <div class="card-header bg-transparent border-success">PRICE DETAILS</div>
                    <div class="card-body text-success">
                        <h5 class="card-title">Discount</h5>
                        <h5 class="text-right values">35%</h5>
                        <hr>
                        <h5 class="card-title">Delivery Charges</h5>
                        <h5 class="text-right values">FREE</h5>
                        <hr>
                        <h5 class="card-title">Total Payable</h5>
                        <h5 class="text-right values"><?php echo($amount);?></h5>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>