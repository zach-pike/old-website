<?php
    //gets time and starts session and connects to the the db
    require("time.php");
    require("../../db_connect.php");
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

    //if users does not exist or is suspended then kick them out
    if ($count != 1 || $suspend != '0') {
            header("Location: ../../index.php");
    }

    //checks to see if the message box is empty, if so put them at the comments
    if ($_GET['mes'] == '') {
        header("Location: comments.php");
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
    $message = $_GET["mes"];

    //checks for bad words and suspends if they have been used
    $data = file_get_contents("words.json");
    $badword = json_decode($data, true);

    $mesdetagged = strip_tags($message);
    $mes = explode(' ', $mesdetagged);
    $result = array_intersect(array_map('strtolower', $badword[bad]), array_map('strtolower', $mes));

    if (!empty($result)) {
        header("Location: comments.php");
        $suspend_now = "UPDATE `login` SET `suspend` = '1' WHERE name='$name'";
        mysqli_query($connection, $suspend_now) or die(mysqli_error($connection));
        $longterm=fopen("ltcomments.txt", "a+");
        fwrite($longterm, "$timestamp $name said: $message (GOT CENSORED) \n");
        fclose($longterm);
        exit();
    }
    //if every check passed then write the comment

    //opens the files
    $write=fopen("comments.txt", "a+");
    $longterm=fopen("ltcomments.txt", "a+");

    //gets all the comments in the file
    $content = file_get_contents("comments.txt");

    //truncates the comments to 0 bytes
    ftruncate($write, 0);

    //stores comment into longterm comments
    fwrite($longterm, "$timestamp $mesname said: $message\n");

    //stores short term comments
    fwrite($write, "<b><u>$timestamp $mesname said:</u></b><br><b style=\"color:$color;\">$message</b><br><hr>\n" . $content);
    
    //closes files
    fclose($longterm);
    fclose($write);

    //puts you back at comments
    header("Location: comments.php");
?>