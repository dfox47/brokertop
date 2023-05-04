// amoCrm.js [START]
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



$(document).ready(function () {
	// send to amo [START]
	const $feedbackForm = $('.hero_block_slide__content').find('form')

	$feedbackForm.find('.js-crm-submit').click(function (e) {
		e.preventDefault()

		let fieldsArray     = $feedbackForm.serializeArray()
		let fieldName       = $feedbackForm.find('input[name="user-name"]').eq(1)
		let fieldPhone      = $feedbackForm.find('input[name="user-phone"]').eq(1)

		fieldName.val() === '' ? fieldName.closest('.js-crm-name').addClass('error') : fieldName.closest('.js-crm-name').removeClass('error')

		fieldPhone.val() === '' ? fieldPhone.closest('.js-crm-phone').addClass('error') : fieldPhone.closest('.js-crm-phone').removeClass('error')

		// check to compleated fields
		if (fieldName.val() !== '' && fieldPhone.val() !== '') {
			let objData = []

			fieldsArray.forEach(item => {
				if ((item.name === 'user-name' || item.name === 'user-phone') && item.value !== '') objData.push(item)
			})

			$.ajax({
				url: '/send_amo.php',
				type: 'POST',
				data: objData,
				success: function () {
					$('.popup--success').addClass('active')

					$feedbackForm.find('input[type="text"]').val('')
				},
				error: function () {
					console.log('error')
				}
			})
		}
	})
	// send to amo [END]
})
// amoCrm.js [END]
