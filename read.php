<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">My Blog</a>
        <div>
            <a href="create.php" class="btn btn-primary">+ Create Post</a>
            <a href="logout.php" class="btn btn-light">Logout</a>
        </div>
    </div>
</nav>

<h2 class="mb-4">All Posts</h2>

<?php
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<div class='card p-3 mb-3'>";
        echo "<h4>" . $row['title'] . "</h4>";
        echo "<p>" . $row['content'] . "</p>";

        echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
        echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>";

        echo "</div>";
    }

} else {
    echo "<p>No posts found!</p>";
}
?>

</body>
</html>