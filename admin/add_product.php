<?php
session_start();
include("../db.php");

if($_SESSION['role'] != "admin"){
    echo "Access Denied";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product - Admin</title>

    <!-- FIXED CSS PATH -->
    <link rel="stylesheet" href="/A/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <h2 class="logo">Admin Panel 🧑‍💼</h2>
    <div>
        <a href="/toy-kuni-client/admin/dashboard.php">Dashboard</a>
        <a href="/toy-kuni-client/index.php">Home</a>
    </div>
</nav>

<!-- FORM CARD -->
<div class="card" style="width:400px;margin:60px auto;text-align:center;">
    <h2>Add New Product</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required><br><br>

        <input type="text" name="price" placeholder="Price" required><br><br>

        <input type="text" name="image" placeholder="Image name (toy1.jpg)" required><br><br>

        <button class="btn" name="add">Add Product</button>
    </form>
</div>

<?php
if(isset($_POST['add'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $query = "INSERT INTO products(name,price,image)
              VALUES('$name','$price','$image')";

    mysqli_query($conn, $query);

    echo "<p style='color:green;text-align:center;'>Product Added Successfully!</p>";
}
?>

<!-- FOOTER -->
<footer>
    <p>© 2026 ToyKuni Admin Panel</p>
</footer>

</body>
</html>