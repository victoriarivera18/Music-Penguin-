function getLocation(address) {
    var geocoder = new google.maps.Geocoder();
    

    geocoder.geocode( { 'address': address},function(results, status) {
  
    if (status == google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();
        
        document.getElementById("latitude").value = latitude;
        document.getElementById("longitude").value = longitude;
        
        console.log(latitude);
        console.log(longitude);
        document.getElementById("signupForm").submit();
    }
    });


  }

function validate() {
    var latitude = document.getElementById("latitude");
    var longitude = document.getElementById("longitude");
    
    var city = document.getElementById("city").value;
    getLocation(city);

    return false;
}

