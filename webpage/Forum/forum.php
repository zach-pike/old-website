<?php
    //starts session, gets db connection, and user id to check login
    session_start();
    require('../../db_connect.php');
    require('forumDB.php');
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

    //start of forum stuff
    //gets all threads
    $ThreadQuery = "SELECT * FROM `threads`";
    $ThreadResult = mysqli_query($forumConnection, $ThreadQuery) or die(mysqli_error($forumConnection));

    while($ThreadData[]=mysqli_fetch_array($ThreadResult));
    $ThreadNumRows = mysqli_num_rows($ThreadResult);
    //end of forum stuff

    //nav shit
    $NavQuery = "SELECT * FROM `NavItems`";
    $NavResult = mysqli_query($connection, $NavQuery) or die(mysqli_error($connection));

    while($NavData[]=mysqli_fetch_array($NavResult));
    $NavNumRows = mysqli_num_rows($NavResult);

    //figurest out wheter a ../ is needed
    $fileArray = explode("/", __FILE__);
    $path = $fileArray[count($fileArray)-2];
?>
<html>
    <head>
        <link rel="stylesheet" href="../../../style/mainstyle.css">
        <title id="title">Forum</title>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Forum</h1>
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
                    <form action="search.php" method="get">
                        <input name="query" autocomplete="off" type="text" placeholder="Search for thread..." maxlength="120" size="35">
                        <input type="submit">
                    </form>
                    <hr>
                    <h1>Post new thread...</h1>
                    <form action="makeThread.php" method="get">
                        <input type="text" name="threadName" placeholder="Thread title..." maxlength="120" size="60" autocomplete="off">
                        <input type="text" name="threadText" placeholder="Thread text..." maxlength="600" size="60" cols="40" autocomplete="off"><br>
                        <input type="submit">
                    </form>
                    <hr>
                    <h2>Recent threads...</h2>
                    <?php
                        //displays the recent threads
                        for ($x = $ThreadNumRows-1; $x >= 0; $x--) {
                            echo '<h3><a href="viewThread.php?id=' . $ThreadData[$x]['id'] . '"' . '>' . $ThreadData[$x]['threadTitle'] . '</a></h3>';
                            echo "By: " . $ThreadData[$x]['username'];
                            echo "<hr>";
                        }
                    ?>
                </div>
            </div>
            <div id="footer">
                Copyright &copy; 2020 Zachary Pike
            </div>
        </div>
    </body>
<html>
