// welcome [START]
const welcomeAnimation = () => {
	const $welcome = document.querySelector('.js-welcome')

	if ($welcome == null) return

	const $html = document.querySelector('html')

	// check that all images are loaded
	Promise.all(Array.from(document.images).filter(img => !img.complete).map(img => new Promise(resolve => { img.onload = img.onerror = resolve; }))).then(() => {
		// animation part 1
		$html.classList.add('welcome_active')

		// animation part 2
		setTimeout(() => {
			$html.classList.add('welcome_part_2')

			document.querySelector('.js-welcome-preload').remove()
		}, 4000)

		// animation part 3 | hide & remove
		setTimeout(() => {
			$html.classList.remove('welcome_active')
			$html.classList.remove('welcome_part_2')

			document.querySelector('.js-welcome').remove()
		}, 7500)
	})
}

welcomeAnimation()
// welcome [END]