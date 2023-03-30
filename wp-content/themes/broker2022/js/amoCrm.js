// amoCrm.js [START]
$(document).ready(function() {
	if (window.location.pathname !== '/novostrojki/') return

	$('.js-popup[data-popup="feedback-6847"]').addClass('active')

	const $error = $('.js-popup-error')

	const showError = () => {
		$error.addClass('active')

		setTimeout(() => {
			$error.removeClass('active')
		}, 2000)
	}

	$('.js-crm-submit').click(function (e) {
		e.preventDefault()

		const $name     = $('.js-crm-name').find('input')
		const $phone    = $('.js-crm-phone').find('input')

		// check name is not empty
		if ($name.val() === '') {
			console.log('name is empty')

			showError()

			return
		}

		// check phone is not empty
		if ($phone.val() === '') {
			console.log('phone is empty')

			showError()

			return
		}
	})
})

document.querySelector('.js-crm-submit').addEventListener('click', (e) => {
	e.preventDefault()

	console.log('x46')
})

// close error popup [START]
const $popupError = document.querySelectorAll('.js-popup-error')

$popupError.forEach((e) => {
	e.addEventListener('click', () => {
		$popupError.forEach((e) => {
			e.classList.remove('active')
		})
	})
})
// close error popup [END]
// amoCrm.js [END]