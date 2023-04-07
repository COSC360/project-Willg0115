<!DOCTYPE HTML>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login page</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<header>
    <div>
        <a href="home.php"><img src="../layout_and_logic_docs/Project_logo_roughdraft.png"/></a>
    </div>
</header>
<body>
    <table>
        <form action="processlogin.php" method="POST">
            <tr>
                <td colspan="2"><?php 
                    session_start();
                    if(isset($_SESSION['error_message'])){
                        echo "<h4 style='color: red; '>" . $_SESSION['error_message'] . "</h4>";
                    }
                ?></td>
            </tr>
            <tr>
                <td colspan="2"><input type="text" placeholder="Username" name="username" required></td>
            </tr>
            
            <tr>
                <td colspan="2"><input type="password" placeholder="Password" name="password" required></td>
            </tr>
            <tr>
                <td><a href=#ForgotPassword>forget password?</a></td>
                <td><button type="submit" id="login">login</button></td>
            </tr>
        </form>
            <tr>
                <td colspan="2"><a href="create.php"><button id="signUp">Sign Up</button></a></td>
            </tr>
    </table>
</body>