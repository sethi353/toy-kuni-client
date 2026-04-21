<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - ToyKuni</title>

    <!-- ✅ FIXED CSS PATH -->
    <link rel="stylesheet" href="/toy-kuni-client/style.css?v=1">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
    <h2 class="logo">ToyKuni 🧸</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="register.php">Register</a>
    </div>
</nav>

<!-- LOGIN BOX -->
<div class="card" style="width:320px;margin:80px auto;text-align:center;">
    <h2>Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button class="btn" type="submit" name="login">Login</button>
    </form>
</div>

<?php
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];

    // 🔥 ADMIN LOGIN
    if($email == "jony@gmail.com" && $pass == "jony123"){
        $_SESSION['role'] = "admin";
        $_SESSION['user_id'] = 0;

        header("Location: admin/dashboard.php");
        exit();
    }

    // 👤 USER LOGIN
    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(!$res){
        die("DB Error: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($res);

    if($user && password_verify($pass, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

       header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red;text-align:center;'>Invalid login credentials</p>";
    }
}
?>

<!-- FOOTER -->
<footer>
    <p>© 2026 ToyKuni | All Rights Reserved</p>
</footer>

</body>
</html>