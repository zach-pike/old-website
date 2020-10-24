<?php
    //starts session, gets db connection, and user id to check login
    session_start();
    require('../../db_connect.php');
    require('forumDB.php');
    $userID = $_SESSION['userID'];

    //kindly asks database if we are logged in
    $loginQuery = "SELECT * FROM `login` WHERE id='$userID'";
    $loginResult = mysqli_query($connection, $loginQuery) or die(mysqli_error($connection));
    $loginArray = mysqli_fetch_array($loginResult);

    $rowCount = mysqli_num_rows($loginResult);

    //all the fancy user shit
    $suspend = $loginArray['suspend'];
    $name = $loginArray['name'];  
    $rank = $loginArray['rank'];
    $suffix = $loginArray['suffix'];

    //da check
    if ($rowCount != 1 || $suspend != '0') {
        header("Location: ../index.php");
    }

    //adds response
    $id = $_SESSION['responseId'];
    $reply = $_GET['reply'];

    if ($id == '' || $reply == '') {
        header("Location: viewThread.php?id=" . $id);
        exit();
    }

    mysqli_query($forumConnection, "INSERT INTO `threadResponces` (`id`, `threadID`, `username`, `posterId`, `response`) VALUES (NULL, '$id', '$name', '$userID', '$reply')");
    header("Location: viewThread.php?id=" . $id);
?>