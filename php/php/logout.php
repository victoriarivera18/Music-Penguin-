
<?php
    session_start();
    session_destroy();
    header('Location: ../html/home.php?message=You%20are%20now%20logged%20out');
?>
