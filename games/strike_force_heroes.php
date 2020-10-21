<link rel="icon" type="image/png" href="../favicon.ico">
<?php
    session_start();
    require('db_connect.php');
    $name = $_SESSION['name'];

    $query = "SELECT * FROM `login` WHERE name='$name'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);
    
    $suspend = $array['suspend'];
    $name = $array['name'];    

    $count = mysqli_num_rows($result);
    if ($count != 1 || $suspend != '0') {
        header("Location: ../index.php");
    }
?>
<a href="../webpage/games.php">Back</a>
<embed src="../media/flash/strike-force-heroes-1.swf" width="750" height="600">