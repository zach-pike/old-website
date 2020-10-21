<?php
    //gets time and starts session and connects to the the db
    require("time.php");
    require("db_connect.php");
    session_start();
    $name = $_SESSION['name'];

    //the MySqli query
    $query = "SELECT * FROM `login` WHERE name='$name'";
    //querys the db
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);
    
    //gets suspend status
    $suspend = $array['suspend'];    
    
    //gest current suffix, text color, name, and rank
    $suffix = $array['suffix'];
    $color = $array['color'];
    $rank = $array['rank'];

    //gets the count of beople in the db with users name
    $count = mysqli_num_rows($result);


    //checks to see if the message box is empty, if so put them at the comments
    if ($_POST['text'] == '') {
        header("Location: blog.php");
        exit();
    }

    //assembles message name Ex: Zachary Pike (suffix) Rank: rank
    if ($suffix != '') {
        $mesname = $name. " (". $suffix. ")";
    }  else {
        $mesname = $name;
    }

	if ($rank != '') {
	    $mesname = $mesname . " Rank: " . $rank;
    }

    //gets message 
    $message = $_POST["text"];

    //opens the files
    $write=fopen("blog.txt", "a+");

    //gets all the comments in the file
    $content = file_get_contents("blog.txt");

    //truncates the comments to 0 bytes
    ftruncate($write, 0);

    //stores short term comments
    fwrite($write, "<b><u>$timestamp $mesname said:</u></b><br><b style=\"color:$color;\">$message</b><br><hr>\n" . $content);
    
    //closes files
    fclose($write);

    //puts you back at comments
    header("Location: blog.php");
?>