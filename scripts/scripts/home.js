function getArtistforGenre(index, auth_token, my_genre){
	//$(".genres-list").append("<div class='list-row'>"+ my_genre);

	$.ajax({ //get artist of genre
		method: 'GET',
		url: "https://api.spotify.com/v1/recommendations?limit=2&seed_genres=" + my_genre,
		headers: {
				"Accept": "application/json",
				"Content-Type": "application/json",
				"Authorization" : "Bearer " + auth_token
			},

		success: function(results) {
			console.log("SUccess");
			console.log(results);

			console.log(my_genre + ": " +results["tracks"][0]["artists"][0]["name"]);// works
			var nameG = results["tracks"][0]["artists"][0]["name"];


			//$(".genres-list").append("<div class='row'>"+my_genre+"<button type=\"submit\" class=\"w-100btn\"> <input type=\"submit\" id='searchQuery'  name =\"searchQuery\" class=\"input\"  value=\" "+ results["tracks"][0]["artists"][0]["name"]  + "\"> </button></div>");
			
			var template = Handlebars.compile($("#genreItem").html());

			var appendString = template({genre: my_genre.charAt(0).toUpperCase() + my_genre.slice(1),
										redirectLink : "results.php?searchQuery=" + encodeURI(nameG)
			});
			console.log(appendString);
			//onclick = "location.href = 'results.php?searchQuery&#x3D;" + name +"'";
														
			$("#list-rows").append(appendString);
			// $("#list-rows").append("<div class='row"+index+"'><button  type=\"submit\" class=\"w-100btn\"> <input type=\"hidden\" type=\"submit\" id='searchQuery'  name =\"searchQuery\" class=\"input\"  value=\" "+ name + "\">"+ my_genre+ "</button> </div>");
			
		}
	});


}


$(function getGenre() {
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
				url: "https://api.spotify.com/v1/recommendations/available-genre-seeds",
				headers: {
						"Accept": "application/json",
						"Content-Type": "application/json",
						"Authorization" : "Bearer " + auth_token
					},

				success: function(res) {
					console.log(res);
					genre = res["genres"];
					console.log(genre);
					//get similar artists based on search
					for(var i = 0; i <= 9; i++){
						//since genre array is alphabetical not by popularity, i just have it choosing random values each time
						var rand = Math.floor(Math.random() * 125);
						console.log(i + " "+rand + ":" + genre[rand]);
						var my_genre = genre[rand];
						getArtistforGenre(i, auth_token, my_genre);

					}
				
				}
			});


		  },
		});

});

function getConcerts(artistName){ //get concerts of trending artists
	// Make get request
	$.get("https://rest.bandsintown.com/artists/" + artistName  + "/events?app_id=1bf378cb4101c7170d43dee1b36d3f0b&date=upcoming", function(data) {
		if(data["Response"] == "False") {
			$("#testDiv").text("Failed query");
		}else {
			var count = 0;
			if(!$.isEmptyObject(data)){
				console.log(data);

					console.log(data);
					//console.log("Key is " + key + " Value is " + data[key]);
					//console.log(data[key]["offers"][0]["url"]);
					
					//addToConcertList("testDiv", data[key]["venue"]["name"], data[key]["venue"]["city"], data[key]["datetime"].substring(0, data[key]["datetime"].indexOf("T")), count, data[key]["offers"][0]["url"], data[key]["datetime"].substring(data[key]["datetime"].indexOf("T") + 1));
					
					//count = count + 1;
					$("#concerts").append("<div class='row1 access concertPicks' onclick='location.href = \"results.php?searchQuery=" + data[0]["artist"]["name"] + "\";'><img src='" + data[0]["artist"]["image_url"]+"' width='40' height='40'>" +data[0]["artist"]["name"] + ", " + data[0]["venue"]["city"] +", "+  data[0]["venue"]["country"] +", " +data[0]["datetime"].substring(data[0]["datetime"].indexOf("T") + 1)+ "</div>");
					//$("#board").append("<div class='box'> Just added div </div>");

			}
		}
	});




}

$(function getSpotTrends(seedGenres) {
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

            var index = 0;

			$.ajax({ //get searched artist id 
				method: 'GET',
				url: "https://api.spotify.com/v1/recommendations?limit=10&market=US&seed_artists=4NHQUGzhtTLFvgF5SZesLK&seed_genres="+ encodeURI(seedGenres) +"&seed_tracks=0c6xIDDpzE81m2q797ordA",
				//q: artist,
				//type : "artist", 
				headers: {
						"Accept": "application/json",
						"Content-Type": "application/json",
						"Authorization" : "Bearer " + auth_token
					},

				success: function(res) {
					$("#trendingArtists").html("");
                    console.log(res);
                    for(key in res["tracks"]){
                      console.log(res["tracks"][key]["artists"][0]["name"]);
                      var artistName = res["tracks"][key]["artists"][0]["name"];
                      	$.get("https://rest.bandsintown.com/artists/" + artistName  + "?app_id=1bf378cb4101c7170d43dee1b36d3f0b&date=upcoming" ,function(data) {
                            if(data["Response"] == "False") {
                                $("#testdiv").text("Failed query");
                            }else {
                                console.log(data); //data is response from api
                                console.log(data["id"]); //returns artist ids
                                var name = data["name"];
								getConcerts(name);
                                console.log(index);
                                index = index + 1;
                                
								var template = Handlebars.compile($("#artistCard").html());
								var appendString = template({name : name, 
															image : data["image_url"],
															redirectLink : "results.php?searchQuery=" + encodeURI(name)
															});
														
								console.log(appendString);
								$("#trendingArtists").append(appendString);
                                    // $("#trendingArtists").append("<div class='col'>" + "<button  type=\"submit\" class=\"w-100btn\"> <input type=\"submit\" id='searchQuery'  name =\"searchQuery\" class=\"input\"  value=\" "+name + "\"> </button> <img id=\"thumbnail\" width=\"1%\" height=\"2%\" src=\"" + data["image_url"] + "\">" + "</div>");
                                    //$("#board").append("<div class='box'> Just added div </div>");
                            }
                        });
                      
                    }
					
				}
			});


		  },
		});

});




// Runs when document is done loading
$(function() {
	//var artistName = getQueryVariable("searchQuery");
	//console.log("Artist name is " + artistName);
	//debugger;

	if(localStorage.getItem("showPopup") != 'dontshow') {
		console.log(localStorage.getItem("showPopup\n\n\n\n\n\n\n\n"));
	   $("#accessPopup").show();
	}
	else {
		console.log("SEEEEEEEEEEEEEEEEEEEEE");
	}
	//artistName = encodeURIComponent(artistName.trim());
	getSpotTrends("pop, alternate, rock");
	getGenre();
	
	

});



function closeButtonClick() {
	$("#accessPopup").hide();
}

function dontShowAgainClick() {
	closeButtonClick();
	localStorage.setItem("showPopup", 'dontshow');
	console.log(localStorage.getItem("showPopup"));
}