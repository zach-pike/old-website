<?php
	session_start();
        require('../db_connect.php');
	if ($_POST['user'] == '' || $_POST['passwd'] == '') {
		echo "<script>alert('You have to enter something!');</script>";
		exit();
	}           
	// Assigning POST values to variables.
    $username = $_POST['user'];
    $password = $_POST['passwd'];
	$username = stripslashes($username);
	$password = stripslashes($password);

    //CHECK FOR THE RECORD FROM TABLE
    $sqlquery = "SELECT * FROM `login` WHERE username='$username' and password='$password'";
	$query = mysqli_query($connection, $sqlquery) or die(mysqli_error($connection));
	
	$array = mysqli_fetch_array($query);

    //gets admin status
	$admin = $array['admin'];
	//gets name
	$name = $array['name'];
	
	if ($admin == '1') {
		$_SESSION['login'] = "1";
		$_SESSION['name'] = $name;
		header('Location: modified_home/index.php');
		exit();
	} else if ($admin == '2'){
		$_SESSION['login'] = "2";
		$_SESSION['name'] = $name;
		header('Location: home/index.php');
	} else {
		header("Location: index.php");
		exit();
	}
?>
