
// custom.js [START]

// some special code here
let x = () => {
	let pageNavCurrent = document.querySelectorAll('.page-numbers.current')

	if (!pageNavCurrent) return

	pageNavCurrent.forEach((e) => {
		e.classList.add('new')
	})
}

x()

$(document).ready(function() {
	// owl carousel at product page
	$('.js-owl-carousel').owlCarousel({
		dots:       false,
		items:      1,
		loop:       true,
		nav:        true,
		navText: ['', '']
	})

	$('.js-owl-carousel-auto').owlCarousel({
		autoplay:           true,
		autoplayHoverPause: true,
		autoplayTimeout:    4000,
		dots:               false,
		items:              1,
		loop:               true,
		nav:                true,
		navText:            ['', '']
	})

	// go to selected slide
	$('.js-go-to-slide').click(function () {
		let slideId = $(this).attr('data-slide')

		$('.js-owl-carousel').trigger('to.owl.carousel', slideId)
	})
})



let $menuItem153 = document.querySelector('.menu-item-153 a')
let $menuItem154 = document.querySelector('.menu-item-154 a')

$menuItem153.addEventListener('click', (e) => {
	e.preventDefault()

	// remove old tip
	menuTipRemove()
	menuTipCreate($menuItem153)
})

$menuItem154.addEventListener('click', (e) => {
	e.preventDefault()

	// remove old tip
	menuTipRemove()
	menuTipCreate($menuItem154)
})

let menuTipCreate = (menuId) => {
	let menuTip = document.createElement('div')
	menuTip.classList.add('header_menu_tip')
	menuTip.textContent = 'Раздел на модерации'

	insertAfter(menuTip, menuId)

	setTimeout(() => {
		menuTip.remove()
	}, 2000)
}

let menuTipRemove = () => {
	let menuOld = document.querySelector('.header_menu_tip')

	if (menuOld) {
		menuOld.remove()
	}
}

let insertAfter = (newNode, existingNode) => {
	existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling)
}

// custom.js [END]
