<head>
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, intial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
</head>
<header>
    <?php session_start();?>
    <div class="header-container">
            <a href="home.php" class="logo"><img src="../layout_and_logic_docs/Project_logo_roughdraft.png" width="150" height="80" alt="Logo"></a>
            <nav>
                <form action="searchpost.php" method="POST">
                    <input id="search" type="search" placeholder="Search Ski-it" name="search">
                </form>
                <ul>
                    <li><a class="home" href="home.php">Home</a></li>
                    <?php
                    include 'shortcuts.php';

                    if (isset($_SESSION['username'])) {
                        if (isAdmin($_SESSION['username'])) {
                            echo "<li><a class=\"login\" href=\"admin.php\">Admin</a></li>";
                        } else {
                            echo "<li><a class=\"login\" href=\"account.php\">My Account</a></li>";
                        }
                        echo "<li><a class=\"login\" href=\"logout.php\">Sign Out</a></li>";
                    } else {
                        echo "<li><a class=\"login\" href=\"login.php\">Log In</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    
</header>
<div id="backgroundlogo"></div>
