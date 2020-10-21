<?php
    session_start();
    require('forumDB.php'); //forum db
    require('../db_connect.php'); //website db
    $name = $_SESSION['name'];

    //login check
    $query = "SELECT * FROM `login` WHERE name='$name'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);
    $suspend = $array['suspend'];
    $name = $array['name'];
    $count = mysqli_num_rows($result);
    if ($count != 1 || $suspend != '0') {
        header("Location: ../../index.php");
    }


    //makes new threads
    $threadName = $_GET['threadName'];
    $threadText = $_GET['threadText'];

    if ($threadName == '' || $threadText == '') {
        header("Location: index.php");
        exit();
    }

    //make thread
    $test = mysqli_query($forumConnection, "INSERT INTO `threads` (`id`, `username`, `threadTitle`, `text`) VALUES (NULL, '$name', '$threadName', '$threadText')");

    $getIdQuery = "SELECT * FROM `threads` WHERE username='$name' and threadTitle='$threadName' and text='$threadText'";
    $Idresult = mysqli_query($forumConnection, $getIdQuery) or die(mysqli_error($connection));
    $IDarray = mysqli_fetch_array($Idresult);
    header("Location: viewThread.php?id=" . $IDarray['id']);
?>