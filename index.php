<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>ToyKuni</title>
    <link rel="stylesheet" href="/toy-kuni-client/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <h2 class="logo">ToyKuni </h2>
    <div>
        <a href="index.php">Home</a>

        <?php if(isset($_SESSION['user_id'])){ ?>

            <!-- ADMIN DASHBOARD -->
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){ ?>
                <a href="/toy-kuni-client/admin/dashboard.php">Dashboard</a>
            <?php } ?>

            <a href="/toy-kuni-client/cart_view.php">Cart 🛒</a>
            <a href="logout.php">Logout</a>

        <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } ?>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <h1>Welcome to ToyKuni</h1>
    <p>A magical universe of toys ✨</p>
</section>

<!-- PRODUCTS -->
<h2 class="section-title">Our Toys</h2>

<div class="products">

<?php
$result = mysqli_query($conn, "SELECT * FROM products");

if(!$result){
    die("Database Error: " . mysqli_error($conn));
}

if(mysqli_num_rows($result) == 0){
    echo "<h3 style='text-align:center;'>No products available</h3>";
}

while($row = mysqli_fetch_assoc($result)){
?>

    <div class="card">

        <!-- PRODUCT IMAGE -->
        <img src="/toy-kuni-client/images/<?php echo $row['image']; ?>" style="width:120px;height:120px;">

        <!-- PRODUCT NAME -->
        <h3><?php echo $row['name']; ?></h3>

        <!-- PRODUCT PRICE -->
        <p>$<?php echo $row['price']; ?></p>

        <!-- ADD TO CART / LOGIN -->
        <?php if(isset($_SESSION['user_id'])){ ?>
            <a class="btn" href="/toy-kuni-client/cart.php?id=<?php echo $row['id']; ?>">
                Add to Cart
            </a>
        <?php } else { ?>
            <a class="btn" href="login.php">
                Login to Buy
            </a>
        <?php } ?>

    </div>

<?php } ?>

</div>

<!-- FOOTER -->
<footer>
    <p>© 2026 ToyKuni | All Rights Reserved</p>
</footer>

</body>
</html>