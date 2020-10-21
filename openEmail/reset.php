<?php    
    $token = $_GET['token'];
    require('db_connect.php');

    $query = "UPDATE `viewedEmails` SET `enabled` = '0' WHERE `viewedEmails`.`token` = '$token';";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    $query = "UPDATE `viewedEmails` SET `viewedStatus` = '0' WHERE `viewedEmails`.`token` = '$token';";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    header("Location: track.php?token=" . $token);
?>