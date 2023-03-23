<?php
session_start();

if (isset($_POST['post_id'], $_POST['comment_content'])) {
    $postid = $_POST['post_id'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];

    include 'shortcuts.php';
    $pdo = connectToDatabase();

    $sql = "INSERT INTO comments (post_id, username, content) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $postid);
    $stmt->bindValue(2, $username);
    $stmt->bindValue(3, $content);
    $stmt->execute();

    $pdo = null;
    $stmt = null;
   
    exit;
} else {
    echo "Invalid request or missing parameters.";
}
?>
