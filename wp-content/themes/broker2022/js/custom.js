// custom.js [START]
$(document).ready(function () {
	// accept [START]
	let $acceptInput = $('.js-accept')

	$acceptInput.on('change', () => {
		$('.js-accept-desc').toggleClass('active', !$acceptInput.is(':checked'))
	})
	// accept [END]

	$(document).on('click touchstart focus', '.chosen-single', function () {
		$('.chosen-container').removeClass('filter-mobile-hack')
		$(this).parent().addClass('filter-mobile-hack')
	})

	// news
	$('.js-news-list').find('li').click(function () {
		window.location.href = $(this).find('a').attr('href')
	})

	// delete [START]
	// $('.js-popup[data-popup="feedback-6847"]').addClass('active')
	// delete [END]

	$('.js-presentation-feedback').click(function(e) {
		if ($.cookie('cookie_presentation_feedback') !== undefined) return

		e.preventDefault()

		// set PDF link to localStorage
		localStorage.setItem('pdfLink', $(this).attr('href'))

		const $popup = $('[data-popup="feedback-6954"]')

		$popup.attr('target-link', e.target.href)

		$popup.addClass('active')
	})
})

// insert after | hack
let insertAfter = (newNode, existingNode) => {
	existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling)
}

// set page URL to hidden input
document.querySelectorAll('.js-page-url').forEach((e) => {
	e.value = window.location.href
})
// custom.js [END]