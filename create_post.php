<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();

    header("Location: posts/post_list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Create New Post</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Post Title" required />
            <textarea name="content" placeholder="Write your post..." required></textarea>
            <button type="submit">Create</button>
        </form>
    </div>
</body>
</html>
