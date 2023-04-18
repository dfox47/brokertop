<?php // map
global $product;

$googleAdress   = (empty($product->get_attribute('pa_adres')) ? '' : $product->get_attribute('pa_adres'));
$googleMapsX    = (empty($product->get_attribute('pa_google-api-x')) ? '55.7560299' : $product->get_attribute('pa_google-api-x'));
$googleMapsY    = (empty($product->get_attribute('pa_google-api-y')) ? '37.6048052' : $product->get_attribute('pa_google-api-y')); ?>

<div id="product_map" class="product_map"></div>

<script src="//api-maps.yandex.ru/2.1/?apikey=eed2b879-5209-4581-8167-71583aa7db36&lang=ru_RU"></script>

<script>
	ymaps.ready(function () {
		var map = new ymaps.Map('product_map', {
			center: [<?=$googleMapsX;?>, <?=$googleMapsY;?>],
			'stylers': {
				"hue": "#ddb472",
				'lightness': 1
			},
			zoom: 13
		});

		map.geoObjects.add(new ymaps.Placemark([<?=$googleMapsX;?>, <?=$googleMapsY;?>], {
				hintContent: "<?=$googleAdress;?>"
			},{
				iconLayout: 'default#imageWithContent',
				iconImageHref: '/wp-content/themes/broker2022/i/icons/map.svg',
				iconImageSize: [30, 42],
				iconImageOffset: [-15, -42]
			})
		);
	});
</script>