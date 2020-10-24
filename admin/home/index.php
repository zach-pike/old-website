<?php 
	session_start();
	if ($_SESSION['login'] == '') {
		header('Location: ../index.php');
	}
?>
<html>
	<head>
		<title>Admin Home</title>
		<style>
			body {
				font-family: "Arial";
				background-color: eee;
			}
		</style>
		<script>
			function clearLogs() {
				var x = confirm("Are you sure?");
				if (x == true) {
					document.location.href = "../clear_chat/clear.php";
				}
			}
		</script>
	</head>
	<body>
		<div id='header'><h1>Admin Home</h1></div>
		<div id='content'>
			<ul>
				<li><a href='../account'>Create New Account</a></li>
				<li><a href='../../phpmyadmin'>phpMyAdmin</a></li>
				<li><a onclick="clearLogs()" >Clear Chatroom</a></li>
				<li><a href='../../webpage/Comments/comments.txt'>Comments</a></li>
				<li><a href='../../webpage/Comments/ltcomments.txt'>Long Term Comments</a></li>
				<li><a href="../logout_admin.php">Logout</a></li>
			</ul>
		</div> 
	</body>
</html>
