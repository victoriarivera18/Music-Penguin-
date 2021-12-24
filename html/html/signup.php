<!-- Includes bootstrap and JQuery -->
<?php
  include "header.php"
?>

<!-- All scripts for this page go here -->
<script src="../scripts/loginScripts.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBJJ8GYk0OQu9tIxtAF67B4QkAPCayVBc"></script>
<link rel="stylesheet" type="text/css" href="../css/login.css">

<!-- Include the navbar -->
<?php
  include "navbar.php"
?>


<!-- BODY -->
<main class="form-signin">
    <form onsubmit = "return validate();" id="signupForm" action = "../php/signupBackend.php" method = "POST">
      <img class="mb-4" src="../media/logo_transparent.png" alt="" width="90" height="90">
      <h1 class="h3 mb-3 fw-normal">Sign Up</h1>
  
      <div class="form-floating">
        <div class = "col-1 access" onclick = "setAccess('#username')"></div>
        <input type="username" class="form-control"  id = "username" name = "username" placeholder="music_penguin">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <div class = "col-1 access" onclick = "setAccess('#email')"></div>
        <input type="email" class="form-control" id="email" name = "email" placeholder="music_penguin@gmail.com">
        <label for="floatingInput">Email</label>
      </div>
      
      <div class="form-floating">
        <div class = "col-1 access" onclick = "setAccess('#city')"></div>
        <input type="username" class="form-control" id="city" name = "city" placeholder="City" id = "city" >
        <label for="floatingPassword">City</label>
      </div>
      
      <div class="form-floating">
        <div class = "col-1 access" onclick = "setAccess('#password')"></div>
        <input type="password" class="form-control"  id = "password" name = "password" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
  
      <button class="w-100 btn btn-lg btn-primary" class="access" type="submit">Sign Up</button>
      <!--<p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p> -->
      

      <input type="hidden" name="latitude" id="latitude">
      <input type="hidden" name="longitude" id="longitude">
    </form>
</main>
<!-- /BODY -->




<!-- Closes the body and html tags -->
<?php
  include "footer.php"
?>

