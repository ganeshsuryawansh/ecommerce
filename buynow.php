<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
error_reporting(0);
$gid = $_GET['product'];

$_SESSION['loggedin'];
$_SESSION['email'];
if (!$_SESSION['loggedin']) {
    header("location:login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .flpimg {
            height: 250px;
            width: 250px;
        }
    </style>
</head>

<body>
    <div class="container text-left my-5">
        <div class="row">
            <div class="col-4">

                <?php
                $query = mysqli_query($conn, "SELECT * FROM products WHERE pid='$gid'");
                while ($row = mysqli_fetch_array($query)) {
                    $name = $row['pname'];
                    $price = $row['pprice'];
                    $info = $row['pdesc'];
                    $img = $row['pimg'];
                    $subcat = $row['psubcat'];
                    $_SESSION['pprice'] = $price;

                    $_SESSION['pid'] = $gid;

                ?>

                    <div class="card my-2 " id="<?php echo ($pid) ?>" style="width: 18rem; ">
                        <a style="text-decoration: none;color:black;" href="product.php?product=<?php echo ($gid); ?>" class="text">
                            <img src="images/product/<?php echo ($img); ?>" class="card-img-top flpimg" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo ($name); ?></h5>
                                <p class="card-text">₹<?php echo ($price); ?>
                                <p class="distag">30% off</p><i>Free delivery</i></p>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>

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

                        <div class="row">
                            <div class="col card border-success userdata">
                                <div class="card-header bg-transparent border-success">
                                    <h5>DELIVERY ADDRESS</h5>
                                </div>
                                <h5><?php echo ($usern); ?>&nbsp;&nbsp;&nbsp;<?php echo ($phone); ?></h5>
                                <p><?php echo ($city); ?>.<?php echo ($subdistrict); ?>,<?php echo ($district); ?>.&nbsp;&nbsp; <?php echo ($state); ?>-<?php echo ($zipcode); ?> </p>
                                <hr>

                                <a href="pay2.php" class="btn btn-warning my-3">PLACE ORDER</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>