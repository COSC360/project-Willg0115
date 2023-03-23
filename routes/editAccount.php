<!DOCTYPE html>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'])) {
    
    $newusername = $_POST['username'];
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];

    $username = $_SESSION['username'];
   
    include 'shortcuts.php';
    $pdo = connectToDatabase();

    $sql = "UPDATE users SET username = ?, firstName = ?, lastName = ?, email = ? WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $newusername);
    $stmt->bindValue(2, $firstname);
    $stmt->bindValue(3, $lastname);
    $stmt->bindValue(4, $email);
    $stmt->bindValue(5, $username);
    $stmt->execute();
   
    $pdo = null;
    $stmt = null;



    header('Location: logout.php');
    exit;
    
   } else {
    echo "Invalid request or missing parameters.";
}
?>