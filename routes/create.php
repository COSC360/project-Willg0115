<!DOCTYPE html>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['email'])) {
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];

    //nee to update with our database maybe
    $host = "localhost";
    $user = "webuser";
    $pass = "P@ssw0rd";
    $database = "skiit";
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);

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

            header('Location: login.html');
            exit;
        }else{
            echo "User already exists";
            header('Location: create.html');
            exit;
        }
    }catch (PDOException $e){
          die($e->getMessage());
    }
} else {
    echo "Invalid request or missing parameters.";
}
?>