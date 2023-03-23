<!DOCTYPE HTML>
<head lang="en">
    <meta charset="UTF-8">
    <title>Ski-It Project</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/home.css">
</head>
<?php include 'headers/header1.php'; ?>
<body>
    <div class="menu">
        <ul>
            <li><a href='home.php'>Popular</a></li>
            <li><a href='resort.php'>Resort</a></li>
            <li><a href='backcountry.php'>Backcountry</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="dumpings">
            <h2>Today's Dumpings</h2>
            <div class="dumping">
                <img >
                <h3>Jackson Hole</h3>
            </div>
            <div class="dumping">
                <img >
                <h3>Revelstoke</h3>
            </div>
            <div class="dumping">
                <img >
                <h3>Big White</h3>
            </div>
            
        </div>
        <div class="posts">
            <h2>Backcountry Posts</h2>
            <?php
                include 'shortcuts.php';
                $pdo = connectToDatabase();
                
                $query = "SELECT * FROM posts WHERE type = 'backcountry' ORDER BY likes DESC";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
            
                if ($stmt->rowCount() > 0) {
                    while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='post'>";
                        echo "<h2>" . $post['username'] . "</h2>";
                        echo "<h3>" . $post['title'] . "</h3>";
                        echo "<h4>" . $post['type'] . "</h4>";
                        if (!empty($post['post_img'])) {
                            echo "<img src='" . $post['post_img'] . "' alt='" . $post['title'] . "'>";
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
                $pdo = null;    
            ?>
        </div>
    </div>
</body>