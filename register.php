<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($check->num_rows > 0) {
        $error = "Username already exists!";
    } else {
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        $success = "Registered successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h2 class="text-center mb-4">Register</h2>

<div class="card p-4 mx-auto" style="max-width: 400px;">

<?php 
if (isset($error)) echo "<p class='text-danger'>$error</p>";
if (isset($success)) echo "<p class='text-success'>$success</p>";
?>

<form method="POST">

    <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>

    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

    <button type="submit" class="btn btn-primary w-100">Register</button>

</form>

<br>

<p class="text-center">
    Already have an account? <a href="login.php">Login</a>
</p>

</div>

</body>
</html>