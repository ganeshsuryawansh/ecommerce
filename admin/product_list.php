<?php
error_reporting(0);
include "nav.php";
if (!isset($_SESSION['admloggedin'])) {
    header("location:login.php");
}
$conn = mysqli_connect("localhost", "root", "", "ecommerce");


if ($_GET['did']) {
    $did = $_GET['did'];

    $qr = "DELETE FROM products WHERE pid='$did'";
    $res = mysqli_query($conn, $qr);
}

?>

<h4 class="text-center py-4">All Product Lists</h4>
<div class="container">
    <table class="table border table-responsive">
        <thead>
            <tr>
                <th class="border" scope="col-2">#</th>
                <th class="border" scope="" style="width: 300px;">Name</th>
                <th class="border" scope="col-2">Image</th>
                <th class="border" scope="col-2">Price</th>
                <th class="border" scope="col-2">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $qr = "SELECT * FROM products ORDER BY pid DESC";

            $result = mysqli_query($conn, $qr);
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <th class="border" scope="row"><?= $count ?></th>
                    <td class="border"><?= $row['pname'] ?></td>
                    <td class="border"><img src="../images/product/<?= $row['pimg'] ? $row['pimg'] : $row['p2img'] ?>" height="100px" width="100px"> </td>
                    <td class="border">RS. <?= $row['pprice'] ?></td>
                    <td class="border">
                        <a class="btn btn-danger" href="product_list.php?did=<?= $row['pid'] ?>">Delete</a>
                        <br><br>
                        <a class="btn btn-success" target="_blank" href="../product.php?product= <?= $row['pid'] ?>">View Product</a>

                    </td>
                </tr>
            <?php
                $count++;
            }
            ?>


        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>