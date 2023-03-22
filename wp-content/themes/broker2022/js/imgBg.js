// imgBg [START]
let imgBg = () => {
	document.querySelectorAll('.js-img-bg').forEach((e) => {
		if (window.pageYOffset + window.innerHeight > e.offsetTop) {
			e.classList.remove('js-img-bg')
			e.style.backgroundImage = 'url(' + e.dataset.src + ')'
		}
	})
}

imgBg()

window.addEventListener('resize', function() {
	imgBg()
})

window.addEventListener('scroll', function() {
	imgBg()
})
// imgBg [END]