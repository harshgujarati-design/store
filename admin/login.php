<?php
session_start();
require '../includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = mysqli_query($conn, "SELECT * FROM admin_users WHERE username='$username'");
    $admin = mysqli_fetch_assoc($query);

    if ($admin && $password === $admin["password"]) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: index.php");
        exit;
    } else {
        $message = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Admin Login</h1>

<form method="POST">
    <p style="color:red;"><?= $message ?></p>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button class="btn">Login</button>
</form>

</body>
</html>
