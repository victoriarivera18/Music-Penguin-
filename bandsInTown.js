
// Runs when document is done loading
$(function()
{
	var artistName = "green day";
	artistName = encodeURIComponent(artistName.trim());

	// Make get request
	$.get("https://rest.bandsintown.com/artists/" + artistName  + "?app_id=1bf378cb4101c7170d43dee1b36d3f0b" ,function(data) {
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