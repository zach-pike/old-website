<?php
    session_start();
    require('db_connect.php');

?>
<html>
    <head>
        <script>
            function myFunction() {
                document.location.href="cams.php";
            }
        </script>
        <link rel="stylesheet" href="css/indexstyle.css">
        <title>Login</title>
    </head>
    <body>
        <div id="container">
            <div id="header"><h1>Welcome, Please login!</h1></div>
                <div id="login">
                <form action="authen_login.php" method="post">
                    <input type="text" autocomplete="off" name="name" placeholder="Username"><br>
                    <input type="password" autocomplete="off" name ="pw" placeholder="Password"><br>
                    <input type="submit" value="Login!">
                </form>
            </div>
            <div id="footer">
                <p>Copyright &copy; 2020 Zachary Pike</p>
            </div>
        </div>
    </body>
<html>
