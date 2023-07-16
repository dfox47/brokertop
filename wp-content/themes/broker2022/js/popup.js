// popup.js [START]
const $html             = document.getElementsByTagName('html')[0]
const $popupClose       = document.querySelectorAll('.js-popup-close')
const $popupContent     = document.querySelector('.js-popup-content')
const $popupShow        = document.querySelectorAll('.js-popup-show')
const $popups           = document.querySelectorAll('.js-popup')

// show popup
$popupShow.forEach((button) => {
	const popupId = button.dataset.popup

	if (popupId === '') return

	button.addEventListener('click', () => {
		$popups.forEach((e) => {
			// show selected popup
			if (e.dataset.popup === popupId) {
				e.classList.add('active')

				// if popup with content to put
				if (popupId === 'with_content') {
					const $popupContentToPut = button.querySelector('.js-popup-content-put')

					if ($popupContentToPut == null) return

					$popupContent.innerHTML = $popupContentToPut.innerHTML

					let $owlCarouselPopup = $('.js-popup-content').find('.js-popup-owl-carousel')

					if ($owlCarouselPopup.length > 0) {
						$(document).ready(function() {
							$owlCarouselPopup.owlCarousel({
								autoHeight: true,
								dots:       false,
								items:      1,
								loop:       true,
								nav:        true,
								navText:    ['', '']
							})
						})
					}
				}

				return
			}

			// hide all other popups
			e.classList.remove('active')
		})

		// add class from html tag
		$html.classList.add('popup_active')
	})
})

// close popup
$popupClose.forEach((button) => {
	button.addEventListener('click', () => {
		$popups.forEach((e) => {
			// hide all popups
			e.classList.remove('active')

			// clear popup content
			$popupContent.innerHTML = ''
		})

		// remove class from html tag
		$html.classList.remove('popup_active')
	})
})
// popup.js [END]