// amoCrm.js [START]
$(document).ready(function() {
	// delete [START]
	if (window.location.pathname !== '/novostrojki/') return

	$('.js-popup[data-popup="feedback-6847"]').addClass('active')
	// delete [END]
})

// check form on submit
const onSubmit = () => {
	const $submit = document.querySelector('.js-crm-submit')

	if ($submit == null) return

	$submit.addEventListener('click', (e) => {
		e.preventDefault()

		const $nameLabel    = document.querySelector('.js-crm-name')
		const $phoneLabel   = document.querySelector('.js-crm-phone')

		if ($nameLabel == null || $phoneLabel == null) return

		const $name     = $nameLabel.querySelector('input')
		const $phone    = $phoneLabel.querySelector('input')

		if ($name == null || $phone == null) return

		$name.addEventListener('focus', () => {
			$name.classList.remove('error')
			$nameLabel.classList.remove('error')
		})

		$phone.addEventListener('focus', () => {
			$phone.classList.remove('error')
			$phoneLabel.classList.remove('error')
		})

		// check name is not empty
		if ($name.value === '') {
			$name.classList.add('error')
			$nameLabel.classList.add('error')

			showError()

			return
		}

		// check phone is not empty
		if ($phone.value === '') {
			$phone.classList.add('error')
			$phoneLabel.classList.add('error')

			showError()

			return
		}
	})
}

const $popupError = document.querySelectorAll('.js-popup-error')

// close error popup
const popupError = () => {
	if ($popupError == null) return

	$popupError.forEach((e) => {
		e.addEventListener('click', () => {
			$popupError.forEach((e) => {
				e.classList.remove('active')
			})
		})
	})
}

// show error popup and close after timeout
const showError = () => {
	$popupError.forEach((e) => {
		e.classList.add('active')
	})

	setTimeout(() => {
		$popupError.forEach((e) => {
			e.classList.remove('active')
		})
	}, 2500)
}

onSubmit()
popupError()
// amoCrm.js [END]
