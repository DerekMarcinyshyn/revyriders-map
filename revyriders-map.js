/**
 * Revy Riders Google Map
 */

function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(50.99100012578159, -118.18512606620789),
		zoom: 10,
		mapTypeId: google.maps.MapTypeId.TERRAIN
	};

	var map = new google.maps.Map(document.getElementById("map-canvas"),
			mapOptions);

	var weatherLayer = new google.maps.weather.WeatherLayer({
		temperatureUnits: google.maps.weather.TemperatureUnit.CELSUIS,
		windSpeedUnits: google.maps.weather.WindSpeedUnit.KILOMETERS_PER_HOUR
	});
	weatherLayer.setMap(map);

	var cloudLayer = new google.maps.weather.CloudLayer();
	cloudLayer.setMap(map);

	var dirtbiker = '/wp-content/plugins/revyriders-map/img/motorbike.png';

	var track = new google.maps.Marker({
		map: map,
		icon: dirtbiker,
		animation: google.maps.Animation.DROP,
		position: new google.maps.LatLng(51.06053278849464, -118.20366549491882),
		title: 'Revy Riders Dirt Bike Club'
	});

	var trackContent =
			'<div class="map-content">' +
					'<div class="body-content">' +
					'<h1>Revy Riders Motocross Track</h1>' +
					'<p class="hours">HOURS: 10am to 7pm</p>' +
					'<p class="no-exceptions">NO EXCEPTIONS</p>' +
					'<p>$10 per day drop in fee.</p>' +
					'<p class="abuse">Abuse these hours and it will be gone forever!</p>' +
					'<p class="abuse">It is our agreement with BC Crown Lands.</p>' +
					'<p>Follow the signs on Westside Road</p>' +
					'</div>' +
					'<div class="track-image">' +
					'<img src="/wp-content/plugins/revyriders-map/img/info-window-track.jpg" alt="Revy Riders Motocross Track" />' +
					'</div>' +
					'</div>';

	var trackContentInfoWindow = new google.maps.InfoWindow({
		content: trackContent
	});


	google.maps.event.addListener(track, 'click', trackInfo);

	function trackInfo() {
		map.setCenter(new google.maps.LatLng(51.06053278849464, -118.20366549491882));
		map.setZoom(16);
		trackContentInfoWindow.open(map, track);
	}

}

jQuery(document).ready(function () {
	google.maps.event.addDomListener(window, 'load', initialize);
});

