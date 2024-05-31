<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
include 'razorpay-php/Razorpay.php';
error_reporting(0);

$email = $_GET['uid'];
$pid = $_SESSION['pid'];
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .paydet {
            border: 1px solid black;
            background-color: #ffe6e6;
        }

        .pimg {
            height: 250px;
            width: 286px;
        }

        .btn {
            height: 50px;
        }

        .text {
            text-decoration: none;
            color: black;
        }

        form:hover {
            box-shadow: 0px red;
        }
    </style>

</head>

<body>
    <div class="container my-5">
        <div class="row">
            <h3>Payer details</h3>
            <div class="col paydet">
                <?php
                include("gateway-config.php");

                use Razorpay\Api\Api;

                $api = new Api($keyId, $keySecret);

                
                $query = mysqli_query($conn, "SELECT * FROM products WHERE pid='$pid'");
                if ($row = mysqli_fetch_array($query)) {
                    $name = $row['pname'];
                    $price = $row['pprice'];
                    $info = $row['pdesc'];
                    $img = $row['pimg'];
                    $subcat = $row['psubcat'];

                    $_SESSION['proprice'] = $price;

                    //echo ($price);
                    $webtitle = "MyCart";
                    $displayCurrency = 'INR';
                    $imgeurl = 'https://w7.pngwing.com/pngs/384/470/png-transparent-retail-computer-icons-e-commerce-sales-mega-offer-miscellaneous-service-logo.png';

                    $orderData = [
                        'receipt'         => 3456,
                        'amount'          => $price * 100, // 2000 rupees in paise
                        'currency'        => 'INR',
                        'payment_capture' => 1 // auto capture
                    ];

                    $razorpayOrder = $api->order->create($orderData);

                    $razorpayOrderId = $razorpayOrder['id'];

                    $_SESSION['razorpay_order_id'] = $razorpayOrderId;

                    $displayAmount = $amount = $orderData['amount'];

                    if ($displayCurrency !== 'INR') {
                        $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                        $exchange = json_decode(file_get_contents($url), true);

                        $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
                    }

                    $data = [
                        "key"               => $keyId,
                        "amount"            => $amount,
                        "name"              => $webtitle,
                        "description"       => $webtitle,
                        "image"             => $imgeurl,
                        "prefill"           => [
                            "name"              => $firstname . " " . $lastname,
                            "email"             => $email,
                            "contact"           => $mobile,
                        ],
                        "notes"             => [
                            "address"           => $address,
                            "merchant_order_id" => "12312321",
                        ],
                        "theme"             => [
                            "color"             => "#F37254"
                        ],
                        "order_id"          => $razorpayOrderId,
                    ];


                    if ($displayCurrency !== 'INR') {
                        $data['display_currency']  = $displayCurrency;
                        $data['display_amount']    = $displayAmount;
                    }
                    $json = json_encode($data);

                    //echo($price);
                } else {
                    echo ("Error: Data not fetch...");
                }
                ?>

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


                    $_SESSION['name'] =  $usern;
                    $_SESSION['state'] = $state;
                    $_SESSION['district'] = $district;
                    $_SESSION['subdistrict'] =  $subdistrict;
                    $_SESSION['city'] =  $city;
                    $_SESSION['zipcode'] = $zipcode;
                    $_SESSION['phone'] = $phone;
                }

                ?>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <h5>Name:</h5>
                    </label>
                    <?php echo ($usern); ?>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <h5>Email:</h5>
                    </label>
                    <?php echo ($email); ?>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <h5>Mobile:</h5>
                    </label>
                    <?php echo ($phone); ?>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <h5>Address:</h5>
                    </label>
                    <?php echo ($city . " " . $subdistrict . " " . $district . " " . $state . "-" . $zipcode); ?>
                </div>


                <!-- <a class="btn btn-warning py-2 by-5" href="ordertrack.php?pid=<?php echo ($pid); ?>">Cash on Delivery
                </a><br> -->
                <br>
                <form action="verify.php ">
                    <script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_KieuS2HPO6ps21" async> </script>
                </form>


            </div>
            <div class="col">
                <div class="card my-2 mx-2 crd1" id="<?php echo ($pid) ?>" style="width: 18rem; ">
                    <a href="product.php?product=<?php echo ($pid); ?>" class="text">
                        <img src="images/product/<?php echo ($img); ?>" class="card-img-top pimg" alt="...">
                        <div class="card-body cardbody">
                            <h5 class="card-title"><?php echo ($name); ?></h5>
                            <h3 class="card-text">₹<?php echo ($price); ?></h3>
                            <p class="distag">30% off</p><br>
                            <i>Free delivery</i><br>
                            <br>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>