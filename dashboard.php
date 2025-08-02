<?php
session_start();
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION["user_id"];
$result = $conn->query("SELECT * FROM posts WHERE user_id = $user_id ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>📋 My Blog</h1></header>
<div class="container">
    <div class="actions">
        <a href="create_post.php">Create Post</a>
        <a href="logout.php">Logout</a>
    </div>
    <?php while ($row = $result->fetch_assoc()): ?>
    <div class="post">
        <h3><?= htmlspecialchars($row['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
        <small>Posted on: <?= $row['created_at'] ?></small>
        <a class="edit" href="edit_post.php?id=<?= $row['id'] ?>">Edit</a>
        <a class="delete" href="delete_post.php?id=<?= $row['id'] ?>">Delete</a>
    </div>
    <?php endwhile; ?>
</div>
</body>
</html>