<?php
    session_start();
    require('db_connect.php');
    $name = $_SESSION['name'];

    $query = "SELECT * FROM `login` WHERE name='$name'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);
    
    $suspend = $array['suspend'];
    $name = $array['name'];    

    $count = mysqli_num_rows($result);
    if ($count != 1 || $suspend != '0') {
        header("Location: ../index.php");
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="../style/mainstyle.css">
        <link rel="icon" type="image/png" href="../favicon.ico">
        <title>About</title>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>About</h1>
            </div>
            <div id="content">
                <div id="nav">
                    <h3> Navigation </h3>
                    <ul>
                        <li><a href="web.php">Home</a></li>
                        <li><a class="selected" href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="games.php">Games</a></li>
                        <li><a href="comments.php">Comments</a></li>
                        <li><a href="Forum/index.php">Forum</a></li> 
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                <div id="main">
                    <h2>About page</h2>
                    <p>Hello, My name is Zachary Pike, I <b>LOVE</b> programming, it is my life!</p>
                    <p>Here are the main programming languages i know:</p>
                    <ul>
                        <li>HTML (not really programming more like markup language)</li>
                        <li>PHP</li>
                        <li>Python</li>
                        <li>C#</li>
                        <li>JavaScript</li>
                        <li>Node.JS</li>
                    </ul>
                </div>
            </div>
            <div id="footer">
                Copyright &copy; 2020 Zachary Pike
            </div>
        </div>
    </body>
<html>
