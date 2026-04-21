<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id'])){
    die("Login required");
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM cart WHERE id=$id");

header("Location: cart_view.php");
exit();
?>

