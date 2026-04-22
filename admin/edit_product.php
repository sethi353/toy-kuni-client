<?php
session_start();
include("../db.php");

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    echo "Access Denied";
    exit();
}

// ✅ SAFE CHECK FOR ID
if(!isset($_GET['id'])){
    echo "No product ID provided";
    exit();
}

$id = $_GET['id'];

// GET PRODUCT
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");

if(mysqli_num_rows($result) == 0){
    echo "Product not found";
    exit();
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="/toy-kuni-client/style.css">
</head>
<body>

<nav class="navbar">
    <h2>Edit Product </h2>
    <div>
        <a href="/toy-kuni-client/admin/dashboard.php">Dashboard</a>
    </div>
</nav>

<div class="card" style="width:400px;margin:60px auto;text-align:center;">
    <h2>Edit Product</h2>

    <form method="POST">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>

        <input type="text" name="price" value="<?php echo $product['price']; ?>" required><br><br>

        <input type="text" name="image" value="<?php echo $product['image']; ?>" required><br><br>

        <button class="btn" name="update">Update</button>
    </form>
</div>

<?php
if(isset($_POST['update'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    mysqli_query($conn, "
        UPDATE products 
        SET name='$name', price='$price', image='$image'
        WHERE id=$id
    ");

    echo "<p style='color:green;text-align:center;'>Product Updated Successfully!</p>";

    echo "<script>
        setTimeout(() => {
            window.location='dashboard.php';
        }, 1000);
    </script>";
}
?>

</body>
</html>