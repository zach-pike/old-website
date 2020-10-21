<?php
    session_start();
    require('../db_connect.php');
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
?>
<html>
    <head>
        <link rel="stylesheet" href="../style/mainstyle.css">
        <link rel="icon" type="image/png" href="../favicon.ico">
        <title>Images</title>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Images of me/or taken by me</h1>
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
                    <h2>Images</h2>
                    <img src="../media/hand_up.jpg" width="256" height="144">
                    <img src="../media/lake.jpg" width="386" length="515">
                    <img src="../media/bus_vlogging.jpg" width="322" length="429">
                    <img src="../media/horn_diwhy.jpg" width="322" length="429" >
                    <img src="../media/silly_picture.jpg" width="269" length="202">
                </div>
            </div>
            <div id="footer">
                Copyright &copy; 2020 Zachary Pike
            </div>
        </div>
    </body>
<html>
