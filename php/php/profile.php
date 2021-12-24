<?php

    session_start();
    
    include "dBConnect.php";
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        if(isset($_POST['username'])) {
            $result = $connection->query("UPDATE users SET username = '{$_POST['username']}' WHERE user_id = {$_SESSION['id']}");
            
            if(!$result)
            {
                header("Location: ../html/profile.php?message=Username%20already%20in%20use%2C%20please%20try%20another%20username&type=alert%2Dwarning");
                exit();
            }
            else
            {
                
                $_SESSION["name"] = $_POST['username'];
                
                header("Location: ../html/profile.php?message=Your%20username%20was%20successfully%20changed&type=alert%2Dinfo");
                exit();
            }
        }

        if(isset($_POST['currentPassword'])) {
            if($_POST['newPassword'] != $_POST['retypeNewPassword']) {
                header("Location: ../html/profile.php?message=Passwords%20don%27t%20match&type=alert%2Dwarning");
                exit();
            }
            
            $result = $connection->query("SELECT * FROM users WHERE user_id ='" . $_SESSION['id']. "'");
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $verify = false;

            if(isset($result["user_id"]) && isset($result["password"]))
            {
                $verify =  password_verify($_POST['currentPassword'],$result['password']);
            }
    
            if($verify)
            {
                $hash = password_hash($_POST["newPassword"],PASSWORD_DEFAULT);
                
                $result = $connection->query("UPDATE users SET password = '{$hash}' WHERE user_id = {$_SESSION['id']}");
            
                if(!$result)
                {
                    header("Location: ../html/profile.php?message=An%20error%20occurred%20while%20updating%20your%20password&type=alert%2Dwarning");
                    exit();
                }
                else
                {
                    header("Location: ../html/profile.php?message=Your%20password%20was%20successfully%20changed&type=alert%2Dinfo");
                    exit();
                }
    
            }
            else
            {
                header("Location: ../html/profile.php?message=Incorrect%20password%20given&type=alert%2Ddanger");
                exit();
            }
        }

    }
    exit();

?>