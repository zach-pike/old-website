<?php
    $token = $_GET['token'];
    require('db_connect.php');

    $query = "SELECT * FROM `viewedEmails` WHERE `token` = '$token'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $arr = mysqli_fetch_array($result);
?>
<html>
    <head>
        <title>
            Track Email...
        </title>
        <style>
            body {
                font-family: "Arial";
            }
        </style>
    </head>
    <body>
        <h1>your tracking key is: <?php echo $token; ?></h1>
        <hr>
        <p>the picture link is: http://209.203.209.163/openEmail/pic.php?token=<?php echo $token; ?> </p>
        <?php
            if ($arr['enabled'] == "0") { 
                echo "<p>once you send the email, click this button:</p>";
                echo "<button onclick=" . '"' . "window.location.href=" . "'" . "enable.php?token=" . $token . "'" . '"' . ">Enable</button>";
            }
            if ($arr['viewedStatus'] == "0") {
                echo "<h3>Reciver hasnt not opened email yet.</h3><br>";
            } else {
                echo "<h3>Reciver has opened email.</h3><br>";
                echo "<button onclick=" . '"' . "window.location.href=" . "'" . "reset.php?token=" . $token . "'" . '"' . ">Reset</button>";
            }
        ?>
    </body>
</html>