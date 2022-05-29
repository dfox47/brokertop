
// some special code here

// more info
// https://github.com/idangerous/plugins/tree/master/Chop%20Slider%203/Chop%20Slider%203%20jQuery
$(document).ready(function() {
	$('.js-hero-slider').cs3({
		autoplay: {
			delay: '4000',
			enabled: 'true'
		},
		captions: {
			enabled: 'true'
		},
		// effects: 'bricks3d',
		effects: 'bulb',
		navigation : {
			next: '.js-hero-slider-next',
			prev: '.js-hero-slider-prev'
		},
		pagination: {
			container: '.js-hero-slider-pagination'
		},
		preloader: 'false'
	})
})
