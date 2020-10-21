<?php
        session_start();
        if ($_SESSION['login'] == '') {
                header('Location: ../../index.php');
        }
?>

<html>
	<head>
		<title>Create new account</title>	
		<style>
			body {
				font-family: "Arial";
				background-color: eee;
			}
		</style>	
	</head>
	<body>
		<form method="POST" action="new_account_code.php">
			<input type="text" autocomplete="off" placeholder="Username" name="username"><br>
			<input type="text" autocomplete="off" placeholder="Name" name="name"><br>
			<input type="password" placeholder="Password" name="pw1"><br>
			<input type="password" placeholder="Confirm Password" name="pw2"><br>
			<input type="submit">
		</form>
		<a href="../home/index.php">Back</a>
 	</body>
</html>
