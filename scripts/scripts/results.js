
var inFavs = false;
var artist_id = false;
var artist_name = false;

function pop(num) {
	var popUP = document.getElementById("my_popup" + num);
	popUP.classList.toggle("show");
  }

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}

function addToList(id, text, popularity) {
	var progressBar = "<div class = 'progress'> <div class='progress-bar' role='progressbar' style='width: "+ popularity +"%' aria-valuenow='" + popularity + "' aria-valuemin='0' aria-valuemax='100'></div></div>";
	var divString = "<tr><td>" + text + "</td><td>" + progressBar + "</td></tr>";
	$("#" + id).append(divString);
}

function addToConcertList(id, venue, city, date, num,url, time ) {
	
	var divString = "<tr><td><div class='popup access' onclick='pop(" + num + ")'>" + venue + "<span class='popuptext' id='my_popup" + num + "'><p>Url: </p><a href='" + url + "'>Link for tickets</a><br><p> Time: </p>" + time + "<br><p> Date: </p>" + date + "<br><p> Location: </p>" + venue + "</span></div></td><td>" + city + "</td><td class='date-row'>" + date + "</td></tr>";
	$("#" + id).append(divString);
}



function getSpotRecs(artist) {
	//https://api.spotify.com/v1/artists/e766ff398b4a40f0bc167002c730795f/related-artists
	//$.post("https://accounts.spotify.com/api/token")
	var auth_token = "";
	var id = "";
	$.ajax({
		  method: "POST",
		  url: "https://accounts.spotify.com/api/token",
		  data: {
			"grant_type":    "client_credentials",
			"headers": {
				'content-type': 'application/x-www-form-urlencoded',
				"Authorization" : "Basic <base64 encoded client_id:client_secret>"
			},
			"client_secret": "eee1d312624443219de0e528b1d9f759",
			"client_id":     "e766ff398b4a40f0bc167002c730795f",
		  },
		  	success: function(result) {
			console.log(result);
			auth_token = result["access_token"]; //have access token to get related artists
			console.log(auth_token);

			$.ajax({ //get searched artist id 
				method: 'GET',
				url: "https://api.spotify.com/v1/search?q=" + artist + "&type=artist",
				//q: artist,
				//type : "artist",
				headers: {
						"Accept": "application/json",
						"Content-Type": "application/json",
						"Authorization" : "Bearer " + auth_token
					},

				success: function(res) {
					console.log(res);
					id = res["artists"]["items"][0]["id"];
					console.log(id);
					//get similar artists based on search
					$.ajax({ //get searched artist id 
							method: 'GET',
							url: "https://api.spotify.com/v1/artists/"+ id + "/related-artists",
							headers: {
								"Accept": "application/json",
								"Content-Type": "application/json",
								"Authorization" : "Bearer " + auth_token
							},

						success: function(res1) {
							console.log("SUCCESS");
							res1["artists"] = res1["artists"].sort((a, b) => (a.popularity < b.popularity) ? 1 : -1)
							for(var key in res1["artists"]) {
								//console.log("Key is " + key + " Value is " + res1[key]);
								console.log(res1["artists"][key]["images"][0]["url"]);
								// addToList("recDiv", res1["artists"][key]["name"], res1["artists"][key]["popularity"]);
								
								
								       
								var template = Handlebars.compile($("#artistCard").html());
								var appendString = template({name : res1["artists"][key]["name"], 
															image : res1["artists"][key]["images"][0]["url"],
															redirectLink : "results.php?searchQuery=" + encodeURI(res1["artists"][key]["name"])
															});
														
								console.log(appendString);
								$("#trendingArtists").append(appendString);
								// $("#recDiv").prepend("<div class='row'><div class = 'col'>" +res1["artists"][key]["name"]+ "\n "+ res1["artists"][key]["popularity"] +"</div></div>");
								//$("#board").append("<div class='box'> Just added div </div>");
				
				
							}	

						}
					});
					
				}
			});


		  },
		});

};

// Runs when document is done loading
$(function() {
	
	// Add to favorites event listener
	// $("#addToFavorites").click( function() {
	// 	console.log("Howdy");
	// 	$.get("../php/addToFavorites.php?artist=" + getQueryVariable("searchQuery"), function() {
	// 		console.log("artist added to favs");
	// 	});
	// });
	
	var artistName = getQueryVariable("searchQuery");
	
	
	console.log("Artist name is " + artistName);
	//debugger;

	
	artistName = encodeURIComponent(artistName.trim());
	
	
	$.get("../php/twitter.php?searchQuery=" + artistName, function(data) {
		if(data['Response'] != "False") {
			data = jQuery.parseJSON(data);
			var template = Handlebars.compile($("#tweetTemplate").html());
			console.log(data["name"]);
			// for(var tweet in data["tweets"]) {
			// 	var indexOfLink = tweet.indexOf("https://");
			// 	if(indexOfLink != -1) {
					
			// 	}
			// }
			for(var key in data["tweets"]) {
				data["tweets"][key] = data["tweets"][key].substring(0, data["tweets"][key].lastIndexOf("http"));
			}
			var appendString = template({name : data["name"], tweets : data["tweets"]});
			
			$("#tweets").append(appendString);
		}
	});
	
	
	$('#concertsHeading').append("Concerts Nearby for " + artistName);
	
	$.get("https://rest.bandsintown.com/artists/" + artistName  + "/?app_id=1bf378cb4101c7170d43dee1b36d3f0b" ,function(data) {
		if(data["Response"] != "False") {
			artist_name = data["name"];
			artist_id = data["id"];
			checkFavorite();
			$("#concertsTableHeading").html("Concerts from " + decodeURIComponent(artist_name).replaceAll('+', ' '));
		}
	});
	
	getSpotRecs(artistName);
	//getTweet(artistName);

	// Make get request
	$.get("https://rest.bandsintown.com/artists/" + artistName  + "/events?app_id=1bf378cb4101c7170d43dee1b36d3f0b&date=upcoming" ,function(data) {
		if(data["Response"] == "False") {
			$("#testDiv").text("Failed query");
		}else {
			// what should happen (one way)
			// get user's location
			// get events info
			// display events that pertain to user's location 
			//$("#testDiv").prepend("<img id=\"maroon 5\" src=\"" + data["image_url"] + "\">");
			var count = 0;

		
			//data is response from api
			for(var key in data) {
				//console.log("Key is " + key + " Value is " + data[key]);
				console.log(data[key]["offers"][0]["url"]);
				
				addToConcertList("testDiv", data[key]["venue"]["name"], data[key]["venue"]["city"], data[key]["datetime"].substring(0, data[key]["datetime"].indexOf("T")), count, data[key]["offers"][0]["url"], data[key]["datetime"].substring(data[key]["datetime"].indexOf("T") + 1));
				count = count + 1;
				// $("#testDiv").prepend("<div class='row'>" + + "\n "+data[key]["venue"]["latitude"]+ ", "+data[key]["venue"]["longitude"] +"</div>");
				//$("#board").append("<div class='box'> Just added div </div>");

			}	
		}
	});

	//getTweets(artistName);
	
});



// Gets distance between lattitudes and longitudes
function distance(lat1, lon1, lat2, lon2, unit) {
	if ((lat1 == lat2) && (lon1 == lon2)) {
		return 0;
	}
	else {
		var radlat1 = Math.PI * lat1/180;
		var radlat2 = Math.PI * lat2/180;
		var theta = lon1-lon2;
		var radtheta = Math.PI * theta/180;
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		if (dist > 1) {
			dist = 1;
		}
		dist = Math.acos(dist);
		dist = dist * 180/Math.PI;
		dist = dist * 60 * 1.1515;
		if (unit=="K") { dist = dist * 1.609344 }
		if (unit=="N") { dist = dist * 0.8684 }
		return dist;
	}
}


//Function to covert address to Latitude and Longitude
var getLocation =  function(address) {
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
      var latitude = results[0].geometry.location.lat();
      var longitude = results[0].geometry.location.lng();
      console.log(latitude, longitude);
      } 
  }); 
}




function addToFavorites() {
	var fav = artist_name;
	
	if(fav == false) {
		alert("An error occurred");
	}
	
	if(inFavs) {
		$("#addToFavorites").html("Add to favorites");
		$("#addToFavorites").css("background-color", "rgb(255, 229, 38)");
		$("#body").removeClass("inFavorites");
	}
	else {
		$("#addToFavorites").html("Remove from favorites");
		$("#addToFavorites").css("background-color", "transparent");
		$("#body").addClass("inFavorites");
	}
	$("#addToFavorites").attr('disabled','disabled');

	$.get("../php/addToFavorites.php?searchQuery=" + fav + "&remove=" + inFavs, function(data) {
		if(data["Response"] == false) {
			console.log("Failed");
		}
		if(data == "success") {
			$('#addToFavorites').prop("disabled", false);
			inFavs = !inFavs;
			console.log("set");
		}
		else {
		 location.reload();
		}

		console.log(data);
	});
}


function checkFavorite() {
	var fav = artist_name;
	$.get("../php/addToFavorites.php?check=true&searchQuery=" + fav, function(data) {
		if(data["Response"] == false) {
			console.log("Failed");
		}
		if(data == "exists") {
			$("#addToFavorites").html("Remove from favorites");
			$("#addToFavorites").css("background-color", "transparent");
			$("#body").addClass("inFavorites");
			inFavs = true;
		}
		else {
			$("#addToFavorites").html("Add to favorites");
			$("#addToFavorites").css("background-color", "rgb(255, 229, 38)");
			inFavs = false;
		}
		
		
		console.log(data);
	});
}
$(function(){
	var location = getQueryVariable("searchQuery");



	getLocation(location);
	
	
	checkFavorite();
	//$.get("../php/twitter.php");

});

