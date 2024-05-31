<?php

session_start();
if (!isset($_SESSION['admloggedin'])) {
    header("location:login.php");
}
error_reporting(1);

if (isset($_POST['submit'])) {
    $target_dir = "../images/product/";
    $target_file = $target_dir . basename($_FILES["pimg"]["name"]);

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file)) {
        // echo "The file " . htmlspecialchars(basename($_FILES["pimg"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.<br>";
    }

    $name = $_POST["pname"];
    $price = $_POST["pprice"];
    $info = $_POST["pdesc"];
    $image = basename($_FILES["pimg"]["name"]);
    $cate = $_POST["pcat"];
    $subcate = $_POST["psubcat"];

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "ecommerce");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `products` (`pname`, `pprice`, `pdesc`, `p2img`, `pcat`, `psubcat`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $price, $info, $image, $cate, $subcate);

    if ($stmt->execute()) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Include navigation and footer
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
        <h4>Add Product</h4>
        <div class="row">
            <div class="col-6 border py-3">
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pname" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="pname" required>
                    </div>
                    <div class="mb-3">
                        <label for="pprice" class="form-label">Product Price</label>
                        <input type="number" name="pprice" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pdesc" class="form-label">Product Description</label>
                        <input type="text" class="form-control" name="pdesc" required>
                    </div>
                    <div class="mb-3">
                        <label for="pimg" class="form-label">Product Image</label>
                        <input type="file" name="pimg" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <select name="pcat" class="form-control">
                            <option value="">Select Product Category</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Grocery">Grocery</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="psubcat" class="form-control">
                            <option value="">Select Product Sub Category</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Mens">Mens</option>
                            <option value="Womens">Womens</option>
                            <option value="Homes">Homes</option>
                            <option value="Watch">Watch</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include 'includes/footer.php'; ?>