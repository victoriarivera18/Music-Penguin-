
<!-- Includes bootstrap and JQuery -->
<?php
  include "header.php"
?>


<!-- All scripts for this page go here -->
<link rel="stylesheet" href="../css/results.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBJJ8GYk0OQu9tIxtAF67B4QkAPCayVBc"></script>
<script src="../scripts/results.js"></script>


<script type="text/template" id="concertListing">
</script>


<script type="text/template" id="artistCard">
  <div class="col" style="min-width: 10rem;">
    <div class = "artist-card access" onclick = "location.href = '{{redirectLink}}'" >
      <img src="{{image}}" alt="artist thumbnail">
      {{name}}
    </div>
  </div>
</script>

<script type="text/template" id="tweetTemplate">
  <div class = "heading-custom" id = "tweetHeading" >Tweets from {{name}}</div>
  {{#each tweets}}
    <div class = 'row tweet-indiv' style = "padding-bottom: 1rem;">
      {{this}}
    </div>
  {{/each}}

</script>
<!-- Include the navbar -->
<?php
  include "navbar.php"
?>


<div id = "add">
  <button id = "addToFavorites" onclick="addToFavorites()"></button>
</div>

<div class = "container">
  <div class = "row justify-content-space-between" id = "topRow">
    <div class = "col-md-8">
      <div class = "row">
          <div class = "heading-custom" id = "concertsTableHeading">
            
          </div>
          <table class="table">
            <thead id = "table-head">
              <tr>
                <th>Venue</th>
                <th>City</th>
                <th>Date</th>
              </tr>
            </thead>
            
            <tbody id = "testDiv">
            </tbody>
        </table>
      </div>
        <div class = "row heading-custom" style="padding-left: 1rem;">
        Trending artists
      </div>
      <div class = "row grid-ish" id = "trendingArtists">
        
      </div>
    
    </div>
    <div class = "col-md-3" id = "tweets">
      
    </div>
  </div>
</div>
<!--<div class = "container">-->
<!--  <div class = "row">-->
<!--    <div class = "col justify-content-center">-->
      
<!--      <div class = "headings display-6" id="concertsHeading">-->
      
<!--      </div>-->
<!--      <br>-->
      
<!--      <table class="table">-->
<!--        <thead id = "table-head">-->
<!--          <tr>-->
<!--            <th>Venue</th>-->
<!--            <th>City</th>-->
<!--            <th>Date</th>-->
<!--          </tr>-->
<!--        </thead>-->
        
<!--        <tbody id = "testDiv">-->
<!--        </tbody>-->
<!--      </table>-->
    
<!--    </div>-->
    
<!--    <div class = "col justify-content-center">-->
      
<!--      <div class = "headings display-6">-->
<!--        Similar artists-->
<!--      </div>-->
<!--      <span class="badge rounded-pill" id="spotifyBadge">Powered by spotify</span>-->

<!--      <br>-->
      
<!--      <table class="table">-->
<!--        <thead id = "table-head">-->
<!--          <tr>-->
<!--            <th>Artist</th>-->
<!--            <th>Popularity</th>-->
<!--          </tr>-->
<!--        </thead>-->
        
<!--        <tbody id = "recDiv">-->
        
<!--        </tbody>-->
       
<!--      </table>-->
      
<!--    </div>-->
<!--  </div>-->
<!--</div>-->


<!--<div id = "recDiv"></div>-->

    
<!-- /BODY -->

<!-- Closes the body and html tags -->
<?php
  include "footer.php"
?>