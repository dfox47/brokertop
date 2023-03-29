// welcome [START]
const $welcome = document.querySelector('.js-welcome')

if ($welcome !== null) {
	// check that all images are loaded
	Promise.all(Array.from(document.images).filter(img => !img.complete).map(img => new Promise(resolve => { img.onload = img.onerror = resolve; }))).then(() => {
		// add class to start animation
		document.querySelector('html').classList.add('welcome_active')

		// animation part 1
		setTimeout(() => {
			document.querySelector('html').classList.add('welcome_part_2')

			document.querySelector('.js-welcome-preload').remove()
		}, 6000)

		// animation part 2
		setTimeout(() => {
			document.querySelector('html').classList.remove('welcome_active')
			document.querySelector('html').classList.remove('welcome_part_2')

			document.querySelector('.js-welcome').remove()
		}, 9000)
	})
}
// welcome [END]