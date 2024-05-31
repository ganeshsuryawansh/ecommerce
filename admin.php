<?php
include 'includes/dbconnect.php';
error_reporting(0); ?>




<div class="container my-5">
    <h4>Add Product</h4>
    <form action="/ecommerce/admin.php" method="POST">
        <div class="mb-3">
            <label for="exampleInput" class="form-label">Product name</label>
            <input type="text" class="form-control" name="pname" id="" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
            <label for="exampleInput" class="form-label">product price</label>
            <input type="number" name="pprice" class="form-control" id="" required>
        </div>

        <div class="mb-3">
            <label for="exampleInput" class="form-label">Product information</label>
            <input type="text" class="form-control" name="pdesc" id="" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">product image</label>
            <input type="file" accept="jpeg/png/JPEG/JPG" name="pimg" class="form-control" id="" required>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">product category</label>
            <p><b>Categoris:</b> Electronics , Fashion , Furniture , grocery</p>
            <input type="text" class="form-control" name="pcat" id="" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">product sub category</label>
            <p><b>Categoris:</b> laptop , mens , womens , homes, watch</p>
            <input type="text" class="form-control" name="psubcat" id="" aria-describedby="emailHelp" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>

<?php

include 'includes/dbconnect.php';

$name = $_POST["pname"];
$price = $_POST["pprice"];
$info = $_POST["pdesc"];
$image = $_POST["pimg"];
$cate = $_POST["pcat"];
$subcate = $_POST["psubcat"];

$sql = "INSERT INTO `products` (`pname`, `pprice`, `pdesc`,`pimg`, `pcat`, `psubcat`) VALUES ('$name', '$price', '$info', '$image', '$cate', '$subcate')";
$result = mysqli_query($conn, $sql);
//print_r($sql);


?>
<?php //error_reporting(0); 
?>
<?php
include 'includes/footer.php';
?>