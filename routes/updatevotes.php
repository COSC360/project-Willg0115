<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $postId = $data['post_id'];
    $upvote = $data['upvote'];

    if (isset($postId) && isset($upvote)) {
        include('dbConnection.php');

        $modifier = $upvote ? 1 : -1;
        $query = "UPDATE posts SET likes = likes + ? WHERE post_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $modifier);
        $stmt->bindValue(2, $postId);
        $stmt->execute();

        $query = "SELECT likes FROM posts WHERE post_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $postId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $post = $stmt->fetch(PDO::FETCH_ASSOC);
            $newVoteCount = $post['likes'];

            echo json_encode(['success' => true, 'new_vote_count' => $newVoteCount]);
        } else {
            echo json_encode(['success' => false]);
        }

        $pdo = null;
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
