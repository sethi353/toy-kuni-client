<?php include("db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <h2 class="logo">ToyKuni 🧸</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
    </div>
</nav>

<!-- REGISTER FORM -->
<div class="card" style="width:300px;margin:80px auto;">
<form method="POST">
    <h2>Register</h2>
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button class="btn" name="register">Register</button>
</form>
</div>

<?php
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users(name,email,password) 
    VALUES('$name','$email','$pass')");

    echo "<p style='text-align:center;color:green;'>Registered Successfully!</p>";
}
?>

<!-- FOOTER -->
<footer>
    <p>© 2026 ToyKuni | All Rights Reserved</p>
</footer>

</body>
</html>