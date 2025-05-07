<?php
error_reporting(1);

$conn = mysqli_connect("localhost", "root", "", "ecommerce");

if (isset($_POST['submit'])) {
    print_r($_POST);

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("SELECT * FROM admins WHERE emailid = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();



    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            session_start();
            $_SESSION['admloggedin'] = true;
            $_SESSION['admemail'] = $email;
            header("location: index.php");
            exit();
        } else {
            $showError = "Invalid Credentials";
        }
    } else {
        $showError = "Invalid Credentials";
    }

    $stmt->close();
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <h4 class="text-center my-3">Only Admin Can Login</h4>
        <div class="d-flex justify-content-center">
            <div class="my-5 col-md-4 card p-3">
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>

                    <input type="submit" value="LOGIN" name="submit" class="btn btn-primary col-12">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>