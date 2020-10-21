<?php
    session_start();
    require('../../db_connect.php');
    $name = $_SESSION['name'];
    $rank = $_SESSION['rank'];

    $query = "SELECT * FROM `login` WHERE name='$name'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);
    
    $suspend = $array['suspend'];
    $name = $array['name'];
    $rank = $array['rank'];
    $suffix = $array['suffix'];

    $count = mysqli_num_rows($result);
    if ($count != 1 || $suspend != '0') {
        header("Location: ../index.php");
    }

    //nav shit
    $NavQuery = "SELECT * FROM `NavItems`";
    $NavResult = mysqli_query($connection, $NavQuery) or die(mysqli_error($connection));
    
    while($NavData[]=mysqli_fetch_array($NavResult));
    $NavNumRows = mysqli_num_rows($NavResult);
    
    //figurest out wheter a ../ is needed
    $fileArray = explode("/", __FILE__);
    $path = $fileArray[count($fileArray)-2];
?>


<html>
    <head>
        <link rel="stylesheet" href="../../style/mainstyle.css">
        <title id="title">Comments</title>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Comments</h1>
            </div>
            <div id="content">
                <div id="nav">
                    <h3> Navigation </h3>
                    <ul>
                        <?php
                        if ($path == 'webpage') {
                                for ($i = 0; $i < $NavNumRows; $i++) {
                                    echo "<li><a href='" . $NavData[$i]['path'] . "'>" . $NavData[$i]['name'] . "</a></li>";
                                }
                            } else {
                                for ($i = 0; $i < $NavNumRows; $i++) {
                                    echo "<li><a href='../" . $NavData[$i]['path'] . "'>" . $NavData[$i]['name'] . "</a></li>";
                                }
                            }
                        ?>
                        
                    </ul>
                </div>
                <div id="main">
                    <h2>Comments</h2>
		            <p>*Note: dont put your game suggestion here, just email me, its not that hard!</p>
                    <p>Posting As... <?php echo $_SESSION['name']; if ($suffix != '') {echo " (". $suffix. ")"; if ($rank != '') { echo " Rank: " . $rank; }}?></p>
                    <form action="comment_code.php" method="GET">
                        Message: <input type="text" autocomplete="off" name="mes"><br>
                        <input type="submit" value="Post">
                    </form>
                    <hr>
                    <div id='comments'>
                        <?php
                            $read=fopen("comments.txt", "r+t");
                            while (!feof($read)) {
                                echo fread($read, 1024);
                            }
                        ?>
                </div>
            </div>
            <div id="footer">
                Copyright &copy; 2020 Zachary Pike
            </div>
        </div>
    </body>
<html>
