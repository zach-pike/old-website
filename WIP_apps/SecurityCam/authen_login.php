<?php
        session_start();
        require('db_connect.php');

        if ($_POST['name'] == '' || $_POST['pw'] == ''){
                header("Location: index.php");
                exit();
        }
        // Assigning POST values to variables.
        $username = $_POST['name'];
        $password = $_POST['pw'];
        
        $username = stripslashes($username);
        $password = stripslashes($password);
                
        //CHECK FOR THE RECORD FROM TABLE
        $query = "SELECT * FROM `login` WHERE username='$username' and password='$password'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        $count = mysqli_num_rows($result);
        $array = mysqli_fetch_array($result);

        if ($count == 1){
                header("Location: choose.php");
                $_SESSION['name'] = $array['username'];
        } else {
                header("Location: index.php");
        }
?>