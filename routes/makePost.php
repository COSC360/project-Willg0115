<!DOCTYPE HTML>
<head lang="en">
    <meta charset="UTF-8">
    <title>New Post</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/makePost.css">
</head>
<header>
    <div class="header">
        <a href="home.php" class="logo"><img src="../layout_and_logic_docs/Project_logo_roughdraft.png" width="150", height="80"></a>
        <nav>
            <form action="get" method="">
                <input id="search" type="search" placeholder="Search Ski-it">
            </form>
            <ul>
                <li><a class="home" href="home.php">Home</a></li>
            </ul>
        </nav>
    </div>
</header>
<body>
    <div class="menu">
        <ul>
            <li>Account info</li>
            <li>Find People</li>
            <li>Following</li>
            <li>My Posts</li>
            <li><a id="makePost">New Post</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="post-popup">
            <form action="post.php" method="post" class="postForm">
                <h1>New Post</h1>

                <input id="subject" type="text" placeholder="subject" name="subject" required>
            
                <label for="recent">Resort </label>
                <input type="radio" name="loctype" id="resort">
                <label for="backcountry">Backcountry </label>
                <input type="radio" name="loctype" id="backcountry">
                <label for="postimage">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your Image File</label>
                <input type="file" name="postimage" accept="image/png, image/gif, image/jpeg" />
                <textarea placeholder="content"></textarea>
                <button type="submit" class="btn">Post</button>
                <a href="account.html">Cancel</a>
            </form>
        </div>

        <!-- changes based on which item in sie menu is clicked, default will be 'My Posts'-->
        <?php 
            session_start();
            $username = $_SESSION['username'];
            $host = "localhost";
            $user = "webuser";
            $pass = "P@ssw0rd";
            $database = "skiit";
            try{
                $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
            
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
                }
            }catch (PDOException $e){
                  die($e->getMessage());
            }
        ?>
        <div class="post">
            <p>Subject</p>
            <p>content</p>
        </div>
        <div class="post">
            <p>Subject</p>
            <p>content</p>
        </div>
        <div class="post">
            <p>Subject</p>
            <p>content</p>
        </div>
    </div>
</body>