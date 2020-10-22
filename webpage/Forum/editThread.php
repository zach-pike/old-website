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

    //puts the admin ids into a array
    $AdminResult = mysqli_query($connection, "SELECT * FROM `login` WHERE `fourmAdmin` = 1") or die(mysqli_error($connection));
    while($AdminData[]=mysqli_fetch_array($AdminResult)['id']);

    //actions
    if ($type == "responce") {
        //finds the owner of the comment
        $ownerQuery = "SELECT * FROM `threadResponces` WHERE `id` = $id";
        $ownerResult = mysqli_query($forumConnection, $ownerQuery) or die(mysqli_error($forumConnection));
        $ownerID = mysqli_fetch_array($ownerResult)['posterId'];

        //checks if they are allowed to delete the comment
        if ($ownerID == $userID || in_array($userID, $AdminData)) {
            mysqli_query($forumConnection, "DELETE FROM `threadResponces` WHERE `threadResponces`.`id` = $id");
        }
        //puts you back at the thread page
        header("Location: viewThread.php?id=" . $threadId);
    } else if ($type == "thread") {
        //finds owner of the thread
        $ownerQuery = "SELECT * FROM `threads` WHERE `id` = $id";
        $ownerResult = mysqli_query($forumConnection, $ownerQuery) or die(mysqli_error($forumConnection));
        $ownerID = mysqli_fetch_array($ownerResult)['posterId'];

        //checks if they are allowed to delete the thread
        if ($ownerID == $userID || in_array($userID, $AdminData)) {
            //delete the thread and all comments with the thread id
            mysqli_query($forumConnection, "DELETE FROM `threads` WHERE `threads`.`id` = $threadId");
            mysqli_query($forumConnection, "DELETE FROM `threadResponces` WHERE `threadID` = $threadId");
        }
        //puts you at the forum homepage 
        header("Location: forum.php");
        
    }
?>

