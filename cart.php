<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
    die("Please login first");
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

mysqli_query($conn, "INSERT INTO cart(user_id, product_id) 
VALUES('$user_id','$product_id')");

header("Location: cart_view.php");
exit();
?>