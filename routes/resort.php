<!DOCTYPE HTML>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<head lang="en">
    <meta charset="UTF-8">
    <title>Ski-It Project</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
<?php 
    include 'headers/header1.php'; 
?>
    <div class="menu">
        <ul>
            <li><a href='home.php'>Popular</a></li>
            <li><a href='resort.php'>Resort</a></li>
            <li><a href='backcountry.php'>Backcountry</a></li>
        </ul>
    </div>
    <div class="main">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
                echo "<div class='post'>";
                echo "<form id='comment-form' action='comment.php' method='post'>";
                echo "<h2>Comment</h2>";
                echo "<input type='hidden' name='post_id' value='".$_POST['post_id']."'>";
                echo "<textarea id='comment_content' name='comment_content' placeholder='comment' required></textarea><br>";
                echo "<button type='submit'>Submit</button>";
                echo "</form>";
                echo "<a  href='resort.php'>Cancel</a></div>";        
            }  else
        echo "<div class='dumpings'>
            <h2>Today's Dumpings</h2>
            <div class='dumping'>
                <img >
                <h3>Jackson Hole</h3>
            </div>
            <div class='dumping'>
                <img >
                <h3>Revelstoke</h3>
            </div>
            <div class='dumping'>
                <img >
                <h3>Big White</h3>
            </div>
            
        </div>
        <div class='posts'>
            <h2>Resort Posts</h2>";
            ?>
            <?php
                $host = "cosc360.ok.ubc.ca";
                $user = "63271324";
                $password = "63271324";
                $database = "db_63271324";

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
                    
                    $query = "SELECT * FROM posts WHERE type = 'resort' ORDER BY likes DESC";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                        
                    if ($stmt->rowCount() > 0) {
                        while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class='post'>";
                            echo "<h2>" . $post['username'] . "</h2>";
                            echo "<h3>" . $post['title'] . "</h3>";
                            echo "<h4>" . $post['type'] . "</h4>";
                            if (isset($post['post_img'])) {
                                echo "<img style='display: block;' src='../uploads/" . $post['post_img'] . "' alt='" . $post['title'] . "'>";
                            }
                            echo "<p>" . $post['content'] . "</p>";
                            echo "<p>";
                            if(isset($_SESSION['username'])){
                                echo "<form action=\"resort.php\" method=\"post\">";
                                echo "<input type='hidden' name='post_id' value='".$post['post_id']."'>";
                                echo "<button type=\"submit\" class=\"comment-button\">Comment</button>";
                                echo "</form>";
                            }    
                            echo "<button class='like-button' onClick=incrementLikes(this)>^ " . $post['likes'] . "</button></p>";
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
                } catch (PDOException $e) {
                    die($e->getMessage());
                } 
            ?>
        </div>
    </div>
</body>
