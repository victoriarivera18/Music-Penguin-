
<!-- Includes bootstrap and JQuery -->
<?php
  include "header.php"
?>

<!-- All scripts for this page go here -->

<!--<script src="../scripts/results.js"></script>-->
<!--<script src="../scripts/home.js"></script>-->
<script src="../scripts/profile.js"></script>
<link rel="stylesheet" type="text/css" href="../css/profile.css">

<!-- Include the navbar -->
<?php
  include "navbar.php"
?>

<!-- BODY -->

 <!--If not logged in -->
<?php if (!isset($_SESSION['id'])) {?>

<div class = "container">
  <div class = "row mb-2 mt-4">
    <div class = "col d-flex justify-content-center">
      You're not logged in!
    </div>
  </div>
  
  <div class = "row mb-2">
    <div class = "col d-flex justify-content-center">
      <a class="btn btn-warning access" href = "login.php">Login</a>
    </div>
  </div>
  
  <div class = "row mb-2">
    <div class = "col d-flex justify-content-center">
      <a class="btn btn-outline-warning access" href = "signup.php">Signup</a>
    </div>
  </div>
  
</div>

<?php } else {?>





<div class = "container">
  
  <div class = "row" >
    <div class = "col">
      <button type="button" id="formButton" class = "access pt-2 btn btn-warning">Change Username</button>

<form id="form1" class="disappearing-forms" method="POST" action = "../php/profile.php">
<div id = "displayCurrentUserName"></div>
  <b>New Username:</b>
  <div class = "col-1 access" onclick = "setAccess('#name_user')"></div>
  <input type="text" class="form-control" id = "name_user" name = "username" placeholder="MusicPenguin007">

  <button type="submit" class = "w-100 btn btn-lg btn-warning access" id="submit" onclick = "validateUser()">Submit</button>
</form>

    </div>
    
    
    <div class = "col">
      
<button type="button" id="formButton1" class = "access pt-2 btn btn-warning">Change Password</button>
<form id="form2" class="disappearing-forms" method="POST" action = "../php/profile.php">

  <b>Current Password:</b> <div class = "col-1 access" onclick = "setAccess('#currentPassword')"></div><input type="password" id = "currentPassword" name="currentPassword"><br>
  <b>New Password:</b> <div class = "col-1 access" onclick = "setAccess('#typePass')"></div> <input type="password" id = "typePass" name="newPassword"> <br>
  <b>Retype New Password:</b> <div class = "col-1 access" onclick = "setAccess('#retyped')"></div> <input type="password" id = "retyped" name="retypeNewPassword">
  <br>
  <button type="submit" id="submit1" class = "access" onclick = "validatePassword()">Submit</button>
</form>
    </div>
  </div>


    <div class = "headings display-6" style="text-align:left; padding-bottom:3rem;" id="nameHeading">
     Welcome <?= $_SESSION['name']; ?>
  </div>

  <div class = "row">
    <div class = "col justify-content-center">
      
      <div class = "heading-custom" id="concertsHeading">
        Saved Concerts<!-- getConcerts() -->
      </div>
    
      
      <br>
      
      <table class="table">
        <thead id = "table-head">
          <tr>
            <th>Artist</th>
            <th>Location</th>
            <th>Time</th>
          </tr>
        </thead>
        
        <tbody id = "testDiv">
        </tbody>
      </table>
  
    
    </div>
    
  </div>
</div>

<div class = "container">
  <div class = "row">
    
    <div class = "col justify-content-center">
      
      <div class = "heading-custom">
        Favorite Artists <!--backend php -->
      </div>
      <span class="badge rounded-pill" id="spotifyBadge">Powered by spotify</span>

      <br>
      
      <table class="table">
        <thead id = "table-head">
          <tr>
            <th>Artist</th>
          </tr>
        </thead>
        
        <tbody id = "recDiv">
        
        </tbody>
       
      </table>
      
    </div>
  </div>
</div>

<div class = "container">
  <div class = "row">
    
    <div class = "col justify-content-center">
      
      <div class = "headings heading-custom">
        Favorite Genres <!--spotify search query based on artist name-->
      </div>
      <span class="badge rounded-pill" id="spotifyBadge">Powered by spotify</span>

      <br>
      
      <table class="table">
        <thead id = "table-head">
          <tr>
            <th>Genres</th> <!--getGenres(artist) in profile.js-->
          </tr>
        </thead>
        
        <tbody id = "genDiv">
        
        </tbody>
       
      </table>
      
    </div>
  </div>
</div>


<?php }?>


<!-- /BODY -->

<!-- Closes the body and html tags -->
<?php
  include "footer.php"
?>