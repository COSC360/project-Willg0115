<!DOCTYPE html>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //nee to update with our database
    $host = "localhost";
    $user = "webuser";
    $pass = "P@ssw0rd";
    $database = "skiit";
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);

        $query = "SELECT user_id, username, password FROM users WHERE username = ? and password = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        
        if($stmt->rowCount()>0){
            $_SESSION['user_id'] = $stmt->fetch()[$userId];
        
            header('Location: home.html');
            exit;
        } else {
            $_SESSION['error_message'] = 'Invalid email or password.';
            header('Location: login.php');
            exit;
        }
        $pdo = null;
    }catch (PDOException $e){
          die($e->getMessage());
    }
} else {
    echo "Invalid request or missing parameters.";
}
?>