<!DOCTYPE html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    session_start();

    $username = $_SESSION['username'];
    $post = $_POST['post_id'];

    include 'shortcuts.php';
    $pdo = connectToDatabase();

    $sql = "INSERT INTO comments (post_id, username) VALUES (?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $post);
    $stmt->bindValue(1, $username);
    $stmt->execute();

    exit;

} else {
    echo "Invalid request or missing parameters.";
}
?>