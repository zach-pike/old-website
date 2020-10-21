<?php
    //connect to database
    require('../db_connect.php');

    //start session
    session_start();

    //gets the ammount of entries
    $query = "SELECT * FROM `cameras`";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $rows = mysqli_num_rows($result);
    
    //puts table into array
    while($table[]=mysqli_fetch_array($result));

    if ($_SESSION['name'] == "") {
        header("Location: ../index.php");
    }
?>
<html>
    <head>
        <title>
            Camera Feeds
        </title>
        <style>
            body {
                font-family: "Arial";
            }
        </style>
    </head>
    <body>
        <p>Camera Feeds:</p>
        <hr>
        <?php
            //displays cameras 
            for ($x = 0; $x < $rows; $x++) {
                echo "<p>" . $table[$x]['CameraName']. "</p>";
                echo "<img src='http://209.203.209.163:" . $table[$x]["PublicPort"] . $table[$x]["path"] . "'" . "width='" . $table[$x]["width"] . "'" . " height='" . $table[$x]["height"] . "'>";
                echo "<hr>";
            }
        ?>
        <button onclick="window.location.href='http://209.203.209.163/SecurityCam/index.php'">Logout</button> <br>
    </body>
</html>
