// custom.js [START]
$(document).ready(function() {
	// owl carousel [START]
	const $owl      = $('.js-owl-carousel')
	const $owlAuto  = $('.js-owl-carousel-auto')

	$owl.owlCarousel({
		dots:       false,
		items:      1,
		loop:       true,
		nav:        true,
		navText:    ['', '']
	})

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

	$('.js-projects-gallery').owlCarousel({
		// autoplay:           true,
		autoplayHoverPause: true,
		autoplayTimeout:    4000,
		dots:               false,
		items:              1,
		loop:               true,
		nav:                true,
		navText:            ['', '']
	})

	// go to selected slide
	$('.js-go-to-slide').click(function () {
		let slideId = $(this).attr('data-slide')

		$('.js-owl-carousel').trigger('to.owl.carousel', slideId)
	})
	// owl carousel [END]



	let $acceptInput = $('.js-accept')

	$acceptInput.on('change', () => {
		$('.js-accept-desc').toggleClass('active', !$acceptInput.is(':checked'))
	})



	$(document).on('click touchstart focus', '.chosen-single', function () {
		$('.chosen-container').removeClass('filter-mobile-hack')
		$(this).parent().addClass('filter-mobile-hack')
	})

	$('.js-news-list').find('li').click(function() {
		window.location.href = $(this).find('a').attr('href')
	})
})

// insert after hack
let insertAfter = (newNode, existingNode) => {
	existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling)
}

// set page URL to hidden input
document.querySelectorAll('.js-page-url').forEach((e) => {
	e.value = window.location.href
})


// welcome [START]
const $welcome = document.querySelector('.js-welcome')

if ($welcome !== null) {
	// check that all images are loaded
	Promise.all(Array.from(document.images).filter(img => !img.complete).map(img => new Promise(resolve => { img.onload = img.onerror = resolve; }))).then(() => {
		// add class to start animation
		document.querySelector('html').classList.add('welcome_active')
	})
}
// document.querySelector('html').classList.remove('welcome_active')
// welcome [END]
// custom.js [END]