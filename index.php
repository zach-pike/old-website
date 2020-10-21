<?php
    session_start();
    require('db_connect.php');
    $name = $_SESSION['name'];

    $query = "SELECT * FROM `login` WHERE name='$name'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $array = mysqli_fetch_array($result);
    
    $suspend = $array['suspend'];
?>
<html>
    <head>
        <script>
            function login() {
                document.location.href="webpage/web.php";
            }
        </script>
        <link rel="stylesheet" href="style/indexstyle.css">
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
                <?php
                    if ($_SESSION['name'] != '' && $suspend == '0') {
                        echo "<hr>";
                        echo "You are already logged i n! <br>";
                        echo '<button onclick="login()">Login</button>';
                        echo "<hr>";
                    }
                ?>
            </div>
            <div id="email">
                <a href="admin/index.php">Admin login</a><br>
				<a href="signup/form.php">Request an account</a>
            </div>
            <div id="footer">
                <p>Copyright &copy; 2020 Zachary Pike</p>
            </div>
        </div>
    </body>
<html>
