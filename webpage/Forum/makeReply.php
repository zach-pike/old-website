<?php
    session_start();
    require('forumDB.php'); //fourm db

    require('../../db_connect.php'); //website db
    $name = $_SESSION['name']; 

    //login check
    $query = "SELECT * FROM `login` WHERE name='$name'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);
    $suspend = $array['suspend'];
    $userID = $array['id'];
    $count = mysqli_num_rows($result);
    if ($count != 1 || $suspend != '0') {
        header("Location: ../../index.php");
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