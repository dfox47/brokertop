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