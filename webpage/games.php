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

    //nav shit
    $NavQuery = "SELECT * FROM `NavItems`";
    $NavResult = mysqli_query($connection, $NavQuery) or die(mysqli_error($connection));

    while($NavData[]=mysqli_fetch_array($NavResult));
    $NavNumRows = mysqli_num_rows($NavResult);

    //figurest out wheter a ../ is needed
    $fileArray = explode("/", __FILE__);
    $path = $fileArray[count($fileArray)-2];

    $AppQuery = "SELECT * FROM `NavItems` WHERE `path` LIKE '%$path%'";
    $AppResult = mysqli_query($connection, $AppQuery) or die(mysqli_error($connection));

    $app = mysqli_fetch_array($AppResult)['app'];
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
                        <?php
                            if ($app == null) {
                                for ($i = 0; $i < $NavNumRows; $i++) {
                                    echo "<li><a href='" . $NavData[$i]['path'] . "'>" . $NavData[$i]['name'] . "</a></li>";
                                }
                            } else {
                                for ($i = 0; $i < $NavNumRows; $i++) {
                                    echo "<li><a href='../" . $NavData[$i]['path'] . "'>" . $NavData[$i]['name'] . "</a></li>";
                                }
                            }
                        ?>
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
