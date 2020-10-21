<?php
    session_start();
    require('forumDB.php'); //forum db
    require('../db_connect.php'); //website db
    $name = $_SESSION['name'];

    //gets search
    $searchQuery = $_GET['query'];

    //login check
    $query = "SELECT * FROM `login` WHERE name='$name'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);    
    $suspend = $array['suspend'];
    $count = mysqli_num_rows($result);
    if ($count != 1 || $suspend != '0') {
        header("Location: ../../index.php");
    }

    //gets all threads from search
    $ThreadQuery = "SELECT * FROM `threads` WHERE threadTitle LIKE '%$searchQuery%'";
    $ThreadResult = mysqli_query($forumConnection, $ThreadQuery) or die(mysqli_error($connection));

    //gets searched threads
    while($ThreadData[]=mysqli_fetch_array($ThreadResult));
    //gets number of results
    $ThreadNumRows = mysqli_num_rows($ThreadResult);

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
        <link rel="stylesheet" href="../../../style/mainstyle.css">
        <title id="title">Search Forum</title>
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
                    <form action="search.php" method="get">
                        <input name="query" autocomplete="off" type="text" placeholder="Search for thread..." maxlength="120" size="35">
                        <input type="submit">
                    </form>
                    <hr>
                    <?php
                        echo "<h2>Found " . $ThreadNumRows . " Result(s)</h2>";
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
