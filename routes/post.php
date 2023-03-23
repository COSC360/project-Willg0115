<!DOCTYPE html>
<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject'], $_POST['content'], $_POST['loctype'])) {
    //if(isset($_POST['postimage'])){
        //process image 
    //}
    $title = $_POST['subject'];
    $content = md5($_POST['content']);
    $type = $_POST['loctype'];
    $username = $_SESSION['username'];
    //nee to update with our database maybe
    include 'shortcuts.php';
        $pdo = connectToDatabase();

        //if(isset($_POST['postimage'])){
        //    $sql = "INSERT INTO posts (username, title, type, content, post_img) VALUES (?,?,?,?,?)";
        //    $stmt = $pdo->prepare($sql);
        //    $stmt->bindValue(1, $username);
        //    $stmt->bindValue(2, $title);
        //    $stmt->bindValue(3, $type);
        //    $stmt->bindValue(4, $content);
        //    $stmt->bindValue(5, $the image);
        //    $stmt->execute();
        //}
        //else {
            $sql = "INSERT INTO posts (username, title, type, content) VALUES (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $username);
            $stmt->bindValue(2, $title);
            $stmt->bindValue(3, $type);
            $stmt->bindValue(4, $content);
            $stmt->execute();
            $pdo = null;
            $stmt=null;
       // }
            header('Location: account.php');
            exit;
} else {
    echo "Invalid request or missing parameters.";
}
?>