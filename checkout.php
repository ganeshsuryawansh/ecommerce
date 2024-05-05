<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
error_reporting(E_ALL ^ E_NOTICE);

$pid = $_GET['product'];
//session_start();
//echo ($pid);


$query = mysqli_query($conn, "SELECT * FROM products WHERE pid='$pid'");

if ($row = mysqli_fetch_array($query)) {
    $name = $row['pname'];
    $price = $row['pprice'];
    $info = $row['pdesc'];
    $img = $row['pimg'];
    $subcat = $row['psubcat'];

    //echo ($price);
} else if ($row == 0) {
    //header('location:index.php');
    echo ("data not found...");
    exit();
} else {
    echo ("Error product id not found...");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .pimg {
            height: 250px;
            width: 286px;
        }

        .col1 {
            border: 1px solid black;
            border-radius: 10px 10px 10px 10px;
            background-color: #ffe6e6;
        }

        .crd1 {
            background-color: pink;
        }

        .text {
            text-decoration: none;
            color: black;
        }

        .btn {
            width: 200px;
            height: 50px;
        }
    </style>

</head>

<body>
    <div class="container text-left my-5">
        <div class="row">
            <h3>User Details To Deliver Product</h3>
            <div class="col col1 mx-2">
                <form action="pay.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">First name</label>
                        <input type="text" name="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">last name</label>
                        <input type="text" name="lname" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mobile</label>
                        <input type="number" name="mobile" class="form-control" id="exampleInputPassword1" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Note</label>
                        <input type="textarea" name="note" class="form-control" id="exampleInputPassword1" required>
                    </div>

                    <input type="radio" id="vehicle1" name="check" value="Bike" required>
                    <label for="exampleInputPassword1" class="form-label">Remember me!</label><br><br>

                        <input type="submit" name="submit">
                  
                    <?php
                    /*
                    <a href="pay.php?proid=<?php echo ($pid); ?>" class="btn btn-warning text">PLACE ORDER</a>
*/
                    ?>
                    <?php

                    //$_SESSION['check'] = $_POST['check'];

                    session_start();
                    $_SESSION['fname'] = $_POST['fname'];
                    $_SESSION['lname'] = $_POST['lname'];
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['mobile'] = $_POST['mobile'];
                    $_SESSION['address'] = $_POST['address'];
                    $_SESSION['note'] = $_POST['note'];
                    $_SESSION['pid'] = $pid;

                    echo ($_SESSION['fname']);

                    if (isset($_POST['submit'])) {

                        exit(header("Location: pay.php"));
                        print($_SESSION['email']);
                        //echo($_SESSION['email']);

                        if (isset($_POST['email'])) {
                            //header("location: pay.php");
                           // exit(header("Location: pay.php"));
                        }
                    }

                    ?>
                </form>
            </div>
            <div class="col col1 mx-2 text-left">
                <div class="card my-5 mx-5 crd1" id="<?php echo ($pid) ?>" style="width: 18rem; ">
                    <a href="product.php?product=<?php echo ($row['pid']); ?>" class="text">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>