// menu.js [START]
const $menuItem154      = document.querySelector('.menu-item-154 a')
const $menuItem7623     = document.querySelector('.menu-item-7623 a')

if ($menuItem7623) {
	$menuItem7623.addEventListener('click', (e) => {
		e.preventDefault()

		// remove old tip
		menuTipRemove()
		menuTipCreate($menuItem7623)
	})
}

if ($menuItem154) {
	$menuItem154.addEventListener('click', (e) => {
		e.preventDefault()

		// remove old tip
		menuTipRemove()
		menuTipCreate($menuItem154)
	})
}

document.querySelectorAll('.js-menu-item-disabled').forEach((menuItem) => {
	menuItem.addEventListener('click', (event) => {
		event.preventDefault()

		// remove old tip
		menuTipRemove()
		menuTipCreate(menuItem)
	})
})

const menuTipCreate = (menuId) => {
	let menuTip = document.createElement('div')
	menuTip.classList.add('header_menu_tip')
	menuTip.textContent = 'Раздел на модерации'

	insertAfter(menuTip, menuId)

	setTimeout(() => {
		menuTip.remove()
	}, 2000)
}

const menuTipRemove = () => {
	const menuOld = document.querySelector('.header_menu_tip')

	if (menuOld) menuOld.remove()
}
// menu.js [END]