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
            <li><a href='accountinfo.php'>Account info</a></li>
            <li><a href='account.php'>My Posts</a></li>
            <li><a id="makePost" href="makePost.php">New Post</a></li>
        </ul>
    </div>
    <div class="main">
        <?php
            include 'shortcuts.php';
            session_start();
            $username = $_SESSION['username'];

            $pdo = connectToDatabase();

            $query = "SELECT lastName, firstName, email FROM users WHERE username = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(1, $username);
            $stmt->execute();
            $results = $stmt->fetch();

            $firstname = $results['firstName'];
            $lastname = $results['lastName'];
            $email = $results['email'];
             
        ?>
        <form id="createForm" action="editAccount.php" method="post">
            <h2>First Name</h2>
            <input class="required" type="text" <?php echo "value='$firstname'"; ?> name="firstName">
            <h2>Last Name</h2>
            <input class="required" type="text" <?php echo "value='$lastname'"; ?> name="lastName">
            <h2>Username</h2>
            <input class="required" type="text" <?php echo "value='$username'"; ?> name="username">
            <h2>Email</h2>
            <input class="required" type="email" <?php echo "value='$email'"; ?> name="email">

            <button type="submit" id="register">Update Info</button>
        </form>       
    </div>
</body>