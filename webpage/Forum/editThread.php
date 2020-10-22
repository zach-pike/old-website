<?php
    session_start();
    require('forumDB.php'); //login connec
    require('../../db_connect.php'); //forum db connect
    $name = $_SESSION['name'];

    $type = $_GET['type']; //gets type
    $id = $_GET['id']; //gets responce id 
    //saves the thread id in the session
    $threadId = $_SESSION['responseId'];

    //login check
    $query = "SELECT * FROM `login` WHERE name='$name'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);
    $suspend = $array['suspend']; 
    $userID = $array['id'];
    $count = mysqli_num_rows($result);
    if ($count != 1 || $suspend != '0') {
        header("Location: ../../index.php");
        exit();
    }

    if ($type == "responce") {
        $ownerQuery = "SELECT * FROM `threadResponces` WHERE `id` = $id";
        $ownerResult = mysqli_query($forumConnection, $ownerQuery) or die(mysqli_error($forumConnection));
        $ownerID = mysqli_fetch_array($ownerResult)['posterId'];
        if ($ownerID == $userID) {
            mysqli_query($forumConnection, "DELETE FROM `threadResponces` WHERE `threadResponces`.`id` = $id");
        }
        header("Location: viewThread.php?id=" . $threadId);
    } else if ($type == "thread") {
        $ownerQuery = "SELECT * FROM `threads` WHERE `id` = $id";
        $ownerResult = mysqli_query($forumConnection, $ownerQuery) or die(mysqli_error($forumConnection));
        $ownerID = mysqli_fetch_array($ownerResult)['posterId'];
        if ($ownerID == $userID) {
            mysqli_query($forumConnection, "DELETE FROM `threads` WHERE `threads`.`id` = $threadId");
            mysqli_query($forumConnection, "DELETE FROM `threadResponces` WHERE `threadID` = $threadId");
        }
        header("Location: forum.php");
        
    }
?>

