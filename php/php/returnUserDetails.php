<?php
    session_start();
    include "dBConnect.php";
    
    
    $returnArray = [ "loggedIn" => false,];
    
    if(isset($_SESSION['id'])) {
        $returnArray["loggedIn"] = true;
        
        $result = $connection->query("SELECT * FROM users WHERE user_id ='" . $_SESSION["id"]. "'");
        $result = $result->fetch(PDO::FETCH_ASSOC);

        if(isset($result["user_id"]))
        {
            $returnArray["id"] = $result["user_id"];
            $returnArray["name"] = $result["username"];
            $returnArray["email"] = $result["email"];
            $returnArray["lat"] = $result["lat"];
            $returnArray["long"] = $result["long"];
        }
        
        $result = $connection->query("SELECT * FROM favorites WHERE user_id ='" . $_SESSION["id"]. "'");
        $result = $result->fetchAll();
        $favs = [];
        
        foreach ($result as $key=>$value) {
            array_push($favs, $value["artist"]);
        }
        $returnArray["favs"] = $favs;
    }

    echo json_encode($returnArray);
?>