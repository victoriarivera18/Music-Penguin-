
<!-- Includes bootstrap and JQuery -->
<?php
  include "header.php"
?>

<link rel="stylesheet" type="text/css" href="../css/login.css">

<!-- Include the navbar -->
<?php
  include "navbar.php"
?>


<form class = "form-signin" action = "../php/login.php" method = "POST">
  <img class="mb-4" src="../media/logo_transparent.png" alt="" width="90" height="90">
  <h1 class="h3 mb-3 fw-normal">Log In</h1>

  <div class="form-floating">
    <input type="username" class="form-control" id="floatingInput" placeholder="music_penguin" name = "username">
    <label for="floatingInput">Username</label>
  </div>
  <div class="form-floating">
    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name = "password">
    <label for="floatingPassword">Password</label>
  </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="w-100 btn btn-lg btn-primary" type="submit">Log In</button>
  <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p> -->
</form>

<form class = "form-signin" id = "signupButton" action="signup.php">
  <button class="w-100 btn btn-lg btn-primary" type="submit">or Sign Up</button>
</form>
  
<script>
function changeFont(){
	var x = document.getElementsByTagName("HTML")[0];
	x.style.fontSize = "130%";
  document.body.classList.toggle("trigger");
}
</script>

<!-- Closes the body and html tags -->
<?php
  include "footer.php"
?>