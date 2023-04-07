<?php
    include('../dbConnection.php');
    $query = "SELECT DATE(comment_date) AS commentDate, COUNT(comment_id) AS commentCount FROM comments GROUP BY commentDate ORDER BY commentDate ASC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $data=[];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = [$row['commentDate'], (int)$row['commentCount']];
    }
    header('Content-type: application/json');
    echo json_encode($data);


?>