<!DOCTYPE HTML>
<head lang="en">
    <meta charset="UTF-8">
    <title>My account</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/account.css">
</head>
<?php include 'headers/header2.php'; ?>
<body>
    <div class="menu">
        <ul>
            <li class="navmenu"><a href='accountInfo.php'>Account info</a></li>
            <li class="navmenu"><a href='account.php'>My Posts</a></li>
            <li class="navmenu"><a id="makePost" href="makePost.php">New Post</a></li>
        </ul>
    </div>
    <div class="main">
        <?php
            include('dbConnection.php');
            session_start();
            $query = "SELECT * FROM posts WHERE username = ? ORDER BY post_date DESC";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, $_SESSION['username']);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='post'>";
                    echo "<h2>" . $post['title'] . "</h2>";
                    echo "<h3>" . $post['type'] . "</h3>";
                    if (!empty($post['post_img'])) {
                        echo "<img src='../uploads/" . $post['post_img'] . "' alt='" . $post['title'] . "'>";
                    }
                    echo "<p>" . $post['content'] . "</p>";
                    echo "<p><button class='like-button' onClick=incrementLikes(this)>^ " . $post['likes'] . "</button></p>";
                    $query = "SELECT * FROM comments WHERE post_id = ? ORDER BY comment_date DESC";
                    $stmt2 = $pdo->prepare($query);
                    $stmt2->bindValue(1, $post['post_id']);
                    $stmt2->execute();
                    if ($stmt2->rowCount() > 0) {
                        while ($comment = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class ='post'>";
                            echo "<h3>" . $comment['username'] . "</h3>";
                            echo "<p>" . $comment['content'] . "</p>";
                            echo "</div>";
                        }
                    }
                    echo "</div>";
                }
            } 
        ?>       
    </div>
</body>