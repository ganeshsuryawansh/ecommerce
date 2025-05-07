<?php
include("dbconnect.php");
// print_r($_POST);

if (isset($_POST['search'])) {
    $q = $_POST['search'];
    $sq = "SELECT * FROM products WHERE pname LIKE CONCAT('%','$q', '%');";
    $res = mysqli_query($conn, $sq);

    // echo "<pre>";
    while ($row = mysqli_fetch_assoc($res)) {
        // print_r($row);
?>
        <li>
            <a style="text-decoration: none;color:black;" href="product.php?product=<?= $row['pid'] ?>">
                <img src="images/product/<?= $row['pimg'] ? $row['pimg'] : $row['p2img'] ?>" height="50px" width="50px" alt="">
                <?= substr($row['pname'], 0, 50); ?>
            </a>
        </li>
        <hr>
<?php
    }
}
