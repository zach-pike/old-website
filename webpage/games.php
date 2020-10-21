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
        <title>Games</title>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Games</h1>
            </div>
            <div id="content">
                <div id="nav">
                    <h3> Navigation </h3>
                    <ul>
                        <li><a href="web.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a class="selected" href="games.php">Games</a></li>
                        <li><a href="comments.php">Comments</a></li>
                        <li><a href="Forum/index.php">Forum</a></li> 
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                <div id="main">
                    <h2>Games</h2>
                    <hr>
                    <h2>Email me at Spkels29@gmail.com or zachary.pike@student.qacps.org to request for more games</h2>
                    <br>
                    <a href="../games/happywheels.php">Happy Wheels</a><br>
                    <a href="../games/supermeatboy.php">Super Meat Boy</a><br>
                    <a href="../games/catninja.php">Cat Ninja</a><br>
                    <a href="../games/bloxorz.php">Bloxorz</a><br>
                    <a href="../games/duck_life.php">Duck Life</a><br>
                    <a href="../games/duck_life_2.php">Duck Life 2</a><br>
                    <a href="../games/duck_life_3.php">Duck Life 3</a> <br>
                    <a href="../games/strike_force_heroes.php">Strike force heroes</a> <br>
                    <a href="../games/strike_force_heroes_2.php">Strike force heroes 2</a> <br>
                    <a href="../games/strike_force_heroes_3.php">Strike force heroes 3</a><br>
                    <a href="../games/sportfootball.php">Sports Heads Football: Championship</a><br>
                    <a href="../games/sportbasketball.php">Sports Heads Basketball: Championship</a><br>
                    <a href="../games/curveball.php">Curveball</a><br>
                    <a href="../games/supersmash.php">Super Smash Flash </a><br>
                    <a href="../games/minecrafttd.php">Minecraft Tower Defence</a><br>
                    <a href="../games/minicraft.php">Minicraft</a><br>
                    <a href="../games/sporticehockey.php">Sport Heads: Ice Hockey</a><br> 
                    <a href="../games/raze3.php">Raze 3</a>
                    <hr>
                </div>
            </div>
            <div id="footer">
                Copyright &copy; 2020 Zachary Pike
            </div>
        </div>
    </body>
<html>
