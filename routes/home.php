<!DOCTYPE HTML>
<head lang="en">
    <meta charset="UTF-8">
    <title>Ski-It Project</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/home.css">
</head>
<header>
    <?php session_start();?>
    <div class="header">
        <a href="home.html" class="logo"><img src="../layout_and_logic_docs/Project_logo_roughdraft.png" width="150", height="80"></a>
        <nav>
            <form action="get" method="">
                <input id="search" type="search" placeholder="Search Ski-it">
            </form>
            <ul>
                <li><a class="home" href="home.html">Home</a></li>
                <?php
                include 'shortcuts.php';

                if(isset($_SESSION['username'])){
                    echo "<li><a class=\"login\" href=\"account.html\">My Account</a></li>";
                    echo "<li><a class=\"login\" href=\"logout.php\">Sign Out</a></li>";
                    if(isAdmin($_SESSION('username'))){
                        echo "<li><a class=\"login\" href=\"admin.php\">Admin</a></li>";
                    }
                }else{
                    echo "<li><a class=\"login\" href=\"login.html\">Log In</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
<body>
    <div class="menu">
        <ul>
            <li><input type="radio" name="filter" value="Popular"></li>
            <label for="html">Popular</label>
            <li><input type="radio" name="filter" value="Resort"></li>
            <label for="html">Resort</label>
            <li><input type="radio" name="filter" value="Back Country"></li>
            <label for="html">Back Country</label>
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
            <h2>Popular Posts</h2>
            <?php
                $host = "localhost";
                $user = "webuser";
                $password = "P@ssw0rd";
                $database = "skiit";

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
                            echo "<h2>" . $post['title'] . "</h2>";
                            echo "<h3>" . $post['type'] . "</h3>";
                            if (!empty($post['post_img'])) {
                                echo "<img src='" . $post['post_img'] . "' alt='" . $post['title'] . "'>";
                            }
                            echo "<p>" . $post['content'] . "</p>";
                            echo "<p><button class='like-button' onClick=incrementLikes(this)>^ " . $post['likes'] . "</button></p>";
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