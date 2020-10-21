<?php
	$first = $_POST['first'];
	$last = $_POST['last'];
	$gender = $_POST['gender'];
	$reason= $_POST['reason'];
	$username = $_POST['username'];
	$password1 = $_POST['pw1'];
	$password2 = $_POST['pw2'];
	$grade = $_POST['grade'];
	require('../db_connect.php');
	
	if ($first == '' || $last == '' || $gender == '' || $reason == '' || $username == '' || $password1 == '' || $password2 == '' || $grade == '') {
		header("Location: acc_fail.php");
		exit();
	} else {
		$first = stripslashes($first);
		$last = stripslashes($last);
		$reason = stripslashes($reason);
		$username = stripslashes($username);
		$password1 = stripslashes($password1);
		$password2 = stripslashes($password2);
	
		if ($password1 == $password2) {
			//inserts into table
			$name = $first . ' ' . $last;
			$query="INSERT INTO `signup` (`id`, `name`, `gender`, `reason`, `username`, `password`, `grade`) VALUES (NULL, '$name', '$gender', '$reason', '$username', '$password1', '$grade')";
			mysqli_query($connection, $query) or die(mysqli_error($connection));
	
			echo "<a href='form.php'>Back to signup</a>";
			exit();
		} else {
			echo "Signup Fail! try <a href='form.php'>again?</a>";
			exit();
		}
	}
?>
