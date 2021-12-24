// Runs when document is done 


$(function mainjsfunction(inputFieldValue)
{
	//var artistName = "green day"; // should get from 
	//artistName = encodeURIComponent(artistName.trim());
	var value = encodeURIComponent(inputFieldValue.trim());
	var url = "https://rest.bandsintown.com/artists/" + value  + "?app_id=1bf378cb4101c7170d43dee1b36d3f0b";    

	// Make get request
	$.get(url,function(data) {
		if(data["Response"] == "False") {
			$("#testDiv").text("Failed query");
		}
		else {
			console.log(data);
			for(var key in data) {
				console.log("Key is " + key + " Value is " + data[key]);
			}

			// Display the green day thumbnail
			$("#testDiv").prepend("<img id=\"maroon 5\" src=\"" + data["image_url"] + "\">");
 
		}
	});
});