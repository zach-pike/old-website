<?php
    session_start();
    if ($_SESSION['login'] == '2') {
    $name = $_SESSION['name'];
    //open file to write
    $fp = fopen("../../webpage/comments.txt", "r+");
    // clear content to 0 bits
    ftruncate($fp, 0);
    fwrite($fp, "<i>$name cleared the chat</i><hr>");
    //close file
    fclose($fp);
    header("Location: ../home");
    } else {
        exit();
        header("Location: ../home");
    }
?>
