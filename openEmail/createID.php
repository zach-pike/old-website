<?php
    require('db_connect.php');
    $token = md5(uniqid(mt_rand(), true));

    $query = "INSERT INTO `viewedEmails` (`id`, `viewedStatus`, `token`, `enabled`) VALUES (NULL, '0', '$token', '0');";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    header("Location: track.php?token=" .  $token);

?>