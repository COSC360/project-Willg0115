<!DOCTYPE html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['comment_content'])) {
    session_start();

    $username = $_SESSION['username'];
    $post = $_POST['post_id'];
    $content = $_POST['comment_content'];


    include 'shortcuts.php';
    $pdo = connectToDatabase();

    $sql = "INSERT INTO comments (post_id, username, content) VALUES (?,?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $post);
    $stmt->bindValue(2, $username);
    $stmt->bindValue(3, $content);
    $stmt->execute();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

} else {
    echo "Invalid request or missing parameters.";
}
?>