<?php

    session_start();
    include "dBConnect.php";
    
    if(!isset($_SESSION["id"])){
        header("Location: ../html/home.php?message=You%20are%20not%20logged%20in");
        exit();
    }
    
    $searchQuery = $_GET["searchQuery"];
    $id = $_SESSION["id"];
    
    if($searchQuery == "") {
        echo "failed";
        exit();
    }
    
    $result = $connection->query("SELECT * FROM favorites WHERE (user_id = '{$id}' AND artist = '{$searchQuery}')");
    if($result->rowCount() > 0) {
        if($_GET["remove"] == "true") {
            $result = $connection->query("DELETE FROM favorites WHERE (user_id = '{$id}' AND artist = '{$searchQuery}')");
            if($result) {
                echo "success";
                exit();
            } 
            else {
                echo "Query failed";
                exit();
            }
            exit();
        }
        
        
        echo "exists";
        exit();
    }
    else if(isset($_GET["check"])) {
        echo "doesnotexist";
        exit();
    }
    

    $result = $connection->query("INSERT INTO favorites(user_id, artist) VALUES ('{$id}', '{$searchQuery}')");
     
    // $result = $result->fetch(PDO::FETCH_ASSOC);

    
    if(!$result) {
        echo "failed";
        exit();
    }
    else {
        echo "success";
        exit();
    }



?>