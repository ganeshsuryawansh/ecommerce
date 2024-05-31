<?php
$showAlert = false;
$sql = false;
include 'includes/dbconnect.php';
include 'includes/nav.php';
error_reporting(0);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyCart-Signup</title>
    <style>
        .offerimg {
            height: 500px;
            width: 450px;
            margin-right: 255px;
        }
    </style>

</head>

<body>

    <div class="container cont my-5 ">

        <div class="container ">
            <h4 class=" text-center my-5">Start Your Shopping Journy!</h4>

            <div class="row">
                <div class="col-md-6">
                    <form action="signup.php" method="POST">

                        <div class="row border border-dark">
                            <div class="col">
                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="text" class="form-control" placeholder="Name" name="username" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="text" class="form-control" placeholder="Email" name="email" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="text" class="form-control" placeholder="City" name="city" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="text" class="form-control" placeholder="Subdistrict" name="subdistrict" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="text" class="form-control" placeholder="District" name="district" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="text" class="form-control" placeholder="State" name="state" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col">


                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="number" class="form-control" placeholder="ZipCode" name="zipcode" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="number" class="form-control" placeholder="Phone" name="phone" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="number" class="form-control" placeholder="Alternate Phone" name="alphone" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="my-3">
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required>
                                    </div>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary my-2 col-12">Submit</button><br>
                                <p style="font-size: 12px;">Already Signup <a href="login.php">Login </a>Here !</p>
                            </div>
                        </div>








                    </form>
                </div>
                <div class="col-6 d-none d-md-block">

                    <div class="">
                        <img src="images/product/megasale.img.png" class="offerimg" alt="offer">
                    </div>

                </div>
            </div>
        </div>


        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $state = $_POST["state"];
            $district = $_POST["district"];
            $subdistrict = $_POST["subdistrict"];
            $city = $_POST["city"];
            $zipcode = $_POST["zipcode"];
            $phone = $_POST["phone"];
            $alphone = $_POST["alphone"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];

            $exists = false;

            $sql = mysqli_query($conn,  "SELECT * FROM users WHERE email = '$email'");

            while ($row = mysqli_fetch_array($sql)) {
                $demail = $row['email'];
                $name = $row['username'];
                //echo($name);


                if ($demail == $email) {
                    $exists = true;
                    //echo ("email exists");
                }
            }




            //echo($exists== true);
            $result = mysqli_query($conn, '$sql');
            //$num = mysqli_num_rows($result);
            if ($exists == 1) {
        ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Email Already exists in database..</strong>Tray another email...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>
            <?php

            } else if (($password == $cpassword)) {
                $sql = "INSERT INTO `users` (`username`, `state`, `district`, `subdistrict`, `city`, `zipcode`, `phone`, `alphone`, `email`, `password`, `dt`) VALUES ('$username', '$state', '$district', '$subdistrict', '$city', '$zipcode',  '$phone', '$alphone', '$email', '$password', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                //echo ($sql);
            ?>
                <script type="text/javascript">
                    //alert("<?php echo "Signup succesfully!" ?>");
                    window.location.href = 'login.php';
                </script>
        <?php
            } else {
                echo $showEroor = "password do not match";
            }
        }
        ?>






    </div>


    <?php
    include 'includes/footer.php';
    ?>