<!DOCTYPE html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    session_start();

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    include('dbConnection.php');

    $query = "SELECT username, password, state FROM users WHERE username = ? and password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $password);
    $stmt->execute();
    
    if($stmt->rowCount()>0){
        $user = $stmt->fetch();
        if ($user['state'] === 'disable') {
            $_SESSION['error_message'] = 'Your account has been disabled.';
            $pdo = null;
            header('Location: ban.php');
            exit;
        }else{
            $_SESSION['username'] = $username;
            unset($_SESSION['error_message']);
            $pdo = null;
            header('Location: home.php');
            exit;
        }
    } else {
        $_SESSION['error_message'] = 'Invalid email or password.';
        $pdo = null;
        header('Location: login.php');
        exit;
    }
    
   
} else {
    echo "Invalid request or missing parameters.";
}
?>