<?php
    //starts session, gets db connection, and user id to check login
    session_start();
    require('../../db_connect.php');
    $userID = $_SESSION['userID'];

    //kindly asks database if we are logged in
    $loginQuery = "SELECT * FROM `login` WHERE id='$userID'";
    $loginResult = mysqli_query($connection, $loginQuery) or die(mysqli_error($connection));
    $loginArray = mysqli_fetch_array($loginResult);

    $rowCount = mysqli_num_rows($loginResult);

    //all the fancy user shit
    $suspend = $loginArray['suspend'];
    $name = $loginArray['name'];  
    $rank = $loginArray['rank'];
    $suffix = $loginArray['suffix'];

    //da check
    if ($rowCount != 1 || $suspend != '0') {
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

    //nav shit
    $GameQuery = "SELECT * FROM `GameItems`";
    $GameResult = mysqli_query($connection, $GameQuery) or die(mysqli_error($connection));

    while($GameData[]=mysqli_fetch_array($GameResult));
    $GameNumRows = mysqli_num_rows($GameResult);
?>
<html>
    <head>
        <link rel="stylesheet" href="../../style/mainstyle.css">
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
                            if ($path == 'webpage') {
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
                    <ul>
                        <?php
                            for ($i = 0; $i < $GameNumRows; $i++) {
                                echo "<li><a href='gameLoader.php?file=" . $GameData[$i]['path'] . "'>" . $GameData[$i]['name'] . "</a></li>";
                            }
                        ?>
                    </ul>
                    <hr>
                </div>
            </div>
            <div id="footer">
                Copyright &copy; 2020 Zachary Pike
            </div>
        </div>
    </body>
<html>
