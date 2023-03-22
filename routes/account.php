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
            <li>Account info</li>
            <li>Find Users</li>
            <li>My Posts</li>
            <!-- <li><button id="makePost" onclick="makePost()">New Post</button></li> -->
            <li><a id="makePost" href="makePost.html">New Post</a></li>
        </ul>
    </div>
    <div class="main">
        <!-- changes based on which item in sie menu is clicked, default will be 'My Posts'-->
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
        <div class="post-popup">
            <form action="" class="postForm">
                <h1>New Post</h1>
                
                <input type="text" placeholder="subject" name="subject" required>

                <label for="recent">Resort </label>
                <input type="radio" name="loctype" id="resort">
                <label for="backcountry">Backcountry </label>
                <input type="radio" name="loctype" id="backcountry">

                <textarea placeholder="content"></textarea>
            
                <button type="submit" class="btn">Post</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
            </form>
          </div>
    </div>
</body>