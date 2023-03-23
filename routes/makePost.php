<!DOCTYPE HTML>
<head lang="en">
    <meta charset="UTF-8">
    <title>New Post</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/makePost.css">
</head>
<?php include 'headers/header2.php'; ?>
<body>
    <div class="menu">
        <ul>
            <li><a href='accountinfo.php'>Account info</a></li>
            <li><a href='account.php'>My Posts</a></li>
            <li><a id="makePost">New Post</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="post-popup">
            <form action="post.php" method="post" class="postForm" enctype="multipart/form-data"> 
                <h1>New Post</h1>

                <input id="subject" type="text" placeholder="subject" name="subject" required>
            
                <label for="recent">Resort </label>
                <input type="radio" name="loctype" id="resort" value="resort">
                <label for="backcountry">Backcountry </label>
                <input type="radio" name="loctype" id="backcountry" value="backcountry">
                <label for="postimage">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your Image File</label>
                <input type="file" name="postimage" accept="image/png, image/gif, image/jpeg" />
                <textarea placeholder="content" name="content" required></textarea>
                <button type="submit" class="btn">Post</button>
                <a href="account.html">Cancel</a>
            </form>
        </div>

        <!-- changes based on which item in sie menu is clicked, default will be 'My Posts'-->
        <?php 
            session_start();
            $username = $_SESSION['username'];
            include 'shortcuts.php';
            $pdo = connectToDatabase();
            
            $query = "SELECT * FROM posts WHERE username = ? ORDER BY post_date DESC";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, $username);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='post'>";
                    echo "<h2>" . $post['title'] . "</h2>";
                    echo "<h3>" . $post['type'] . "</h3>";
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
            }else {
                echo "You have no posts";
            }   
        ?>
    </div>
</body>