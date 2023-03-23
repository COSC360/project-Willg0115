<!DOCTYPE html>
<header>
    <?php session_start();?>
    <div class="header">
        <a href="home.php" class="logo"><img src="../layout_and_logic_docs/Project_logo_roughdraft.png" width="150", height="80"></a>
        <nav>
            <form action="get" method="">
                <input id="search" type="search" placeholder="Search Ski-it">
            </form>
            <ul>
                <li><a class="home" href="home.php">Home</a></li>
                <?php
                include 'shortcuts.php';

                if(isset($_SESSION['username'])){
                    if(isAdmin($_SESSION['username'])){
                        echo "<li><a class=\"login\" href=\"admin.php\">Admin</a></li>";
                    }else{
                        echo "<li><a class=\"login\" href=\"account.php\">My Account</a></li>";
                    }
                    echo "<li><a class=\"login\" href=\"logout.php\">Sign Out</a></li>";
                    if(isAdmin($_SESSION['username'])){
                    }
                }else{
                    echo "<li><a class=\"login\" href=\"login.html\">Log In</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>
    <div class='main'>
        <img class='background-logo' href="../../layout_and_logic_docs/Project_logo_roughdraft.png">
    </div>
</header>