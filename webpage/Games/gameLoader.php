<?php
    //starts session, gets db connection, and user id to check login
    session_start();
    require('../../db_connect.php');
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
?>
<a href="games.php">Back</a>
<embed src="../../media/flash/<?php echo $_GET['file']; ?>" width="750" height="600">
