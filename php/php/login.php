<?php
    session_start();
    include "dBConnect.php";
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $result = $connection->query("SELECT * FROM users WHERE username ='" . $_POST["username"]. "'");
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $verify = false;
        $test = false;
        if(isset($result["user_id"]) && isset($result["password"]))
        {
            $verify =  password_verify($_POST['password'],$result['password']);
        }

        if($verify)
        {
            $_SESSION["id"] = $result["user_id"];
            $_SESSION["name"] = $result["username"];

            header("Location: ../html/home.php?message=You%20are%20now%20logged%20in&type=alert%2Dinfo");
            exit();
        }
        else
        {
            header("Location: ../html/login.php?message=Login%20failed&type=alert%2Ddanger");
            exit();
        }
    }
    else
    {
        header("Location: ../html/home.php");
        exit();
    }
?>