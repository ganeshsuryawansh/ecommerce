<?php
include 'includes/nav.php';
include 'includes/dbconnect.php';
//session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyCart - The shopping site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        body{
            /*background-color: blueviolet;*/
        }
        .pimg {
            height: 280px;
            width: 300px;
        }
        .pimgfurniture{
            height: 280px;
            width: 287px;
        }
        .text {
            text-decoration: none;
            color: black;
        }

        .distag {
            color: green;
            font-weight: bolder;
            font-size: large;
        }
        
        .cardbody{
            background-color: pink;
            border-radius: 0px 0px 0px 0px;
        }
        .crd1{
            height: 500px;
            border-radius:30px 30px 30px 30px;
            overflow: hidden;
            /*background-color: pink;*/
        }

        .c1{
            /*background-color: blueviolet;*/
            /*height: 1700px;*/
        }

        .crd2{
                    height: 600px;
                    border-radius:30px 30px 30px 30px;
                    overflow: hidden;
                    /*background-color: pink;*/
                }
        .c2{
            /*background-color: blueviolet;*/
            margin-top: 50px;
        }
        .crd3{
                    height: 600px;
                    border-radius:30px 30px 30px 30px;
                    overflow: hidden;
                    /*background-color: pink;*/
                }
    </style>
</head>

<body>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/banner/banner-1.jpg" style="height: 550px" class="d-block w-100 des" alt="banner" />
            </div>
            <div class="carousel-item">
                <img src="images/banner/banner-2.jpg" style="height: 550px" class="d-block w-100 des" alt="banner" />
            </div>
            <div class="carousel-item">
                <img src="images/banner/banner-3.jpg" style="height: 550px" class="d-block w-100 des" alt="banner" />
            </div>
            <div class="carousel-item">
                <img src="images/banner/banner-4.jpg" style="height: 550px" class="d-block w-100 des" alt="banner" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container c1">
        <h1>Electronics</h1>
        <div class="row">

            <?php
            include 'includes/dbconnect.php';
            $query = mysqli_query($conn, "SELECT * FROM products WHERE pcat='Electronics'");

            while ($row = mysqli_fetch_array($query)) {
                $name = $row['pname'];
                $price = $row['pprice'];
                $info = $row['pdesc'];
                $img = $row['pimg'];
                $pid = $row['pid'];


            ?>
                <div class="col">
                    <div class="card my-2 mx-2 crd1" id="<?php echo ($pid) ?>" style="width: 18rem; ">
                        <a href="product.php?product=<?php echo ($row['pid']); ?>" class="text">
                            <img src="images/product/<?php echo ($img); ?>" class="card-img-top pimg" alt="...">
                            <div class="card-body cardbody">
                                <h5 class="card-title"><?php echo ($name); ?></h5>
                                <h3 class="card-text">₹<?php echo ($price); ?></h3>
                                <p class="distag">30% off</p><br>
                                <i>Free delivery</i><br>
                                <a href="#" class="btn btn-warning">❤️</a>
                            </div>
                        </a>

                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="container my-5 c2">
        <h1>Fashion Men's And Women's</h1>
        <div class="row">

            <?php
            include 'includes/dbconnect.php';
            $query = mysqli_query($conn, "SELECT * FROM products WHERE pcat='Fashion'");
            //$result = mysqli_query($conn, $query);
            //echo("pname ".$row["pname"]);

            while ($row = mysqli_fetch_array($query)) {
                $name = $row['pname'];
                $price = $row['pprice'];
                $info = $row['pdesc'];
                $img = $row['pimg'];
                $pid = $row['pid'];

                //echo($img);
            ?>
                <div class="col" id="<?php echo ($pid) ?>">
                    <a href="product.php?product=<?php echo ($row['pid']); ?>" class="text">
                        <div class="card my-5 mx-0 crd2" style="width: 18rem;">
                            <img src="images/product/<?php echo ($img); ?>" class="card-img-top mx-0 pimg" alt="...">
                            <div class="card-body cardbody">
                                <h5 class="card-title"><?php echo ($name); ?></h5>
                                <h3 class="card-text">₹<?php echo ($price); ?></h3>
                                <p class="distag">75% off</p><i>Free delivery</i></p>
                                
                                <a href="#" class="btn btn-warning">❤️</a>
                            </div>
                        </div>
                </div>

                </a>

            <?php
            }
            ?>
        </div>
    </div>


    <div class="container my-3">
        <h1>Homes & Furniture </h1>
        <div class="row">

            <?php
            include 'includes/dbconnect.php';
            $query = mysqli_query($conn, "SELECT * FROM products WHERE pcat='Furniture'");
            //$result = mysqli_query($conn, $query);
            //echo("pname ".$row["pname"]);

            while ($row = mysqli_fetch_array($query)) {
                $name = $row['pname'];
                $price = $row['pprice'];
                $info = $row['pdesc'];
                $img = $row['pimg'];
                $pid = $row['pid'];

                //echo($img);
            ?>
                <div class="col" id="<?php echo ($pid) ?>">
                    <a href="product.php?product=<?php echo ($row['pid']); ?>" class="text">
                        <div class="card my-2 mx-0 crd3" style="width: 18rem;">
                            <img src="images/product/<?php echo ($img); ?>" class="card-img-top mx-0 pimgfurniture" alt="...">
                            <div class="card-body cardbody">
                                <h5 class="card-title"><?php echo ($name); ?></h5>
                                <h3 class="card-text">₹<?php echo ($price); ?></h3>
                                <p class="distag">30% off</p><i>Free delivery</i></p>
                                <a href="#" class="btn btn-warning">❤️</a>
                            </div>
                        </div>
                </div>

                </a>

            <?php
            }
            ?>
        </div>
    </div>


    <script>

    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>

<?php
//include 'includes/footer.php';
?>