<?php
    session_start();
    require('forumDB.php'); //login connec
    require('../../db_connect.php'); //forum db connect
    $name = $_SESSION['name'];
    $id = $_GET['id']; //gets id 
    //saves the thread id in the session
    $_SESSION['responseId'] = $id;

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

    //beginning of thread stuff

    //gets data for the post
    $ThreadQuery = "SELECT * FROM `threads` WHERE id='$id'";
    $ThreadResult = mysqli_query($forumConnection, $ThreadQuery) or die(mysqli_error($forumConnection));

    //gets all comments
    $ResponseQuery = "SELECT * FROM `threadResponces` WHERE threadID='$id'";
    $ResponseResult = mysqli_query($forumConnection, $ResponseQuery) or die(mysqli_error($forumConnection));

    //puts the comments into a array
    while($ResponseData[]=mysqli_fetch_array($ResponseResult));

    //gets number of comments
    $responseNumRows = mysqli_num_rows($ResponseResult);

    //puts post data into array
    $ThreadData = mysqli_fetch_array($ThreadResult);

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
        <link rel="stylesheet" href="../../../style/mainstyle.css">
        <title id="title">Forum</title>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Forum</h1>
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
                    <form action="search.php" method="get">
                        <input name="query" autocomplete="off" type="text" placeholder="Search for thread..." maxlength="120" size="35">
                        <input type="submit">
                    </form>
                    <hr>
                    <?php
                        //shows post
                        if ($userID == $ThreadData['posterId']) {
                            echo "<p>" . $ThreadData['username'] . " Said: <input type=\"button\" onclick=\"location.href='editThread.php?type=thread&id=" . $id . "';\" value=\"Delete Thread\" /> </p>";
                        } else {
                            echo "<p>" . $ThreadData['username'] . " Said:</p>";
                        }
                        echo "<h2>" . $ThreadData['threadTitle'] . "</h2>";
                        echo "<hr>";
                        echo "<p>" . $ThreadData['text'] . "</p><br>";
                    ?>
                    <p>Comments:</p>
                    <hr>
                    <p><?php echo $responseNumRows; ?> comment(s)</p>
                    <form action="makeReply.php" method="get">
                        <input type="text" name="reply" placeholder="write a comment..." maxlength="600" size="40" autocomplete="off">
                        <input type="submit">
                    </form>
                    <?php
                        //shows comments
                        for ($x = $responseNumRows-1; $x >= 0; $x--) {
                            if ($userID == $ResponseData[$x]['posterId']) {
                                echo "<p>" . $ResponseData[$x]['username'] . " Said: <input type=\"button\" onclick=\"location.href='editThread.php?type=responce&id=" . $ResponseData[$x]['id'] . "';\" value=\"Delete\" /> </p>" . "<p>" . $ResponseData[$x]['response'] . "</p>";
                                echo "<hr>";
                            } else {
                                echo "<p>" . $ResponseData[$x]['username'] . " Said:</p>" . "<p>" . $ResponseData[$x]['response'] . "</p>";
                                echo "<hr>";
                            }
                            
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
