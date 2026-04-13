<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

$id = $_GET['id'];

// when form submitted → update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $conn->query("UPDATE posts SET title='$title', content='$content' WHERE id=$id");

    header("Location: read.php");
    exit();
}

// get old data
$result = $conn->query("SELECT * FROM posts WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>

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

<h2 class="mb-4">Edit Post</h2>

<!-- ✅ Styled Form -->
<form method="POST" class="card p-4">

    <input type="text" name="title" 
           value="<?php echo $row['title']; ?>" 
           class="form-control mb-3" required>

    <textarea name="content" 
              class="form-control mb-3" required><?php echo $row['content']; ?></textarea>

    <button type="submit" class="btn btn-success">Update Post</button>

</form>

</body>
</html>