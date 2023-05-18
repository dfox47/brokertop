// about.js [START]
const $aboutTitle       = document.querySelector('.js-about-title')
const $aboutQuote       = document.querySelector('.js-about-quote')
const $h2               = document.querySelector('.js-about-title-main')
const $aboutQuoteDesc   = document.querySelector('.about_quote')

if ($h2) {
	$aboutTitle.appendChild($h2)
}

if ($aboutQuoteDesc) {
	$aboutQuote.appendChild($aboutQuoteDesc)
}
// about.js [END]