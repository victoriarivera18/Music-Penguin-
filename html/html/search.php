

<!-- Includes bootstrap and JQuery -->
<?php
  include "header.php"
?>

<!-- All scripts and stylesheets for this page go here -->
<link rel="stylesheet" href="../css/search.css">

<script src="../css/search.js"></script>


<!-- Include the navbar -->
<?php
  include "navbar.php"
?>


<div id="testDiv">
  
</div> 


<div class="container-lg">
  <form action = "results.php">
    <div class="row row-search align-content-center  justify-content-center">
      <div class = "col-4">
        <input type="text" id='searchQuery' class="input" name ="searchQuery" placeholder="Search an Artist ...">
      </div>
      <div class = "col-1">
        <button class="w-100 btn btn-lg btn-outline-warning" id="go" type="submit">Go</button>
      </div>
    </div>
  </form>
</div>

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