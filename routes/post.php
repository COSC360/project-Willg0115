<!DOCTYPE html>
<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject'], $_POST['content'], $_POST['loctype'])) {

    $title = $_POST['subject'];
    $content = $_POST['content'];
    $type = $_POST['loctype'];
    $username = $_SESSION['username'];

    if(isset($_FILES['postimage'])){
        $file = pathinfo($_FILES['postimage']["name"], PATHINFO_BASENAME);
        move_uploaded_file($_FILES['postimage']['tmp_name'], "../uploads/". $username . $file);
    }

       include('dbConnection.php');

        if(isset($_FILES['postimage'])){
            $sql = "INSERT INTO posts (username, title, type, content, post_img) VALUES (?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $username);
            $stmt->bindValue(2, $title);
            $stmt->bindValue(3, $type);
            $stmt->bindValue(4, $content);
            $stmt->bindValue(5, $username . $file);
            $stmt->execute();
        }
        else {
            
            $sql = "INSERT INTO posts (username, title, type, content) VALUES (?,?,?,?)";
           
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