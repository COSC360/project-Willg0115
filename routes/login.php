<!DOCTYPE html>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    //nee to update with our database
    $host = "cosc360.ok.ubc.ca";
    $user = "63271324";
    $pass = "63271324";
    $database = "db_63271324";
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);

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
                $pdo = null;
                header('Location: home.php');
                exit;
            }
        } else {
            $_SESSION['error_message'] = 'Invalid email or password.';
            $pdo = null;
            header('Location: login.html');
            exit;
        }
        
    }catch (PDOException $e){
          die($e->getMessage());
    }
}    else {
    echo "Invalid request or missing parameters.";
}
?>