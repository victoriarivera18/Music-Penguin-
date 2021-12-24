</head>

<!-- Defines nav bar which is common to all pages -->


<!-- Changed text color from #c5c500 to #ffc105 to match login and singup buttons -amrit -->

<header>
    <nav class="navbar navbar-expand-md navbar-light justify-content-between" id = "navbar">
          <a class="navbar-brand" href="home.php" style="color: #ffc105;">
            <img src="../media/logo_transparent.png" alt="" width="45" height="45" class="d-inline-block align-text-center" >
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse row"  id="navbarNav">
            
            <div class = "col-md-1 padding-nav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link active access" aria-current="page" href="home.php" style="color: #ffc105;">Home</a>
                </li>
                <?php if (isset($_SESSION['id'])) {?>
                <li class="nav-item">
                  <a class="nav-link access" href="profile.php" style="color: #ffc105;">Profile</a>
                </li>
                <?php }?>
                         
  
              </ul>
            </div>

            
            <div class = "col-md-4 padding-nav">
                <form action = "results.php" class = "row justify-content-start">
                  <div class = "col-1 access" onclick = "setAccess('#searchQuery')"></div>
                  <div class = "col-8">
                    <input type="text" id='searchQuery' class="input" name ="searchQuery" placeholder="Search an Artist ...">
                    
                    </input>
                    
                  </div>
                  
                  <div class = "col-2">
                    <button class="w-100 btn btn-lg btn-outline-warning access" id="go" type="submit">Go</button>
                  </div>
              </form>
            </div>

        
            
            
            <div class = "col-md-3 col-lg-3 padding-nav" style="display:inline-block;" id="loginButtonsDiv">
              <form style="display:inline-block">
              <!-- If not logged in -->
              <?php if (!isset($_SESSION['id'])) {?>
                <a class="btn btn-warning login-buttons access" href = "login.php">Login</a>
                <a class="btn btn-outline-warning login-buttons access" href = "signup.php">Signup</a>
              
              
              <!-- If logged in -->
              <?php } else {?>
              <span class="navbar-text login-buttons" style="color: #ffc105;">
                Hello <?= $_SESSION['name']; ?>
              </span>
              
              <a class="btn btn-outline-warning login-buttons access" href="../php/logout.php">Logout</a>
              <?php }?>
            </form>
            </div>

          
          </div>
          
          

      </nav>
</header>

<body id = "body">


<!-- Displays notifications from backend (Example : Login failed, New account created ...) -->
<?php
	  if(isset($_GET["message"])) {
	    
	    // Get alert type
	    $type = "alert-info";
	    if(isset($_GET["type"])) {
	      $type = $_GET["type"];
	    }
	    
	    // Display alert
	    echo '<div class = "alert ' . $type . '" role = "alert"> ' . $_GET["message"] . '</div>';
	  }
?>