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

	// show popup when user tries to leave [START]
	const showBeforeLeave = () => {
		const date          = new Date()
		const currentTime   = date.getTime()

		if (parseInt(localStorage.getItem('inactivePopupSeen')) > currentTime) return

		const $html = $('html')

		$html.bind('mouseleave', function () {
			$('.js-popup[data-popup="feedback-7237"]').addClass('active')
			document.getElementsByTagName('html')[0].classList.add('popup_active')
			$html.unbind('mouseleave')
			localStorage.setItem('inactivePopupSeen', (currentTime + 2 * 360000).toString())
		})
	}

	showBeforeLeave()
	// show popup when user tries to leave [END]

	$(document).on('click', '.js-pdf-link', function(e) {
		if ($.cookie('cookie_presentation_feedback') !== undefined) return

		e.preventDefault()

		const $this = $(this)

		// hide all popups
		$('.js-popup').removeClass('active')

		// set PDF link to localStorage
		localStorage.setItem('pdfLink', $this.attr('href'))

		const $popup = $('[data-popup="feedback-6953"]')

		$popup.attr('target-link', e.target.href)

		$popup.find('.js-page-url').val($this.attr('data-link'))

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

// change currency from attributes
document.querySelectorAll('.js-currency').forEach((cur) => {
	const curFromAttr = cur.dataset.currency

	if (!curFromAttr) return

	const $productLink = cur.closest('.js-product-link')

	if (!$productLink) return

	const $productSymbol = $productLink.querySelector('.woocommerce-Price-currencySymbol')

	if (!$productSymbol) return

	$productSymbol.innerText = curFromAttr
})
// custom.js [END]