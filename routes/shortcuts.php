<?php
    function connectToDatabase() {
        $host = "localhost";
        $database = "skiit";
        $user = "webuser";
        $password = "P@ssw0rd";
        try{
            $pdo = new PDO("mysql:host=$host;dbname=$database",$user, $password);
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
        return $pdo;
    }

    function isAdmin($username){
        $pdo = connectToDatabase();
        $sql = "SELECT role FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $result = $stmt->fetch();
            return $result['role']==='admin';
        }else{
            return false;
        }
    }
?>