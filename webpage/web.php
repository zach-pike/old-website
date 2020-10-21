<?php
    session_start();
    require('db_connect.php');
    $name = $_SESSION['name'];

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
?>
<html>
    <head>
        <script src="../scripts/main.js"></script>
        <link rel="stylesheet" href="../style/mainstyle.css">
        <link rel="icon" type="image/png" href="../favicon.ico">
        <title id="title">Home</title>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Welcome</h1>
            </div>
            <div id="content">
                <div id="nav">
                    <h3> Navigation </h3>
                    <ul>
                        <li><a class="selected" href="web.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="games.php">Games</a></li>   
                        <li><a href="comments.php">Comments</a></li>
                        <li><a href="Forum/index.php">Forum</a></li>                     
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                <div id="main">
                    <h2>Home Page</h2>
                    <h3>Welcome... <?php echo $name; if($suffix != "") { echo " (". $suffix. ")"; if ($rank != '') { echo " Rank: ". $rank; } }?></h3>
                    <p>Hello, my name is Zachary Pike and <i>well</i> this is my website if you want to know more, go to the about page!</p>
                    <div id="img"><img src="../media/falling_off_bed.JPG" width="160" height="160"></div>
                </div>
            </div>
            <div id="footer">
                Copyright &copy; 2020 Zachary Pike
            </div>
        </div>
    </body>
<html>
