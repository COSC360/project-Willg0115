<?php
    header('Content-type: application/json');
    include('../dbConnection.php');

    $query = "SELECT type, COUNT(post_id) AS postCount FROM posts GROUP BY type";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $data=[];
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]=[$row['type'], (int)$row['postCount']];
    }
    echo json_encode($data);

?>