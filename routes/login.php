<!DOCTYPE html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    session_start();

    $username = $_POST['username'];
    $password = ($_POST['password']);

    //nee to update with our database
    $host = "localhost";
    $user = "webuser";
    $pass = "P@ssw0rd";
    $database = "skiit";
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);

        $query = "SELECT username, password FROM users WHERE username = ? and password = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        
        if($stmt->rowCount()>0){
            $_SESSION['username'] = $username;
            $pdo = null;
            header('Location: home.php');
            exit;
        } else {
            $_SESSION['error_message'] = 'Invalid email or password.';
            $pdo = null;
            header('Location: login.php');
            exit;
        }
        
    }catch (PDOException $e){
          die($e->getMessage());
    }
} else {
    echo "Invalid request or missing parameters.";
}
?>