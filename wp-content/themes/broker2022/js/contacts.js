
// inputs [START]
let $contactInputs = document.getElementsByClassName('wpcf7-form-control')

Array.from($contactInputs).forEach(function(input) {
	let $label = input.closest('label')

	if (!$label) return

	$label.classList.toggle('active', input.value)

	input.addEventListener('input', (e) => {
		$label.classList.toggle('active', e.target.value)
	})

	input.addEventListener('focusout', (e) => {
		$label.classList.toggle('active', e.target.value)
	})

	input.addEventListener('focusin', (e) => {
		$label.classList.add('active')

		let $parnet = e.target.parentElement
		let error = $parnet.querySelector('.wpcf7-not-valid-tip')

		if (!error) return

		error.remove()
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
		$form.classList.remove('sent')
		$form.classList.add('init')
	})
})
// response [END]
