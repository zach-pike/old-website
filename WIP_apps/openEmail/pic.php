<?php
    $token = $_GET['token'];
    require('db_connect.php');

    $enabledQuery = "SELECT * FROM `viewedEmails` WHERE `token` = '$token'";
    $enabledResult = mysqli_query($connection, $enabledQuery) or die(mysqli_error($connection));
    $arr = mysqli_fetch_array($enabledResult);

    if ($arr['enabled'] == "1") {
        $query = "UPDATE `viewedEmails` SET `viewedStatus` = '1' WHERE `viewedEmails`.`token` = '$token';";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    }
    header('Content-Type: image/png');
    echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');
?>