<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
        <!-- All include files go here : (Bootstrap, Jquery ...) -->
        
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
        <!-- Include Handlebars from a CDN -->
        <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
        
        <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="../css/home.css">
            
            
            
        <script type="text/template" id = "keyCodeTemplate">
            <div class = "keyCode" id = "cntrl{{id}}">
                {{name}}
            </div>
        </script>
        <script src="../scripts/access.js"></script>
        
        
        <!-- Get them cookies rolling -->
        <?php
            session_start();
        ?>