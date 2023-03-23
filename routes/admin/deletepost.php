<?php
    include 'shortcuts.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
    
        $pdo = connectToDatabase();
        
        $sql = "DELETE FROM posts WHERE post_id = :post_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $pdo = null;
        $stmt = null;
    
        header("Location: ../admin.php");
    } else {
        header("Location: ../admin.php");
    }
?>