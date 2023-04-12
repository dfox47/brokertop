// carousel.js [START]
$(document).ready(function() {
	const $owl              = $('.js-owl-carousel')
	const $owlAuto          = $('.js-owl-carousel-auto')
	const $owlBuildings     = $('.js-owl-buildings')

	// add numbers to dots
	const dotNumbers = () => {
		let $dotIndex = 1

		if ($owlBuildings.length < 1) return

		$owlBuildings.find('.owl-dot').each(function () {
			$(this).append('<span class="owl-dot-number">0' + $dotIndex + '</span>')

			$dotIndex++
		})
	}

	// owl carousel default [START]
	const owlCarouselDefault = () => {
		if ($owl.length < 1) return

		// slide next|prev with arrows on keyboard
		document.addEventListener('keydown', function(e) {
			switch (e.keyCode) {
				case 37:
					$owl.trigger('prev.owl.carousel');
					break
				case 39:
					$owl.trigger('next.owl.carousel');
					break
			}
		})

		// carousel
		$owl.owlCarousel({
			dots:       false,
			items:      1,
			loop:       true,
			nav:        true,
			navText:    ['', '']
		})
	}

	owlCarouselDefault()
	// owl carousel default [END]



	// owl carousel auto [START]
	const owlCarouselAuto = () => {
		if ($owlAuto.length < 1) return

		$owlAuto.owlCarousel({
			autoplay:           true,
			autoplayHoverPause: true,
			autoplayTimeout:    4000,
			dots:               false,
			items:              1,
			loop:               true,
			nav:                true,
			navText:            ['', '']
		})
	}

	owlCarouselAuto()
	// owl carousel auto [END]



	// owl carousel buildings [START]
	const buildingsCarousel = () => {
		if ($owlBuildings.length < 1) return

		$owlBuildings.owlCarousel({
			dots:       true,
			items:      4,
			loop:       true,
			margin:     20,
			nav:        true,
			navText:    ['<span>назад</span>', '<span>далее</span>'],
			slideBy:    4,
			onInitialized: function () {
				dotNumbers()
			},
			onResized: function () {
				dotNumbers()
			},
			onRefreshed: function () {
				dotNumbers()
			},
			responsive: {
				0: {
					items:      1,
					slideBy:    1,
				},
				600: {
					items:      2,
					slideBy:    2,
				},
				900: {
					items:      3,
					slideBy:    3,
				},
				1200: {
					items:      4,
					slideBy:    4,
				}
			}
		})
	}

	buildingsCarousel()
	// owl carousel buildings [END]



	// owl carousel projects [START]
	const projectsGallery = () => {
		const $projectsGallery = $('.js-projects-gallery')

		if ($projectsGallery.length < 1) return

		// add alt text from img alt
		$projectsGallery.find('img').each(function () {
			const $this     = $(this)
			const imgAlt    = $this.attr('alt')

			if (imgAlt.length < 1) return

			$this.parent().find('figcaption').append('<span class="projects_gallery__alt">' + imgAlt + '</span>')
		})

		// creat carousel
		$projectsGallery.owlCarousel({
			// autoplay:           true,
			autoplayHoverPause: true,
			autoplayTimeout:    4000,
			dots:               true,
			items:              4,
			loop:               true,
			margin:             24,
			nav:                true,
			navText:            ['', ''],
			responsive:{
				0:      {items: 1},
				700:    {items: 2},
				1100:   {items: 3},
				1400:   {items: 4}
			}
		})
	}

	projectsGallery()
	// owl carousel projects [END]



	// go to selected slide
	$('.js-go-to-slide').click(function () {
		$('.js-owl-carousel').trigger('to.owl.carousel', $(this).attr('data-slide'))
	})
})
// carousel.js [END]