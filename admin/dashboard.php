<?php
session_start();
include("../db.php");

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    echo "Access Denied";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/A/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <h2>Admin Panel 🧑‍💼</h2>
    <div>
        <a href="/toy-kuni-client/index.php">Home</a>
        <a href="add_product.php">Add Product</a>
    </div>
</nav>

<h2 class="section-title">All Products</h2>

<div class="products">

<?php
$res = mysqli_query($conn, "SELECT * FROM products");

while($row = mysqli_fetch_assoc($res)){
?>

    <div class="card">
        <img src="/toy-kuni-client/images/<?php echo $row['image']; ?>" class="product-img">

        <h3><?php echo $row['name']; ?></h3>
        <p>$<?php echo $row['price']; ?></p>

        <!-- 🔥 EDIT BUTTON (THIS WAS MISSING) -->
        <a class="btn" href="edit_product.php?id=<?php echo $row['id']; ?>">
            Edit
        </a>

    </div>

<?php } ?>

</div>

</body>
</html>