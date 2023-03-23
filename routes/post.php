<!DOCTYPE html>
<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject'], $_POST['content'], $_POST['loctype'])) {
    if(isset($_FILES['postimage'])){
        //$targetDir = "https://cosc360.ok.ubc.ca/wgarbutt/uploads/";
        $targetDir = "../uploads/";
        if (!is_dir($targetDir) ) { 
            mkdir($targetDir, 0755, true);   
        }

        $targetFile = $targetDir . basename($_FILES["postimage"]["name"]);

        if (move_uploaded_file($_FILES["postimage"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["postimage"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $title = $_POST['subject'];
    $content = $_POST['content'];
    $type = $_POST['loctype'];
    $username = $_SESSION['username'];
    
    include 'shortcuts.php';
        $pdo = connectToDatabase();

        if(isset($_FILES['postimage'])){
            $sql = "INSERT INTO posts (username, title, type, content, post_img) VALUES (?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $username);
            $stmt->bindValue(2, $title);
            $stmt->bindValue(3, $type);
            $stmt->bindValue(4, $content);
            $stmt->bindValue(5, $targetFile);
            $stmt->execute();
        }
        else {
            
            $sql = "INSERT INTO posts (`username`, `title`, type, content) VALUES (?,?,?,?)";
           
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindValue(1, $username);
            $stmt->bindValue(2, $title);
            $stmt->bindValue(3, $type);
            $stmt->bindValue(4, $content);
            $stmt->execute();
        }
            $pdo = null;
            $stmt=null;
            header('Location: account.php');
            exit;
} else {
    echo "Invalid request or missing parameters.";
}
?>