<!DOCTYPE HTML>
<head lang="en">
    <meta charset="UTF-8">
    <title>Create Account Page</title>
    <link rel="stylesheet" href="../css/create.css">
    <script type="text/javascript" src="../script/create.js"></script>
</head>
<header>
    <div>
        <a href="home.php"><img src="../layout_and_logic_docs/Project_logo_roughdraft.png"/></a>
    </div>
</header>
<body>
    <form id="createForm" action="processcreate.php" method="post">
        <table>
            <tr>
                <td colspan="2"><?php 
                    session_start();
                    if(isset($_SESSION['error_message'])){
                        echo "<h4 style='color: red; '>" . $_SESSION['error_message'] . "</h4>";
                    }
                ?></td>
            </tr>
            <tr>
                <td colspan="3"><input class="required" type="text" placeholder="First Name" name="firstName"></td>
            </tr>
            <tr>
                <td colspan="3"><input class="required" type="text" placeholder="Last Name" name="lastName"></td>
            </tr>
            <tr>
                <td colspan="3"><input class="required" type="text" placeholder="Username" name="username"></td>
            </tr>
            <tr>
                <td colspan="3"><input class="required" type="email" placeholder="Email" name="email"></td>
            </tr>
            <tr>
                <td colspan="3"><input class="required" type="password" name="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td colspan="3"><input class="required" type="password" name="confirm" placeholder="Confirm Password"></td>
            </tr>
            <tr>
                <td colspan="3"><button type="submit" id="register">Register</button></td>
            </tr>
            <tr>
                <td>Already Have an account? </td>
                <td colspan="2"><a href='login.php' id="register">Login</a></td>
            </tr>
        </table>
    </form>       
</body>