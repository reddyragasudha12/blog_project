<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            header("Location: read.php");
            exit();
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h2 class="text-center mb-4">Login</h2>

<div class="card p-4 mx-auto" style="max-width: 400px;">

<?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>

<form method="POST">

    <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>

    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

    <button type="submit" class="btn btn-success w-100">Login</button>

</form>

<br>

<p class="text-center">
    Don't have an account? <a href="register.php">Register</a>
</p>

</div>

</body>
</html>