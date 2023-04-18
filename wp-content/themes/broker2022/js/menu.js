// menu.js [START]
let $menuItem153    = document.querySelector('.menu-item-153 a')
let $menuItem154    = document.querySelector('.menu-item-154 a')

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

document.querySelectorAll('.js-menu-item-disabled').forEach((menuItem) => {
	menuItem.addEventListener('click', (event) => {
		event.preventDefault()

		// remove old tip
		menuTipRemove()
		menuTipCreate(menuItem)
	})
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
// menu.js [END]