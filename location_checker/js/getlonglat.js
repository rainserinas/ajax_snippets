 function initialize() {
        var address = (document.getElementById('my-address'));
        var autocomplete = new google.maps.places.Autocomplete(address);
        autocomplete.setTypes(['geocode']);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
        }
      });
}

function codeAddress() {
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("my-address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

      // alert("Latitude: "+results[0].geometry.location.lat());
      // alert("Longitude: "+results[0].geometry.location.lng());
      $("#longitude").val();
      $("#longlat").val(results[0].geometry.location.lat() +" "+ results[0].geometry.location.lng());
      } 

      else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }

google.maps.event.addDomListener(window, 'load', initialize);

function getLoc(){

  var longtitude = $("#long").val();
  var latitude   = $("#lat").val();

 $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longtitude+'&sensor=true', function(data) {
    $.each(data, function(index, element) {

        $("#loc").val(data.results[0].formatted_address);
    });
});



  var myCenter=new google.maps.LatLng(latitude,longtitude);
  var marker;

  var mapProp = {
    center:myCenter,
    zoom:13,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  var marker=new google.maps.Marker({
  position:myCenter,
  animation:google.maps.Animation.BOUNCE
  });

  marker.setMap(map);
  
}

google.maps.event.addDomListener(window, 'click', initialize);






function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  $("#totalkm").val(roundToTwo(d) + " km");
  
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}

function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}