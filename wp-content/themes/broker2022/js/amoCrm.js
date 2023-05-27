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
	const submitBtn = $('.js-crm-submit')

	submitBtn.click(function (e) {
		e.preventDefault()

		const $feedbackForm     = $(this).closest('form')
		const fieldName         = $feedbackForm.find('input[name="user-name"]')
		const fieldPhone        = $feedbackForm.find('input[name="user-phone"]')
		const fieldAgree        = $feedbackForm.find('input[name="user-consent"]')
		const fieldsArray       = $feedbackForm.serializeArray()
		const pdfLink           = localStorage.getItem('pdfLink')

		// name check
		if (fieldName.length && fieldName.val() === '') {
			fieldName.after('<div class="input_tip js-input-tip">Обязательно для заполнения</div>')

			setTimeout(() => {
				$('.js-input-tip').remove()
			}, 2000)

			return
		}

		// phone check
		if (fieldPhone.length && fieldPhone.val() === '') {
			fieldPhone.after('<div class="input_tip js-input-tip">Обязательно для заполнения</div>')

			setTimeout(() => {
				$('.js-input-tip').remove()
			}, 2000)

			return
		}

		// agree
		if (fieldAgree.length && !fieldAgree.is(':checked')) {
			fieldAgree.after('<div class="input_tip js-input-tip">Обязательно для заполнения</div>')

			setTimeout(() => {
				$('.js-input-tip').remove()
			}, 2000)

			return
		}

		let objData = []

		fieldsArray.forEach(item => {
			if (item.value !== '') objData.push(item)
		})

		$.ajax({
			url: '/send_amo.php',
			type: 'POST',
			data: objData,
			success: function () {
				// hide all popups
				$('.js-popup').removeClass('active')

				$('.popup--success').addClass('active')

				$.cookie('cookie_presentation_feedback', 'true', { expires: 31, path: '/' })

				// download PDF
				if (pdfLink !== null) {
					window.open('https://' + window.location.hostname + '/' + pdfLink, '_blank')

					localStorage.removeItem('pdfLink')
				}
			},
			error: function () {
				console.log('error')
			}
		})
	})
	// send to amo [END]
})
// amoCrm.js [END]