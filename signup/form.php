<html>
<head>
<style>
	body {
		font-family: "Arial";
		background-color: #eee
	}
	form {
		text-align: center;
	}
	h1 {
		text-align: center;
	}
	#link {
		text-align: center;
	}
</style>
<title> Signup </title>
</head>
<body>
<h1> Signup </h1>
<form method="POST" action="store_values.php">
	First name: <input type="text" name="first"> <br>
	Last name: <input type="text" name="last"> <br>
	Gender: <br> 
	<input type="radio" name="gender" value="male"> Male<br>
	<input type="radio" name="gender" value="female"> Female<br>
	<input type="radio" name="gender" value="other"> Other<br>
	<input type="radio" name="gender" value="do not apply">Do not apply<br>
	Username: <input type="text" name="username"> <br>
	Requested password: <input type="password" name="pw1"> <br>
	Retype requested password: <input type="password" name="pw2"> <br>
	Grade: <br>
	<input type="radio" name="grade" value="6">6th<br>
	<input type="radio" name="grade" value="7">7th<br>
	<input type="radio" name="grade" value="8">8th<br>
	Why do you want this account <br>
	<input type="text" name="reason"> <br>
	<input type="submit">
</form>
<div id="link">
<a href="../index.php"> Back </a>
</div>
</body>	
</html>
