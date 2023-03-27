<?php
    function connectToDatabase() {
        $host = "cosc360.ok.ubc.ca";
        $database = "db_63271324";
        $user = "63271324";
        $password = "63271324";
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