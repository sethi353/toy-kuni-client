<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
    die("Please login first");
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="/toy-kuni-client/style.css">
</head>
<body>

<nav class="navbar">
    <h2>Your Cart </h2>
    <div>
        <a href="index.php">Home</a>
    </div>
</nav>

<h2 class="section-title">Cart Items</h2>

<div class="products">

<?php
$query = "SELECT cart.id AS cart_id, products.name, products.price, products.image
          FROM cart
          JOIN products ON cart.product_id = products.id
          WHERE cart.user_id = $user_id";

$result = mysqli_query($conn, $query);

$total = 0;

if(mysqli_num_rows($result) == 0){
    echo "<h3 style='text-align:center;'>Cart is empty</h3>";
}

while($row = mysqli_fetch_assoc($result)){
    $total += $row['price'];
?>

    <div class="card">
        <img src="/toy-kuni-client/images/<?php echo $row['image']; ?>" width="100">
        <h3><?php echo $row['name']; ?></h3>
        <p>$<?php echo $row['price']; ?></p>

        <!-- REMOVE BUTTON -->
        <a class="btn" href="remove_cart.php?id=<?php echo $row['cart_id']; ?>">
            Remove
        </a>
    </div>

<?php } ?>

</div>

<h2 style="text-align:center;">Total: $<?php echo $total; ?></h2>

</body>
</html>
