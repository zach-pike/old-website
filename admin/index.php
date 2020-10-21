<html>
	<head>
		<title>Admin login</title>
		<style>
			body {
				background-color: #eee;
				text-align: center;
				font-family: "Arial";
			}
		</style>
	</head>
	<body>
		<p>Login to admin console</p>
		<form action='admin_login_code.php' method='POST'>
			<input type='text' placeholder='Username' name='user'><br>
			<input type='password' placeholder='Password' name='passwd'><br>
			<input type='submit' value="Login!"><br>
			<a href="../index.php">Back</a>
		</form> 
	</body>
</html>
