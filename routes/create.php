<!DOCTYPE html>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['email'])) {
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];

    include('dbConnection.php');

    $sql = "SELECT username, email FROM users WHERE username = ? or email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $email);
    $stmt->execute();
    
    if($stmt->rowCount() == 0){
        $sql = "INSERT INTO users (username, password, firstName, lastName, email) VALUES (?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
        $stmt->bindValue(3, $firstname);
        $stmt->bindValue(4, $lastname);
        $stmt->bindValue(5, $email);
        $stmt->execute();
        $pdo = null;
        header('Location: login.php');
        exit;
    }else{
        $pdo = null;
        echo "User already exists";
        header('Location: create.html');
        exit;
    }
    
} else {
    echo "Invalid request or missing parameters.";
}
?>