<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<style>
    #search-container{
        top: 100px;
    }
</style>
<body>
    <?php
        include('headers/header2.php'); ?>
    <div class="menu">
    </div>
    <div class="main">
    <?php
        include('dbConnection.php');
        if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['search'])){
                    

            echo "<br><h2>Search results: </h2><br>";
            $sql = "SELECT * FROM posts WHERE username LIKE ? OR title LIKE ? OR content LIKE ?;";
            $search = '%'.$_POST['search'].'%';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $search);
            $stmt->bindValue(2, $search);
            $stmt->bindValue(3, $search);
            $stmt->execute();
        }else{
            echo "<br><h2>All Posts: </h2><br>";
            $sql = "SELECT * FROM posts;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
        if ($stmt->rowCount() > 0) {
            while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div id='post'>";
                echo "<h2 id='post-title'>" . $post['title'] . "</h2>";
                echo "<h3 id='post-info'>" . $post['type'] . "</h3>";
                if (!empty($post['post_img'])) {
                    echo "<img src='../uploads/" . $post['post_img'] . "' alt='" . $post['title'] . "'>";
                }
                echo "<p id='post-content'>" . $post['content'] . "</p>";
                echo "<p ><button id='like-button' class='like-button' onClick=incrementLikes(this)>^ " . $post['likes'] . "</button></p>";
                echo "<p><form action='admin/deletepost.php' method='POST'>";
                echo "<input type='hidden' name='post_id' value='" . $post['post_id'] . "'>";
                echo "<input type='submit' id='delete-button' value='Delete'>";
                echo "</form></p>";
                echo "</div>";
            }
            $post = null;
        }
        $stmt = null;
    ?>
    </div>
</body>
