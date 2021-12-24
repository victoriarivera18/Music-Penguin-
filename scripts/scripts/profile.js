$(function() {
	$.get("../php/returnUserDetails.php", function(data) {
		data = JSON.parse(data);
		
		console.log(data);
		
		if(data["loggedIn"]) {
			var lat = data["lat"];
			var long = data["long"];
			console.log(typeof(lat));
			console.log(typeof(long));

			data = data["favs"];

			for(var key in data) {
				console.log("Hello");
				getConcerts(data[key], parseFloat(lat), parseFloat(long));
				getGenres(data[key]);
			}
		}
		//$("#title").append("<div class = \"headings display-6\" id=\"nameHeading\"> Welcome "+ data["name"]+ "</div>");
	})
	// $("#nameError").hide();
	// $("#passError").hide();
	// $("#passError1").hide();
	// $("#displayCurrentUserName").append(data["name"])

});

// function displayMessage(){
// 	$("#nameError").toggle();
// }

// function validateUser() {
// 	var match = false;
// 	$.get("../php/returnUserDetails.php", match = function(data) {
// 		var replace = document.getElementById('name_user').value;
// 		if(replace == data["name"]){
// 			return true;
// 		}else{
// 			return false;
// 		}
// 	})
// 	if(match){
// 		displayMessage();
// 	}
// 	return match;
// }


// function validatePassword() {
// 	var newType = document.getElementById('typePass').value;
// 	var reType = document.getElementById('retyped').value;
// 	if(newType == reType){
// 		$("#passError").toggle();
// 	}

// 	var current;
// 	$.get("../php/returnUserDetails.php", current = function(data) {
// 		return data["name"];
// 	})
// 	if(current == newType){
// 		$("#passError1").toggle();
// 	}
// }




$(document).ready(function() {
  $("#formButton").click(function() {
    $("#form1").toggle();
  });
});

$(document).ready(function() {
  $("#formButton1").click(function() {
    $("#form2").toggle();
	
  });
});


function addToConcertList(id, name, city, date) {
	var divString = "<tr><td>" + name + "</td><td>" + city + "</td><td class='date-row'>" + date + "</td></tr>";
	$("#" + id).append(divString);
}

function addToGenreList(genre) {
	var divString = "<tr><td>" + genre + "</td>";
  $("#genDiv").append(divString);
}

function getConcerts(artistName, lat, long){

	//insert artist name from favorites
	console.log("Artist is " + artistName);
	console.log(artistName);
		$.get("https://rest.bandsintown.com/artists/" + artistName + "/events?app_id=1bf378cb4101c7170d43dee1b36d3f0b&date=upcoming" ,function(data) { // get data from here.
		if(data["Response"] == "False") {
			$("#testDiv").text("Failed query");
		}else {
			// what should happen (one way)
			// get user's location
			// get events info
			// display events that pertain to user's location 
			//$("#testDiv").prepend("<img id=\"maroon 5\" src=\"" + data["image_url"] + "\">");
			console.log(data); //data is response from api
			$("#recDiv").append("<tr><td>" + artistName + "</td></tr>");
			for(var key in data) {
				addToConcertList("testDiv", artistName, data[key]["venue"]["city"],  data[key]["datetime"].substring(0, data[key]["datetime"].indexOf("T")));
				// console.log("Key is " + key + " Value is " + data[key]);
				// console.log(data[key]["datetime"].substring(0, data[key]["datetime"].indexOf("T")));
				// console.log(artistName); //div is hardcoded
				// var con_lat = parseFloat(data[key]["venue"]["latitude"]);
				// var con_long = parseFloat(data[key]["venue"]["longitude"]);

				// var lat_offset = 3.0;
				// var long_offset = 5.0;

				// console.log(lat +  "--lat--" + con_lat); //div is hardcoded
				// console.log(long +  "--long--" + con_long); //div is hardcoded

				// console.log("lat range:: "+ (con_lat -lat_offset) +  "---" + (con_lat + lat_offset)); //div is hardcoded
				// console.log("long range:: "+ (con_long -long_offset) +  "---" + (con_long + long_offset)); 


				// if((lat >= con_lat -lat_offset) && (lat <= con_lat + lat_offset) && (Math.abs(long) >= Math.abs(con_long - long_offset)) && (Math.abs(long) <= Math.abs(con_long + long_offset))){
				
				// }
				// $("#testDiv").prepend("<div class='row'>" + + "\n "+data[key]["venue"]["latitude"]+ ", "+data[key]["venue"]["longitude"] +"</div>");
				//$("#board").append("<div class='box'> Just added div </div>");

			}	
		}
	});
}

function getGenres(artist) {
	//https://api.spotify.com/v1/artists/e766ff398b4a40f0bc167002c730795f/related-artists
	//$.post("https://accounts.spotify.com/api/token")
	var auth_token = "";
	var id = "";
	// console.log("GAGA");
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
			// console.log(result);
			auth_token = result["access_token"]; //have access token to get related artists
			// console.log(auth_token);

			$.ajax({ //get searched artist id 
				method: 'GET',
				url: "https://api.spotify.com/v1/search?q=" + artist + "&type=artist",
				headers: {
						"Accept": "application/json",
						"Content-Type": "application/json",
						"Authorization" : "Bearer " + auth_token
					},

				success: function(res) {
					// console.log(res["artists"]["items"][0]["genres"][0]); //artsist genre
					addToGenreList(res["artists"]["items"][0]["genres"][0]);

					//get similar artists based on search
				
				}
			});


		  },
		});

};

$(function() {

	//loop through every artist in favorites and call this function
	// getConcerts();
	//getGenres("ladygaga");
});


