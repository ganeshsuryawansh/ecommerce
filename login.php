
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
    <style>
        .cold {
            border: 1px solid black;
            border-radius: 10px 10px 10px 10px;
        }

        .offerimg {
            height: 500px;
            width: 550px;
            margin-right: 255px;
            border-radius: 10px 10px 10px 10px;
        }
    </style>
</head>

<body>
    <?php include 'includes/nav.php'; ?>
   
    <h4 class="text-left text-center my-5">Start Your Shopping Journy!</h4>

    <div class="container cont my-5">


        <div class="container cont2 text-left">
            <div class="row">
                <div class="col-md-5 cold">
                    <form class="py-5" action="Service/login.php" method="post">

                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" required>
                        </div>
                        <button type="submit" class="btn btn-warning my-3 col-12">Login</button>
                        <p style="font-size: 12px;">You Don't Have Account Then <a href="signup.php" rel="noopener noreferrer">Register Now!</a></p>

                    </form>

                </div>
                <div class="col-4 d-none d-md-block">
                    <div class="container offercontainer">
                        <a href="http://localhost/ecommerce/">
                            <img src="images/banner/banneroffer.jpg" class="offerimg" alt="offer">
                        </a>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <div class="foot fixed-bottom">

    </div>
</body>

</html>