<?php
    //connects to database
    require('../db_connect.php');

    //starts session
    session_start();

    //gets ammount of entries
    $query = "SELECT * FROM `cameras`";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $rows = mysqli_num_rows($result);

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
                echo "<img src='http://" . $table[$x]["ip"] . ":" . $table[$x]["PrivatePort"] . $table[$x]["path"] . "'" . "width='" . $table[$x]["width"] . "'" . " height='" . $table[$x]["height"] . "'>";
                echo "<hr>";
            }
        ?>
        <button onclick="window.location.href='http://192.168.0.89/SecurityCam/index.php'">Logout</button> <br>
    </body>
</html>
