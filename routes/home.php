<!DOCTYPE HTML>
<head lang="en">
    <meta charset="UTF-8">
    <title>Ski-It Project</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/home.css">
</head>
<?php include 'headers/header1.php'; ?>
<style>
/* styling taken from https://pajasevi.github.io/CSSnowflakes/ */
.snowflake {
  color: #fff;
  font-size: 1em;
  font-family: Arial, sans-serif;
  text-shadow: 0 0 5px #000;
}

@-webkit-keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@-webkit-keyframes snowflakes-shake{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}50%{-webkit-transform:translateX(80px);transform:translateX(80px)}}@keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@keyframes snowflakes-shake{0%,100%{transform:translateX(0)}50%{transform:translateX(80px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:default;-webkit-animation-name:snowflakes-fall,snowflakes-shake;-webkit-animation-duration:10s,3s;-webkit-animation-timing-function:linear,ease-in-out;-webkit-animation-iteration-count:infinite,infinite;-webkit-animation-play-state:running,running;animation-name:snowflakes-fall,snowflakes-shake;animation-duration:10s,3s;animation-timing-function:linear,ease-in-out;animation-iteration-count:infinite,infinite;animation-play-state:running,running}.snowflake:nth-of-type(0){left:1%;-webkit-animation-delay:0s,0s;animation-delay:0s,0s}.snowflake:nth-of-type(1){left:10%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s}.snowflake:nth-of-type(2){left:20%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s}.snowflake:nth-of-type(3){left:30%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s}.snowflake:nth-of-type(4){left:40%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s}.snowflake:nth-of-type(5){left:50%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s}.snowflake:nth-of-type(6){left:60%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s}.snowflake:nth-of-type(7){left:70%;-webkit-animation-delay:2.5s,1s;animation-delay:2.5s,1s}.snowflake:nth-of-type(8){left:80%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s}.snowflake:nth-of-type(9){left:90%;-webkit-animation-delay:3s,1.5s;animation-delay:3s,1.5s}.snowflake:nth-of-type(10){left:25%;-webkit-animation-delay:2s,0s;animation-delay:2s,0s}.snowflake:nth-of-type(11){left:65%;-webkit-animation-delay:4s,2.5s;animation-delay:4s,2.5s}
</style>
<div class="snowflakes" aria-hidden="true">
  <div class="snowflake">
  ❅
  </div>
  <div class="snowflake">
  ❆
  </div>
  <div class="snowflake">
  ❅
  </div>
  <div class="snowflake">
  ❆
  </div>
  <div class="snowflake">
  ❅
  </div>
  <div class="snowflake">
  ❆
  </div>
  <div class="snowflake">
    ❅
  </div>
  <div class="snowflake">
    ❆
  </div>
  <div class="snowflake">
    ❅
  </div>
  <div class="snowflake">
    ❆
  </div>
  <div class="snowflake">
    ❅
  </div>
  <div class="snowflake">
    ❆
  </div>
</div>
<body>
    <div class="menu">
        <ul>
            <li class="navmenu"><a href='home.php'>Popular</a></li>
            <li class="navmenu"><a href='resort.php'>Resort</a></li>
            <li class="navmenu"><a href='backcountry.php'>Backcountry</a></li>
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
                echo "<a href='home.php'>Cancel</a></div>";      
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
            <h2>Popular Posts</h2>";
            ?>
            <?php
                $host = "cosc360.ok.ubc.ca";
                $user = "63271324";
                $password = "63271324";
                $database = "db_63271324";

                $minLikes = 10;

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
                
                    $query = "SELECT * FROM posts WHERE likes >= ? ORDER BY likes DESC";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindValue(1, $minLikes);
                    $stmt->execute();
                
                    if ($stmt->rowCount() > 0) {
                        while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class='post'>";
                            echo "<h2>" . $post['username'] . "</h2>";
                            echo "<h3>" . $post['title'] . "</h3>";
                            echo "<h4>" . $post['type'] . "</h4>";
                            if (!empty($post['post_img'])) {
                                echo "<img src='../uploads/" . $post['post_img'] . "' alt='" . $post['title'] . "'>";
                            }
                            echo "<p>" . $post['content'] . "</p>";
                            if(isset($_SESSION['username'])){
                                echo "<form action=\"resort.php\" method=\"post\">";
                                echo "<input type='hidden' name='post_id' value='".$post['post_id']."'>";
                                echo "<button type=\"submit\" class=\"comment-button\">Comment</button>";
                                echo "</form>";
                            }    
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
                    } else {
                        echo "No posts found with a minimum of $minLikes likes.";
                    }
                    $pdo = null;
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
            ?>
        </div>
    </div>
</body>