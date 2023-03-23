<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/header.css">
        <script src="../script/admin.js"></script>
    </head>
    <body>
    <?php include 'headers/header2.php'; ?>
    <div class="menu">
        <ul>
            <li class="navadmin" onclick="showSection('searchUsers')">Manage Users</li>
            <li class="navadmin" onclick="showSection('managePosts')">Manage Posts</li>
        </ul>
    </div>
    <div class="main">
        <div id="searchUsers" class="section">
            <h2>Search Users</h2>
            <form action='admin.php' method='POST'>
                <input type="text" placeholder="Search by name, email, or post" name="search" id="searchUser">
                <button type="submit">Search</button>
            </form>
                <?php
                    include 'shortcuts.php';
                    $pdo = connectToDatabase();
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
                        
                        $pdo = null;
                        $stmt = null;
                        $users=null;
                    
                ?>
            <!-- Display search results here -->
        </div>
        <div id="managePosts" class="section" style="display:none;">
            <h2>Manage Posts</h2>
            <!-- Display posts list with edit/remove functionality here -->
        </div>
    </div>
</body>
</html>