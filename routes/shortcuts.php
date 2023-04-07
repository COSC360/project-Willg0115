<?php
    function isAdmin($username){
        include('dbConnection.php');
        $sql = "SELECT role FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $result = $stmt->fetch();
            if($result["role"]=="admin"){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
?>