
// events for contact form 7
let $contactInput = document.querySelectorAll('.wpcf7-form-control')

$contactInput.forEach((input) => {
	let $label      = input.closest('label')
	let inputVal    = input.value

	if ($label) {
		$label.classList.toggle('active', inputVal)
	}

	input.addEventListener('input', (e) => {
		$label.classList.toggle('active', e.target.value)
	})

	input.addEventListener('focusout', (e) => {
		$label.classList.toggle('active', e.target.value)
	})

	input.addEventListener('focusin', () => {
		$label.classList.add('active')
	})
})
