<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $conn->query("INSERT INTO posts (title, content) VALUES ('$title', '$content')");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>

    <!-- ✅ Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<!-- ✅ Navbar -->
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="read.php">My Blog</a>
        <a href="logout.php" class="btn btn-light">Logout</a>
    </div>
</nav>

<h2 class="mb-4">Create Post</h2>

<!-- ✅ Form Styling -->
<form method="POST" class="card p-4">

    <input type="text" name="title" class="form-control mb-3" placeholder="Enter Title" required>

    <textarea name="content" class="form-control mb-3" placeholder="Enter Content" required></textarea>

    <button type="submit" class="btn btn-primary">Add Post</button>

</form>

</body>
</html>