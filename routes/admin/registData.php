<?php
    include('../dbConnection.php');

    $query = "SELECT DATe(registration_date) AS regDate, COUNT(username) as userCount FROM users GROUP BY regDate ORDER BY regDate ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $data=[];
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = [$row['regDate'], (int)$row['userCount']];
    }
    header('Content-type: application/json');
    echo json_encode($data);
?>