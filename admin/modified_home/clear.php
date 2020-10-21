<?php
    session_start();
    if ($_SESSION['login'] == '1') {
    $name = $_SESSION['name'];
    //open file to write
    $fp = fopen("../../webpage/comments.txt", "r+");
    // clear content to 0 bits
    ftruncate($fp, 0);
    //close file
    fwrite($fp, "<i>$name cleared the chat </i><hr>");
    fclose($fp);
    header("Location: index.php");
    } else {
        exit();
        header("Location: index.php");
    }
?>




