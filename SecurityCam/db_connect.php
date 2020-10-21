<?php
    $connection = mysqli_connect('localhost', 'root', '3.141592653');
    if (!$connection){
        die("Database Connection Failed" . mysqli_error($connection));
    }
    $select_db = mysqli_select_db($connection, 'camera');
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error($connection));
    }
?>
