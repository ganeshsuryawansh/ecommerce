<?php
$showAlert = false;
$login = false;
include 'includes/nav.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            display: block;
            align-items: center;
            width: 600px;
            border:1px solid black;
        }

        form {
            display: flexbox;
            align-items: center;
        }
    </style>

</head>

<body>

    <div class="container my-5">
        <h1 class="text-center">Login to our website</h1>

        <form action="login.php" method="post">

            <div class="form-group col-md-6">
                <label for="Username">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="Username" name="email" required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="Password">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="Password" name="password" required>
                </div>
            </div>


            
            <button type="submit" class="btn btn-warning col-md-6 my-3">Login</button>
            <button type="button" class="btn btn-warning col-md-6 my-2">Forgot password</button>
            <p>Create your account <a href="http://localhost/ecommerce/signup.php">Register here</a></p>
        </form>
    </div>

</body>

</html>
<?php
include 'includes/footer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'includes/dbconnect.php';

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email' AND password ='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);


    if ($num == 1) {

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        $row = mysqli_fetch_array($query);
        $name = $row['name'];
        echo($name);

        $login = true;
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        //header("location:index.php");

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your are login successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } elseif (!$showAlert) {
        echo $showEroor = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Invalid credentials</strong> Try again!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

?>