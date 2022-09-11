
// header.js [START]

// header menu toggle
let $headerMenuToggle   = document.querySelectorAll('.js-header-menu-toggle')
let $html               = document.querySelector('html')

$headerMenuToggle.forEach((button) => {
	button.addEventListener('click', () => {
		$html.classList.toggle('header_menu_active')
	})
})

// header.js [END]
