// popup.js [START]
const $popups       = document.querySelectorAll('.js-popup')
const $popupShow    = document.querySelectorAll('.js-popup-show')
const $popupClose   = document.querySelectorAll('.js-popup-close')

$popupShow.forEach((button) => {
	const popupId = button.dataset.popup

	button.addEventListener('click', () => {
		$popups.forEach((e) => {
			let popupSelected = e.dataset.popup

			if (popupSelected === popupId) {
				e.classList.add('active')

				return
			}

			e.classList.remove('active')
		})
	})
})

$popupClose.forEach((button) => {
	button.addEventListener('click', () => {
		$popups.forEach((e) => {
			e.classList.remove('active')
		})
	})
})
// popup.js [END]