
let $popups         = document.querySelectorAll('.js-popup')
let $popupShow      = document.querySelectorAll('.js-popup-show')

$popupShow.forEach((button) => {
	let popupId = button.dataset.popup

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
