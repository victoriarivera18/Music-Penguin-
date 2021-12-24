

<!-- Includes bootstrap and JQuery -->
<?php
  include "header.php"
?>

<!-- All scripts for this page go here -->
<!--<script src="../scripts/script.js"></script>-->
<!--<link rel="stylesheet" href="../css/search.css">-->
<link rel="stylesheet" href="../css/homeOnly.css">
<script src="../scripts/home.js"></script>


<!--This template is used to add an artist in javascript-->
<script type="text/template" id="artistCard">
  <div class="col" style="min-width: 10rem;">
    <div class = "artist-card access" onclick = "location.href = '{{redirectLink}}'" >
      <img src="{{image}}" alt="artist thumbnail">
      {{name}}
    </div>
  </div>
</script>


<!--This tepmlate is used to add genres using javascript-->
<script type="text/template" id="genreItem">
  
  <li class = "list-group-item genre-item access" onclick="location.href = '{{redirectLink}}'">
    {{genre}}
  </li>
  
</script>

<!-- Include the navbar -->
<?php
  include "navbar.php"
?>

<div id="accessPopup" style="display:none;">
  Press f8 for keyboard shortcuts or f9 to toggle dyslexia friendly fonts
  <button id="closeButton" class="accessButtons access" onclick="closeButtonClick();">Close</button>
  <button id="dontShowAgain" class = "accessButtons access" onclick="dontShowAgainClick();">Don't show again</button>
</div>
<!-- concerts bandsintown -->
<div class="container">
  <div class = "row"> <!--Popular Concerts -->
  <div class = "row heading-custom" style="padding-left: 1.5rem;">Popular concerts</div>
    <div id="concerts"> 
    
    </div>
  </div>


  <div class = "row">

    <div class = "col-md-10 ">
      <div class = "row heading-custom" style="padding-left: 1rem;">
        Trending artists
      </div>
      <div class = "row grid-ish" id = "trendingArtists">
        
      </div>
    </div>

    <div class = "col-md-2">
      <div class = "heading-custom">Popular genres </div>
      <ul class="list-group list-group-flush" id = "list-rows">
      </ul>
    </div>
  </div>
</div>


<!-- bands in town artists and spotify genres -->
<!--<div class="container-lg" class="bottom-panel">-->
<!--  <div class = "headings display-6">Trending Artists-->
<!--  <form action = "results.php">-->
<!--    <div class="row-align-content-center">-->
      <!--<div class = "col-4" id = "trendingArtists">-->
        <!--<input type="hidden" id='searchQuery' class="input" name ="searchQuery" value="Mickey"> -->
      <!--</div>-->
<!--      <div class = "col-1"></div>-->
<!--    </div>-->
<!--  </form>-->
<!--  </div>-->



<!--  <div class = "headings display-6">Popular Genres -->
<!--  <div class="genres-list">-->
<!--  <form action = "results.php">-->
<!--    <div class="row-align-content-center">-->
<!--      <div class = "list-rows">-->
        <!--<input type="hidden" id='searchQuery' class="input" name ="searchQuery" value="Mickey"> -->
<!--      </div>-->
<!--    </div>-->
<!--  </form>-->
  
<!--  </div>-->
  
  
<!--  </div>-->


<!--</div> -->


  <!-- Want to add functionality that you can get concert results from artist on home page; button calls results.php or search_results.js (idk which one) -->

<!--  </div>-->
<!--  </div>-->

<!-- Closes the body and html tags -->
<?php
  include "footer.php"
?>
</div>