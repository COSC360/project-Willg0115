<?php
if (isset($_POST['username']) && isset($_POST['state'])) {
    include('../dbConnection.php');
    
    $username = $_POST["username"];
    $currentState = $_POST["state"];
    if($currentState == 'able'){
        $newState = 'disable';
    }elseif($currentState == 'disable'){
        $newState = 'able';
    }

    $sql = "UPDATE users SET state = ? WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $newState);
    $stmt->bindValue(2, $username);
    $stmt->execute();

    header("Location: ../admin.php");
    exit;
}
?>