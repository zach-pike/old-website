<?php
	//connects to server
	require('../../db_connect.php');
	if ($_POST['username'] == '' || $_POST['pw1'] == '' || $_POST['name'] == '') {
		header("Location: index.php");
		exit();
	} else {
		//gets input
		$username = $_POST['username'];
		$password1 = $_POST['pw1'];
		$password2 = $_POST['pw2'];
		$name = $_POST['name'];
	
		$username = stripslashes($username);
		$name = stripslashes($name);
		$password1 = stripslashes($password1);
		$password2 = stripslashes($password2);
	
		if ($password1 == $password2) {
			//inserts into table
			$query="INSERT INTO `login` (`id`, `username`, `password`, `name`, `suffix`, `rank`, `color`, `admin`, `suspend`) VALUES (NULL, '$username', '$password1', '$name', '', 'User', '#000000', '0', '0')";
			mysqli_query($connection, $query) or die(mysqli_error($connection));
	
			header("Location: index.php");
			exit();
		} else {
			header("Location: index.php");
			exit();
		}
	}
?>
