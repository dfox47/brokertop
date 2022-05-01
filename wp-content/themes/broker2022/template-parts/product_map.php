
<?php // ?>
<div class="product_map"></div>

<script>
	function initMap() {
		// center of the map
		let myLatLng = {
			lat: 50.44973057721140,
			lng: 30.483638212303163
		};

		let map = new google.maps.Map(document.querySelector('.product_map'), {
			zoom: 17,  // zoom
			center: myLatLng
		});

		// styles | examples https://snazzymaps.com/
		let styles = [
			{
				"featureType": "administrative",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#444444"
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "all",
				"stylers": [
					{
						"color": "#f2f2f2"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road",
				"elementType": "all",
				"stylers": [
					{
						"saturation": -100
					},
					{
						"lightness": 45
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "all",
				"stylers": [
					{
						"color": "#ddb472"
					},
					{
						"visibility": "on"
					}
				]
			}
		];

		// styles to map
		map.setOptions({styles: styles});

		// marker on map [START]
		let imgHeight   = 26
		let imgWidth    = 22

		let image = {
			url: '/wp-content/themes/broker2022/i/icons/map.svg',
			size: new google.maps.Size(imgWidth, imgHeight),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(imgWidth / 2, imgHeight)
		};
		// marker on map [END]

		// тут создается блок, всплывающий по клику на маркер. Удобен чтоб добавить небольшой текст-описание или подсказку.
		let contentString = '<div id="map-content">' +
			'<div id="siteNotice">' +
			'</div>' +
			'<h2 id="firstHeading" class="firstHeading"><?php echo get_the_title(); ?></h2>' +
			'<div id="bodyContent"><?php echo number_format($product -> get_price(),0,'',' '); ?>&nbsp;₽</div>' +
			'</div>';

		let infowindow = new google.maps.InfoWindow({
			content: contentString,
			maxWidth: 270
		});

		// здесь создается сам маркер и применяются параметры отображения
		let marker = new google.maps.Marker({
			animation:  google.maps.Animation.DROP,
			icon:       image,
			map:        map,
			position:   myLatLng,
			title:      '<?php echo get_the_title(); ?>'
		});

		let myOptions = {
			draggable: !("ontouchend" in document)
		};

		marker.addListener('click', function () {
			infowindow.open(map, marker);
		});
	}
</script>

<script async src="//maps.googleapis.com/maps/api/js?key=AIzaSyA2J-HodSUWcfoSjV1_sSD99kYhFTsaJFo&callback=initMap"></script>
