// header.js [START]
// header menu toggle
document.querySelectorAll('.js-header-menu-toggle').forEach((button) => {
	button.addEventListener('click', () => {
		document.querySelector('html').classList.toggle('header_menu_active')
	})
})
// header.js [END]