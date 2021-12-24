<?php
    // This program adds a new entry to the users table whenver a new user signs up

	session_start();

	include "dBConnect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
            $result = $connection->query("INSERT INTO users(password, email, username, city, lat, long) VALUES ('{$hash}','{$_POST['email']}','{$_POST['username']}', '{$_POST['city']}', '{$_POST['latitude']}', '{$_POST['longitude']}')");
       
        if(!$result)
        {
            header("Location: ../html/signup.php?message=You%20already%20have%20an%20account%20or%20an%20error%20ocuured&type=alert%2Dwarning");
            exit();
        }
        else
        {
            print "Congratulations! You are now signed up to Music penguin";
            
            $result = $connection->query("SELECT * FROM users WHERE email = '{$_POST['email']}'");
            
            if(!$result)
            {
                print "Error logging in...";
                exit();
            }
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION["id"] = $result["user_id"];
            $_SESSION["name"] = $result["username"];
            
            header("Location: ../html/home.php?message=Congratulations%20you%20are%20now%20signed%20up%20&type=alert%2Dinfo");
            exit();
        }
    }
    exit();
?>