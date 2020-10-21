<?php
    require("../../creds.php");
    $forumConnection = mysqli_connect('localhost', $user, $password);
    if (!$forumConnection){
        die("Database Connection Failed" . mysqli_error($forumConnection));
    }
    $select_db = mysqli_select_db($forumConnection, 'forum');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($forumConnection));
    }
?>
