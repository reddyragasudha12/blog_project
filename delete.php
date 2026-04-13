<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
include('../config/db.php');

$id = $_GET['id'];

$conn->query("DELETE FROM posts WHERE id=$id");

header("Location: read.php");
exit();
?>