
// inputs [START]
let $contactInputs = document.getElementsByClassName('wpcf7-form-control')

Array.from($contactInputs).forEach(function(input) {
	let $label      = input.closest('label')
	let inputVal    = input.value

	if (!$label) {
		return
	}

	$label.classList.toggle('active', inputVal)

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
// inputs [END]

// response [START]
let $contactError = document.getElementsByClassName('wpcf7-response-output')

Array.from($contactError).forEach(function(output) {
	output.addEventListener('click', (e) => {
		let $form = e.target.closest('.wpcf7-form')

		$form.dataset.status = 'init'
		$form.classList.remove('invalid')
		$form.classList.add('init')
	})
})
// response [END]
