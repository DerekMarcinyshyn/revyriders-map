/**
 * Revy Riders Google Map
 */

function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(50, -118),
		zoom: 8,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById("map-canvas"),
			mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);