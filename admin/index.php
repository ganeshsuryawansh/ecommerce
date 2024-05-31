<?php
error_reporting(0);
include('functions.php');
session_start();
if (!isset($_SESSION['admloggedin'])) {
    header("location:login.php");
}
include 'nav.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-2 p-2 rounded-2 border border-dark bg-warning m-3 text-center align-items-center" style="height: 150px;">
                <b>Total Sales:</b>
                <br><br>
                <h4>Rs. <?php total_sales() ?></h4>
            </div>
            <div class="col-2 p-2 rounded-2 border border-dark bg-primary m-3 text-center" style="height: 150px;">
                <b>Total Product:</b>
                <br><br>
                <h4><?= total_product() ?></h4>
            </div>
            <div class="col-2 p-2 rounded-2 border border-dark bg-success m-3 text-center" style="height: 150px;">
                <b>Total Users:</b>
                <br><br>
                <h4><?= total_users() ?></h4>
            </div>
            <div class="col-2 p-2 rounded-2 border border-dark bg-info m-3 text-center" style="height: 150px;">
                <b>Total Orders:</b>
                <br><br>
                <h4><?= total_orders() ?></h4>
            </div>
            <div class="col-2 p-2 rounded-2 border border-dark bg-danger m-3 text-center" style="height: 150px;">
                <b>Today's Orders</b>
                <br><br>
                <h4><?= today_order() ?></h4>
            </div>
        </div>
    </div>


    <div class="container">


        <table class="table border">
            <thead>
                <tr>
                    <th scope="col" class="border">Sr No</th>
                    <th scope="col" class="border">Product Name</th>
                    <th scope="col" class="border">Product Image</th>
                    <th scope="col" class="border">Product Price</th>
                    <th scope="col" class="border">User Id</th>
                    <th scope="col" class="border">Date of Order</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "ecommerce");
                $q = "SELECT * FROM myorders ORDER BY srno DESC";
                $r = mysqli_query($conn, $q);
                // echo "<pre>";

                $c = 0;
                while ($ro = mysqli_fetch_array($r)) {
                    // print_r($ro);
                    $pid = $ro['productid'];
                    $qr = "SELECT * FROM products WHERE pid='$pid'";
                    $res = mysqli_query($conn, $qr);

                    while ($row = mysqli_fetch_array($res)) {
                        // print_r($row);


                ?>
                        <tr>
                            <th class="border" scope="row"><?= ++$c ?></th>
                            <td class="border"><?= $row['pname'] ?></td>
                            <td class="border"><img src="../images/product/<?= $row['pimg'] ? $row['pimg'] : $row['p2img'] ?>" height="80px" width="100px" alt=""> </td>
                            <td class="border">Rs.<?= $row['pprice'] ?></td>
                            <td class="border"><?= $ro['email_id'] ?></td>
                            <td class="border"><?= $ro['date2'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include 'includes/footer.php'; ?>