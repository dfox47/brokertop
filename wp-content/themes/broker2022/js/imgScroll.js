let imgScroll = () => {
	document.querySelectorAll('.js-img-scroll').forEach((e) => {
		if (window.pageYOffset + window.innerHeight > e.offsetTop) {
			e.classList.remove('js-img-scroll')
			e.src = e.dataset.src
		}
	})
}

imgScroll()

window.addEventListener('resize', function() {
	imgScroll()
})

window.addEventListener('scroll', function() {
	imgScroll()
})







document.addEventListener('DOMContentLoaded', function() {
	document.querySelectorAll('.js-img-lazy').forEach((e) => {
		e.classList.remove('js-img-lazy')
		e.src = e.dataset.src
	})
})