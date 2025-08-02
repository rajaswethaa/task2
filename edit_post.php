<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();

    header("Location: posts/post_list.php");
}

$post = $conn->query("SELECT * FROM posts WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Post</h2>
        <form method="POST">
            <input type="text" name="title" value="<?= $post['title'] ?>" required />
            <textarea name="content" required><?= $post['content'] ?></textarea>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
