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

    //makes new threads
    $threadName = $_GET['threadName'];
    $threadText = $_GET['threadText'];

    if ($threadName == '' || $threadText == '') {
        header("Location: index.php");
        exit();
    }

    //make thread
    $test = mysqli_query($forumConnection, "INSERT INTO `threads` (`id`, `username`, `posterId`, `threadTitle`, `text`) VALUES (NULL, '$name', '$userID', '$threadName', '$threadText');");

    $getIdQuery = "SELECT * FROM `threads` WHERE username='$name' and threadTitle='$threadName' and text='$threadText'";
    $Idresult = mysqli_query($forumConnection, $getIdQuery) or die(mysqli_error($forumConnection));
    $IDarray = mysqli_fetch_array($Idresult);
    header("Location: viewThread.php?id=" . $IDarray['id']);
?>