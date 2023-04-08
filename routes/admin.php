<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/header.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="../script/admin.js"></script>
        
    </head>
    <style>
        .adminsearch {
            width: 100%;
            max-width: 600px;
            padding: 12px 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f8f8f8;
            transition: all 0.3s;
        }
        .adminsearch:focus {
            outline: none;
            border: 1px solid #4a8dff;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(74, 141, 255, 0.5);
        }
        .searchbutton{
            font-size: 16px;
            padding: 12px 20px;
            border: 1px solid black;
            border-radius: 10px;
        }
        .searchbutton:hover{
            outline: none;
            border: 1px solid #4a8dff;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(74, 141, 255, 0.5);
        }

    </style>
    <?php    
    ?>
    <body>
    <?php include 'headers/header2.php';    ?>
    <div class="menu">
        <ul>
            <li class="navadmin" onclick="showSection('searchUsers')">Manage Users</li>
            <li class="navadmin" onclick="showSection('managePosts')">Manage Posts</li>
            <li class="navadmin" onclick="showSection('userCharts')">User Charts</li>
            <a href="account.php"><li class="navadmin">User Account</li></a>
        </ul>
    </div>
    <div class="main">
        <div id="searchUsers" class="section">
            <h2>Search Users</h2>
            <form action='admin.php' method='POST'>
                <input type="text" placeholder="Search by name, email, or post" name="search" class="adminsearch">
                <button class = "searchbutton" type="submit">Search</button>
            </form>
                <?php
                    include('dbConnection.php');

                    if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['search'])){
                        echo "<br><h2>Results of search:</h2><br>";
                        $sql = "SELECT u.* FROM users u LEFT JOIN posts ON u.username=posts.username WHERE u.username LIKE ? OR email LIKE ? OR content LIKE ? OR title LIKE ?";
                        $stmt = $pdo->prepare($sql);
                        $input = $_POST["search"];
                        $stmt->bindValue(1, $input);
                        $stmt->bindValue(2, $input);
                        $stmt->bindValue(3, $input);
                        $stmt->bindValue(4, $input);
                        $stmt->execute();
                    }else{
                        echo "<br><h2>All users:</h2><br>";
                        $sql = "SELECT * FROM users;";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                    }
                        $users = $stmt->fetchAll();
                            echo "<table>";
                            echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Registration Date</th><th>Role</th><th>Manage Access</th></tr>";
                            foreach($users as $user){
                                echo "<tr>";
                                echo "<td>" .$user['username']. "</td>";
                                echo "<td>" .$user['firstName']. "</td>";
                                echo "<td>" .$user['lastName']. "</td>";
                                echo "<td>" .$user['email']. "</td>";
                                echo "<td>" .$user['registration_date']. "</td>";
                                echo "<td>" .$user['role']. "</td>";
                                echo "<td><form action='admin/changestate.php' method='POST'>";
                                echo "<input type='hidden' name='username' value='".$user['username']."'>";
                                echo "<input type='hidden' name='state' value='".$user['state']."'>"; 
                                echo "<input type='submit' value='".($user['state'] == 'able'? 'Disable': 'Enable')."'>";
                                echo "</form></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "<a href='admin.php'><h3>Display all users</h3></a>";
                        
                        
                        $stmt = null;
                        $users=null;
                    
                ?>
        </div>
        <div id="managePosts" class="section" style="display:none;">
            <h2>Search Posts</h2>
            <form action='admin.php' method='POST'>
                <input type="text" placeholder="Search by name, post or grouping" name="search" class="adminsearch">
                <button class = "searchbutton" type="submit">Search</button>
            </form>
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
                        $sql = "SELECT profile_img FROM users WHERE username = ? ";
                        $statement = $pdo->prepare($sql);
                        $statement->bindValue(1, $post['username']);
                        $statement->execute();
                        if($statement->rowCount()>0){
                            $profilePath = $statement->fetch(PDO::FETCH_ASSOC)['profile_img'];
                            echo "<img id='profile-img' src='../profile_img/$profilePath'>";
                        }
                        echo "<h2 id='user'>" . $post['username'] . "</h2>";
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
        <div id="userCharts" class="section" style="display:none;">
            <h2>User Charts</h2>
            <div id="chart_div"><h3></h3></div>
            <div id="postChart"></div>
            <div id="commentChart"></div>
        </div>
    </div>
    
</body>
</html>