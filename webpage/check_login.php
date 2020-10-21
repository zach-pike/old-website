<?php
	function checkLogin() {
		session_start();
		$name = $_SESSION['name'];

    	$query = "SELECT * FROM `login` WHERE name='$name'";
    	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    	$array = mysqli_fetch_array($result);
    
    	$suspend = $array['suspend'];
    	$name = $array['name'];    

    	$count = mysqli_num_rows($result);
    	if ($count != 1 || $suspend != '0') {
        	return 1;
    	} else {
    		return 0;
    	}
    }
?>